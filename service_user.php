<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'config.php';

// Jalankan query untuk mengambil data dari database
$sql = "SELECT * FROM cards ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO cards (title, price, description, image) VALUES ('$title', '$price', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "Card berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling halaman */
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
        .content {
            padding: 20px;
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

        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 20%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .card h4 {
            text-align: center;
        }

        .container {
            padding: 2px 16px;
        }
        .card img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            height: 50%;
            object-fit: cover;
            margin-bottom: 0px;
            border-radius: 5px;
        }
        .btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            margin: 0 auto;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .title {
            text-align: center;
        }
        h2 {
            text-align: center;
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
        <a href="user_dashboard.php">Home</a>
        <a href="service_user.php">Services</a>
        <a href="facilities_user.php">Facilities</a>
        <a href="profile.php">Profile</a>
        <div style="float:right;">
            <a href="logout.php">Logout</a>
            <a>Hello, <?php echo $_SESSION['username']; ?>!</a>
        </div>
    </div>
        <br>
    <div class="container" style="justify-content: center;">
        <h2>Daftar Produk</h2>
        <div class="card-container" style="display: flex; flex-wrap: wrap; gap: 40px; justify-content: center;  text-align: center;">
        <?php
        if ($result->num_rows > 0) {
            // Loop untuk menampilkan setiap card
            while($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<br>';
                echo '<img src="'.$row["image"].'" class="card-img-top" alt="...">';
                echo '<h4><b>'.$row["title"].'</b></h4>';
                echo '<p class="title"><b>'.$row["price"].'</b></p>';
                echo '<p>'.$row["description"].'</p>';
                echo '<a href="form_pemesanan.php'.$row["id"].'" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 5px;">Pesan Sekarang!</a>';
                echo '<br>';
                echo '</div>';
            }
        } else {
            echo "Tidak ada produk yang tersedia.";
        }
        ?>
        <br>
        <br>

    <div class="footer">
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
    </div>
<br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

