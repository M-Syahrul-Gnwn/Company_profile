<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'config.php';

$id = $_GET['id'];

// Menghapus fasilitas dari database
$sql_delete = "DELETE FROM facilities WHERE id = $id";

if ($conn->query($sql_delete) === TRUE) {
    header("Location: facilites_admin.php");
} else {
    echo "Error: " . $sql_delete . "<br>" . $conn->error;
}
?>
