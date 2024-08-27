<?php
session_start();
include 'config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Ambil informasi pengguna dari database
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();



// Proses pembaruan profil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: ubah_profile.php");
    exit();
}

// Redirect berdasarkan peran pengguna
$dashboard_page = $user['role'] === 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php';

// Debugging: Lihat halaman yang akan di-redirect

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            color: green;
            font-weight: bold;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profil Pengguna</h2>
        <form action="" method="POST">
            <label for="username">Username : </label>
            <input type="text" id="username" name="username" value="<?php echo $user['username'];?>" readonly disabled><br><br>

            <label for="role">Nama : </label>
            <input type="text" id="role" name="role" value="<?php echo $user['nama'];?>" readonly disabled><br><br>

            <label for="email">Email : </label>
            <input type="text" id="email" name="email" value="<?php echo $user['email'];?>" readonly disabled><br><br>

            <label for="role">Alamat : </label>
            <input type="text" id="role" name="role" value="<?php echo $user['alamat'];?>" readonly disabled><br><br>

            <label for="role">No HP : </label>
            <input type="text" id="role" name="role" value="<?php echo $user['no_hp'];?>" readonly disabled><br><br>

            <input type="submit" value="Ubah Profil">
        </form>
        <p><a href="ubah_password.php">Ubah Password</a></p>
        <p><a href="<?php echo $dashboard_page; ?>">Kembali ke Dasbor</a></p>
    </div>
</body>
</html>
