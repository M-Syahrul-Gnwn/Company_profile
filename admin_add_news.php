<?php
session_start();
include 'config.php';

// Function to add news
function addNews() {
    global $conn;
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d H:i:s'); // Atur tanggal dan waktu saat berita ditambahkan

    $sql = "INSERT INTO news (title, content, date) VALUES ('$title', '$content', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Berita berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to display news
function displayNews() {
    global $conn;
    $sql = "SELECT * FROM news ORDER BY date DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Daftar Berita</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>
                <h3>" . $row['title'] . "</h3>
                <p>" . $row['content'] . "</p>
                <small>Published on " . $row['date'] . "</small>
                <form action='admin_dashboard.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'> 
                    <input type='submit' name='delete_news' value='Hapus'>
                </form>
                <hr>
            </li>";
        }
        echo "</ul>";
    } else {
        echo "Tidak ada berita.";
    }
}

// Function to delete a carousel image// Function to delete news
function deleteNews() {
    global $conn;
    $id = $_POST['id'];

    $sql = "DELETE FROM news WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Berita berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_news'])) {
        deleteNews();
    } elseif (isset($_POST['title'])) {
        addNews();
    }
}

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_dashboard.php');
    exit();
}
?>

