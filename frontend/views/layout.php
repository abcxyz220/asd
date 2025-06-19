<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Trang web' ?></title>
  <!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/72462fd80f.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">🛒 SHOP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($page == 'home') ? 'active' : '' ?>" href="index.php?page=home">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page == 'view-cart') ? 'active' : '' ?>" href="index.php?page=view-cart">Giỏ hàng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page == 'checkout') ? 'active' : '' ?>" href="index.php?page=checkout">Thanh toán</a>
        </li>
        <?php if (isset($_SESSION['admin'])): ?>
        <li class="nav-item">
          <a class="nav-link <?= ($page == 'admin') ? 'active' : '' ?>" href="index.php?page=admin">Quản lý sản phẩm</a>
        </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0">
  <?php if (isset($_SESSION['admin'])): ?>
    <li class="nav-item">
      <span class="navbar-text text-light me-2">
        👋 Xin chào, <?= htmlspecialchars($_SESSION['admin']) ?>
      </span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php?page=logout">Đăng xuất</a>
    </li>
  <?php else: ?>
    <li class="nav-item">
      <a class="nav-link <?= ($page == 'login') ? 'active' : '' ?>" href="index.php?page=login" ?><i class="fa-regular fa-circle-user"></i></a>
    </li>
    <?php endif; ?>
</ul>
    </div>
  </div>
</nav>
  <div class="container mt-4">
    <?= $content ?>
  </div>
</body>
</html>