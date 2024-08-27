<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'config.php';

// Mengambil data fasilitas dari database
$sql_facilities = "SELECT id, name, description, image_url, created_at FROM facilities ORDER BY created_at DESC";
$result_facilities = $conn->query($sql_facilities);

// Periksa apakah query berhasil
if ($result_facilities === false) {
    die("Query error: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - Admin</title>
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
        .content h2 {
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
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
        .facility-item {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .facility-item img {
            max-width: 100%;
            height: 400px; /* Sesuaikan dengan ukuran yang diinginkan */
            display: block;
            margin: 0 auto 10px; /* Memusatkan gambar dan memberikan jarak bawah */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .facility-item ul {
            list-style-type: disc; /* Mengubah tipe list, bisa juga 'circle', 'square', dsb. */
            padding-left: 20px;
        }
        .facility-item ul li {
            margin-bottom: 5px; /* Menambahkan jarak antar item list */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>GIDS Hotel Facilities</h1>
        <p>Our Facilities at Your Service</p>
    </div>

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

    <div class="content">
        <h2>Our Facilities</h2>
        
        <?php
        if ($result_facilities->num_rows > 0) {
            while($row = $result_facilities->fetch_assoc()) {
                echo '<div class="facility-item">';
                echo "<h3><b>" . htmlspecialchars($row['name']) . "</b></h3>";
                if (!empty($row['image_url'])) {
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="Facility Image">';
                }
                echo "<ul>";
                $description_lines = explode("\n", htmlspecialchars($row['description']));
                foreach ($description_lines as $line) {
                    echo "<li>" . $line . "</li>";
                }
                echo "</ul>";
                echo "<small>Added on " . htmlspecialchars($row['created_at']) . "</small>";
                echo '<br>';
                echo '<a href="admin_edit_facility.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a> ';
                echo '<a href="admin_delete_facility.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this facility?\');">Delete</a>';
                echo '<hr>';
                echo '</div>';
            }
        } else {
            echo '<p>No facilities available.</p>';
        }
        ?>

        <h4>Add New Facility</h4>
        <form action="admin_add_facility.php" method="POST">
            <label for="name">Facility Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="5" required></textarea><br><br>

            <label for="image_url">Image URL:</label><br>
            <input type="text" id="image_url" name="image_url"><br><br>

            <input type="submit" value="Add Facility">
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2024 GIDS Hotel. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
