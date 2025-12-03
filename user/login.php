<?php
include '../connection.php';

if(isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JRF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-body">
    <div class="footprints"></div>
    
    <div class="auth-container">
        <div class="auth-header">
            <img src="../assets/jrfLogo.png" alt="JRF Logo" class="auth-logo">
            <h1>Login</h1>
        </div>
        
        <?php if(isset($_GET['success']) && $_GET['success'] == 'register'): ?>
            <div class="alert alert-success">
                ✅ Registrasi berhasil! Silahkan login.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                if($_GET['error'] == 'user_not_found') echo "❌ Username tidak ditemukan, silahkan register terlebih dahulu";
                elseif($_GET['error'] == 'wrong_password') echo "❌ Password salah";
                elseif($_GET['error'] == 'empty_fields') echo "❌ Username dan Password harus diisi!";
                ?>
            </div>
        <?php endif; ?>

        <form action="logic/loginProcess.php" method="post">
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </div>
            
            <button type="submit" class="btn-submit">Login</button>
        </form>
        
        <div class="auth-link">
            Belum Punya Akun? <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>