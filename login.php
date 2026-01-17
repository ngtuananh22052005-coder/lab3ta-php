<?php
session_start();
require_once "db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Tìm user theo email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 2. Nếu tồn tại user và mật khẩu đúng
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['email'];

        // Chuyển hướng sang dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Sai email hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng nhập</title>
<style>
    body {
        background: linear-gradient(120deg, #84fab0, #8fd3f4);
        font-family: Arial;
    }
    .box {
        width: 400px;
        margin: 120px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0,0,0,0.2);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    input, button {
        width: 100%;
        padding: 10px;
        margin-top: 12px;
    }
    button {
        background: #27ae60;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }
    button:hover {
        background: #219150;
    }
    .error {
        margin-top: 15px;
        text-align: center;
        color: red;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="box">
    <h2>Đăng nhập</h2>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng nhập</button>
    </form>

    <?php if ($message): ?>
        <div class="error"><?= $message ?></div>
    <?php endif; ?>
</div>

</body>
</html>
