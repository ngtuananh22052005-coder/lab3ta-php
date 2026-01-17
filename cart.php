<?php
session_start();

// Danh sách sản phẩm (hardcode)
$products = [
    1 => "Áo thun",
    2 => "Quần jeans",
    3 => "Giày sneaker",
    4 => "Balo"
];

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Thêm sản phẩm vào giỏ
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $_SESSION['cart'][] = $id;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Giỏ hàng</title>
<style>
    body {
        font-family: Arial;
        background: #eef2f3;
    }
    .box {
        width: 600px;
        margin: 50px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
    }
    a {
        margin-left: 10px;
        text-decoration: none;
        color: blue;
    }
</style>
</head>
<body>

<div class="box">
    <h2>Danh sách sản phẩm</h2>
    <ul>
        <?php foreach ($products as $id => $name): ?>
            <li>
                <?= $name ?>
                <a href="?add=<?= $id ?>">[Thêm vào giỏ]</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <hr>

    <h3>Giỏ hàng của bạn</h3>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Giỏ hàng trống</p>
    <?php else: ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <li><?= $products[$item] ?> (ID: <?= $item ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

</body>
</html>

