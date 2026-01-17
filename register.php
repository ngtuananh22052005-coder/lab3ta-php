<?php
require_once "db_connect.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $passwordHash]);

        $message = "Đăng ký tài khoản thành công!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $message = "Email đã tồn tại, vui lòng dùng email khác!";
        } else {
            $message = "Có lỗi xảy ra, vui lòng thử lại sau!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng ký tài khoản</title>
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        font-family: Arial, sans-serif;
    }
    .box {
        width: 400px;
        margin: 120px auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    input, button {
        width: 100%;
        padding: 12px;
        margin-top: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    button {
        background: #667eea;
        color: white;
        border: none;
        font-weight: bold;
        cursor: pointer;
    }
    button:hover {
        background: #5a67d8;
    }
    .success {
        margin-top: 15px;
        color: green;
        text-align: center;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="box">
    <h2>Đăng ký</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Tạo tài khoản</button>
    </form>

    <?php if ($message): ?>
        <div class="success"><?= $message ?></div>
    <?php endif; ?>
</div>

</body>
</html>
