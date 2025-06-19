<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .product-card {
      height: 100%;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      background: #fff;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .product-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .product-body {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 15px;
    }
    .discount-badge {
      position: absolute;
      top: 10px;
      left: 10px;
      background: red;
      color: white;
      padding: 5px 10px;
      font-size: 0.8rem;
      border-radius: 5px;
    }
    .card-wrapper {
      position: relative;
    }
  </style>
</head>
<body>
<div class="container mt-4">
  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $_SESSION['success'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <h2 class="text-center mb-4">🛍️ Sản phẩm nổi bật</h2>
  <div class="row g-4">
    <?php foreach ($products as $p): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card-wrapper">
          <div class="discount-badge">-10%</div> <!-- Nhãn giảm giá -->
          <div class="product-card">
            <img src="uploads/<?= $p['image'] ?>" class="product-img" alt="<?= $p['name'] ?>">
            <div class="product-body">
              <div>
                <h5 class="card-title text-center"><?= $p['name'] ?></h5>
                <p class="card-text text-danger fw-bold text-center">
                  <?= number_format($p['price']) ?> VND
                </p>
              </div>
              <a href="index.php?page=add-to-cart&id=<?= $p['id'] ?>" class="btn btn-success w-100">Thêm vào giỏ</a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
