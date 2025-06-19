<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm sản phẩm</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h3>➕ Thêm sản phẩm</h3>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Ảnh</label>
        <input type="file" name="image" class="form-control" required>
      </div>
      <button class="btn btn-primary">Thêm</button>
    </form>
  </div>
</body>
</html>