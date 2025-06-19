<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
  <div class="container mt-4">
    <h3>🔍 Chi tiết sản phẩm</h3>
    <div class="row">
      <div class="col-md-6">
        <img src="uploads/<?= $product['image'] ?>" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h4><?= $product['name'] ?></h4>
        <p class="text-danger fw-bold"><?= number_format($product['price']) ?> VND</p>
        <a href="index.php?page=add-to-cart&id=<?= $product['id'] ?>" class="btn btn-primary">Thêm vào giỏ</a>
      </div>
    </div>
    <a href="index.php" class="btn btn-secondary mt-3">← Quay lại</a>
  </div>
</body>
</html>
