<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'config.php';

// Mengambil data gambar carousel dari database
$sql_carousel = "SELECT image_url, caption FROM carousel_images ORDER BY created_at DESC";
$result_carousel = $conn->query($sql_carousel);

// Mengambil data berita terbaru dari database
$sql_news = "SELECT title, content, date FROM news ORDER BY date DESC LIMIT 5";
$result_news = $conn->query($sql_news);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background: url('img/1.jpg') no-repeat center center fixed; 
            background-size: cover;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar .login {
            float: right;
        }
        .content {
            padding: 10px;
            background-color: #f9f9f9;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content h2 {
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .content form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .content form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .content form input[type="text"],
        .content form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .content form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .content form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        .carousel-item img {
            height: 70vh;
            object-fit: cover;
        }

        .news-item {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .news-item h3 {
            margin-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .news-item p {
            margin-bottom: 10px;
        }
        .news-item small {
            font-size: 0.9em;
        }
        .about-container {
                display: flex;
                align-items: center;
            }
            .about-container img {
                width: 500px;
                height: 200px;
                object-fit: cover;
                margin-right: 20px;
            }
            .about-container p {
                text-align: justify;
                margin: 10px;
            }
            a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to GIDS Hotel</h1>
        <p>Experience Luxury & Comfort</p>
    </div>

    <!-- Navigasi -->
    <div class="navbar">
        <a href="admin_dashboard.php">Home</a>
        <a href="services.php">Services</a>
        <a href="facilites_admin.php">Facilities</a>
        <a href="profile.php">Profile</a>
        <div style="float:right;">
            <a href="logout.php">Logout</a>
            <a>Hello, <?php echo $_SESSION['username']; ?>!</a>
        </div>
    </div>

    <!-- Carousel -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $isActiveSet = false; // Variabel untuk memastikan slide pertama ditandai sebagai aktif
            if ($result_carousel->num_rows > 0) {
                while($row = $result_carousel->fetch_assoc()) {
                    echo '<div class="carousel-item '. (!$isActiveSet ? 'active' : '') .'">';
                    echo '<img src="'.$row['image_url'].'" class="d-block w-100" alt="Carousel Image">';
                    if (!empty($row['caption'])) {
                        echo '<div class="carousel-caption d-none d-md-block">';
                        echo '<h5>'.$row['caption'].'</h5>';
                        echo '</div>';
                    }
                    echo '</div>';
                    $isActiveSet = true; // Set slide pertama sebagai aktif, selanjutnya tidak ada slide yang aktif
                }
            } else {
                echo '<div class="carousel-item active">';
                echo '<img src="default-image.jpg" class="d-block w-100" alt="Default Image">';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h5>Default Caption</h5>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <br>
    <div class="content">
    <form action="admin_add_carousel.php" method="POST">
        <h4>Tambah Gambar Carousel</h4>
        <label for="image_url">URL Gambar:</label><br>
        <input type="text" id="image_url" name="image_url"><br><br>
        <label for="caption">Caption (Opsional):</label><br>
        <input type="text" id="caption" name="caption"><br><br>
        <input type="submit" value="Tambah Gambar">
    </form>
    </div>

    <div class="content">
        <h2>Latest News</h2>
        <?php
        if ($result_news->num_rows > 0) {
            while($row = $result_news->fetch_assoc()) {
                echo '<div class="news-item">';
                echo "<h3>"."<b>" . htmlspecialchars($row['title']) ."</b>" ."</h3>";
                echo "<p>" . htmlspecialchars($row['content']) . "</p>";
                echo "<small>Published on " . htmlspecialchars($row['date']) . "</small>";
                echo '<hr>';
                echo '</div>';
            }
        } else {
            echo '<p>No news available.</p>';
        }
        
        ?>
        <h4>Tambah Berita Baru</h4>
        <form action="admin_add_news.php" method="POST">
        <label for="title">Judul Berita:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        <label for="content">Isi Berita:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea><br><br>
        <input type="submit" value="Tambah Berita">
    </form>

        
        <div class="content">
            <h2>
                About GIDS Hotel
            </h2>
            <div class="about-container">
            <img src="img/a1.jpg" alt="">
            <p>GIDS Hotelmenawarkan pengalaman menginap yang luar biasa dengan kombinasi sempurna antara kenyamanan modern dan keanggunan klasik. Terletak strategis di pusat kota, hotel ini memudahkan para tamu untuk menjelajahi berbagai atraksi utama. Dengan kamar-kamar yang luas dan dilengkapi fasilitas terkini, [Nama Hotel] adalah tempat yang tepat untuk melepas lelah setelah seharian beraktivitas.</p>
        </div>
        <br>
        <br>
        <div>
        <h2>Our Services</h2>
        <p>Beberapa Service yang kami tawarkan</p>
        <ul>
            <li>Kami dengan senang hati menawarkan layanan 24 jam untuk memastikan kenyamanan dan kebutuhan Anda terpenuhi setiap saat.</li>
            <li>Nikmati layanan eksklusif kami, termasuk spa, layanan kamar, dan transportasi pribadi, yang dirancang untuk memberikan pengalaman menginap yang tak terlupakan.</li>
            <li>Manfaatkan layanan laundry kami yang cepat dan efisien, agar Anda selalu tampil rapi selama menginap.</li>
            <li>Kami menawarkan layanan antar-jemput bandara gratis untuk memastikan perjalanan Anda lebih nyaman dan bebas dari kerepotan.</li>
            <li>Tim kami yang berpengalaman siap memberikan layanan katering dan perencanaan acara untuk memastikan setiap momen istimewa Anda berjalan sempurna.</li>
        </ul>
        </div>
        <h2>Social Media</h2>
        <ul style="list-style-type: none; display: flex; justify-content: center; align-items: center; padding: 0; margin: auto;">
        <li style="margin: 0 10px;"><a href="https://www.facebook.com/" target="_blank"><img src="img/fbpng.png" alt="Facebook" width="50"></a></li>
        <li style="margin: 0 10px;"><a href="https://www.instagram.com/" target="_blank"><img src="img/ig.jpeg" alt="Instagram" width="50"></a></li>
        <li style="margin: 0 10px;"><a href="https://twitter.com/" target="_blank"><img src="img/twitter.png" alt="Twitter" width="50"></a></li>
        <li style="margin: 0 10px;"><a href="https://www.youtube.com/" target="_blank"><img src="img/yt.png" alt="YouTube" width="50"></a></li>
        </ul>
        <p><a href="https://wa.me/6281266636861">Helpdesk</a></p>
    </div>

    <div class="footer">
        <p>&copy; 2024 GIDS Hotel. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
