<!-- generate_hash.php -->
<?php
// Password yang ingin di-hash
$password = 'admin';

// Meng-hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output hasil hash
echo "Hash password: " . $hashed_password;
?>
