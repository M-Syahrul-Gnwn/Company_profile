<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // ganti dengan username database Anda
    $password = ""; // ganti dengan password database Anda
    $dbname = "company_profile_db"; // ganti dengan nama database Anda

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $name = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $checkin = htmlspecialchars($_POST['checkin']);
    $checkout = htmlspecialchars($_POST['checkout']);
    $room_type = htmlspecialchars($_POST['room_type']);
    $special_requests = htmlspecialchars($_POST['special_requests']);
    $price = htmlspecialchars($_POST['price']);

    // Siapkan pernyataan SQL
    $sql = "INSERT INTO bookings (name, email, checkin, checkout, room_type, special_requests, price)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Cek apakah prepare berhasil
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Ikat parameter
    if (!$stmt->bind_param("ssssssi", $name, $email, $checkin, $checkout, $room_type, $special_requests, $price)) {
        die("Bind failed: " . $stmt->error);
    }

    // Eksekusi pernyataan
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    // Tutup pernyataan dan koneksi
    $stmt->close();
    $conn->close();

    // Redirect ke view_orders.php setelah pemesanan berhasil
    header("Location: view_orders.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
