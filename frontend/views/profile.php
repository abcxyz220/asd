<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php?page=login");
  exit;
}

$db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Hồ sơ người dùng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>👤 Hồ sơ cá nhân</h2>
  <table class="table table-bordered mt-3">
    <tr><th>Họ tên</th><td><?= htmlspecialchars($user['fullname']) ?></td></tr>
    <tr><th>Email</th><td><?= htmlspecialchars($user['email']) ?></td></tr>
    <tr><th>Số điện thoại</th><td><?= htmlspecialchars($user['phone']) ?></td></tr>
    <tr><th>Tên đăng nhập</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
    <tr><th>Ngày tạo</th><td><?= $user['created_at'] ?></td></tr>
  </table>
</div>
</body>
</html>
