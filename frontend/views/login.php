<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="text-center mb-3">Đăng nhập</h3>
            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST" action="index.php?page=login">
              <div class="mb-3">
                <label class="form-label">Tài khoản</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="index.php?page=forgot-password" class="small">Quên mật khẩu?</a>
              </div>

              <button type="submit" name="login" class="btn btn-primary w-100">Đăng nhập</button>
              <a href="index.php?page=register" class="btn btn-link w-100 mt-2">Chưa có tài khoản?</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
