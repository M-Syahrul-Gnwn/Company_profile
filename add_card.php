<?php
session_start();
include 'config.php';

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

function displayCards() {
    global $conn;
    $sql = "SELECT * FROM cards ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Cards</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>
                <img src='" . $row['image'] . "' alt='' style='width:200px; height:auto;'>
                <p>Title: " . $row['title'] . "</p>
                <p>Price: " . $row['price'] . "</p>
                <p>Description: " . $row['description'] . "</p>
                <form action='delete_card.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'> 
                    <input type='submit' name='delete' value='Hapus'>
                </form>
            </li>";
        }
        echo "</ul>";
    } else {
        echo "Tidak ada card yang tersedia.";
    }
}

function deleteCards() {
    global $conn;
    $id = $_POST['id'];

    $sql = "DELETE FROM cards WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Card berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        deleteCards();
    } 
}

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: services.php');    
    exit();
}
?>

