<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

$sql = "SELECT * FROM news ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
</head>
<body>
    <h1>Daftar Berita</h1>
    <a href="admin_add_news.php">Tambah Berita Baru</a><br><br>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<img src='" . $row['image_url'] . "' alt=''><br><br>";
            echo "<small>Dipublikasikan pada: " . $row['date'] . "</small><hr>";
        }
    } else {
        echo "<p>Tidak ada berita tersedia.</p>";
    }
    ?>
</body>
</html>
