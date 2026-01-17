<?php
$host = "localhost";
$dbname = "buoi2_php";
$username = "root";
$password = ""; // ❌ cố tình nhập SAI để test lỗi

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
     
    // Bật chế độ báo lỗi Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Thông báo thân thiện cho người dùng
    die("Hệ thống đang bảo trì, vui lòng quay lại sau");
}
