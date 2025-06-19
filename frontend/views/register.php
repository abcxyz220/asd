<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4" style="max-width: 500px">
  <h2 class="mb-4 text-center">🔐 Đăng ký tài khoản</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post">
  <div class="mb-3">
    <label for="fullname" class="form-label">Họ tên:</label>
    <input type="text" name="fullname" id="fullname" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" name="email" id="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="phone" class="form-label">Số điện thoại:</label>
    <input type="tel" name="phone" id="phone" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="username" class="form-label">Tên đăng nhập:</label>
    <input type="text" name="username" id="username" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Mật khẩu:</label>
    <input type="password" name="password" id="password" class="form-control" required>
    <div class="form-text">
      🔒 Tối thiểu 8 ký tự, có in hoa, số và ký tự đặc biệt.
    </div>
  </div>

  <div class="mb-3">
    <label for="confirm" class="form-label">Nhập lại mật khẩu:</label>
    <input type="password" name="confirm" id="confirm" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-primary w-100" name="register">Đăng ký</button>
  <a href="index.php?page=login" class="d-block mt-3 text-center">Đã có tài khoản? Đăng nhập</a>
</form>

</div>
</body>
</html>
