<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sửa sản phẩm</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h3>✏️ Sửa sản phẩm</h3>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" value="<?= $product['price'] ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Ảnh hiện tại</label><br>
        <img src="uploads/<?= $product['image'] ?>" width="100"><br>
        <input type="file" name="image" class="form-control mt-2">
      </div>
      <button class="btn btn-primary">Lưu</button>
    </form>
  </div>
</body>
</html>