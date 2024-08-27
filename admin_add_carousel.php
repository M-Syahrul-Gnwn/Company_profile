<?php
session_start();
include 'config.php';

// Function to display carousel images
function displayCarouselImages() {
    global $conn;
    $sql = "SELECT * FROM carousel_images ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Gambar Carousel</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>
                <img src='" . $row['image_url'] . "' alt=''>
                <form action='admin_add_carousel.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'> 
                    <input type='submit' name='delete' value='Hapus'>
                </form>
            </li>";
        }
        echo "</ul>";
    } else {
        echo "Tidak ada gambar carousel.";
    }
}

// Function to add a carousel image
function addCarouselImage() {
    global $conn;
    $image_url = $_POST['image_url'];
    $caption = $_POST['caption'];

    $sql = "INSERT INTO carousel_images (image_url, caption) VALUES ('$image_url', '$caption')";
    if ($conn->query($sql) === TRUE) {
        echo "Gambar berhasil ditambahkan ke carousel!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to delete a carousel image
function deleteCarouselImage() {
    global $conn;
    $id = $_POST['id'];

    $sql = "DELETE FROM carousel_images WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Gambar berhasil dihapus dari carousel!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        deleteCarouselImage();
    } else {
        addCarouselImage();
    }
}

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_dashboard.php');    
    exit();
}

?>



