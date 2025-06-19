<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thanh toán</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2 class="mb-4">🧾 Thanh toán</h2>
  <form method="post" action="index.php?page=checkout">
    <div class="mb-3">
      <label>Họ tên:</label>
      <input type="text" name="fullname" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Số điện thoại:</label>
      <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Địa chỉ:</label>
      <textarea name="address" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Đặt hàng</button>
  </form>
</div>
</body>
</html>
