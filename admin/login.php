<?php
include "../connection.php";

// Cek jika sudah login, langsung ke dashboard
if(isset($_SESSION['admin_logged_in'])){
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - JRF</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body class="login-body">
    <div class="login-card">
        <div class="login-header">
            <img src="../assets/jrfLogo.png" alt="Logo JRF"> 
            <h2>Login Admin</h2>
        </div>
        
        <form action="logic/loginProcess.php" method="POST" class="login-form">
            <?php if(isset($_GET['error'])): ?>
                <div style="background: #ffcccc; color: red; padding: 10px; margin-bottom: 10px; border-radius: 4px; text-align: center;">
                    ❌ Username atau Password Salah!
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label>Username :</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password :</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>