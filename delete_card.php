<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus produk dari database
    $sql = "DELETE FROM cards WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: services.php"); // Redirect ke halaman utama setelah hapus
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
