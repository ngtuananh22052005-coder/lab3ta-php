<?php
session_start();

// Nếu chưa đăng nhập → đá về login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<style>
    body {
        font-family: Arial;
        background: #f4f6f8;
    }
    .box {
        width: 500px;
        margin: 100px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
</style>
</head>
<body>

<div class="box">
    <h2>Xin chào, <?= $_SESSION['user'] ?></h2>
    <p>Chào mừng bạn đến trang quản trị</p>

    <a href="logout.php">Đăng xuất</a>
</div>

</body>
</html>
