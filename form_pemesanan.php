<?php
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

// Ambil data pengguna dari tabel users
$sql = "SELECT nama, email FROM users WHERE id = ?"; // Sesuaikan dengan kondisi yang Anda inginkan
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$user_id = 1; // Ganti dengan ID pengguna yang relevan atau ambil dari sesi login
$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("No user found with ID $user_id");
}

$nama = $user['nama'];
$email = $user['email'];

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        input[type="text"], input[type="email"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Hotel Booking Form</h2>
        <form action="process_booking.php" method="POST">
            <label for="nama">Full Name:</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required >

            <label for="checkin">Check-in Date:</label>
            <input type="date" id="checkin" name="checkin" required>

            <label for="checkout">Check-out Date:</label>
            <input type="date" id="checkout" name="checkout" required>

            <label for="room_type">Room Type:</label>
            <select id="room_type" name="room_type" required>
                <option value="Deluxe Room">Deluxe Room</option>
                <option value="Family Room">Family Room</option>
                <option value="Connecting Room">Connecting Room</option>
            </select>

            <label for="special_requests">Special Requests:</label>
            <input type="text" id="special_requests" name="special_requests">

            <input type="submit" value="Book Now">
            <p>Kembali ke <a href="services.php">sebelumnya</a>.</p>
        </form>
    </div>
</body>
</html>
