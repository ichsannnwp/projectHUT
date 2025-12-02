<?php
include "../connection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$re_password = trim($_POST['re_password']);

if(empty($username) || empty($password) || empty($re_password)){
    header("Location: ../register.php?error=empty_fields");
    exit;
}

if($password !== $re_password){
    header("Location: ../register.php?error=password_mismatch");
    exit;
}

// Cek apakah username sudah ada
$check_sql = "SELECT * FROM user WHERE username = ?";
$check_stmt = $koneksi->prepare($check_sql);
$check_stmt->bind_param("s", $username);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if($check_result->num_rows > 0){
    header("Location: ../register.php?error=username_exists");
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user baru
$sql = "INSERT INTO user (username, password) VALUES (?, ?)";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);

if($stmt->execute()){
    header("Location: ../login.php?success=register");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>