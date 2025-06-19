<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Giỏ hàng</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2 class="mb-4">🛒 Giỏ hàng của bạn</h2>

  <?php if (empty($items)): ?>
    <div class="alert alert-info">Giỏ hàng trống.</div>
  <?php else: ?>
    <form action="index.php?page=update-cart" method="post">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td><img src="uploads/<?= htmlspecialchars($item['image']) ?>" width="60"></td>
              <td><?= htmlspecialchars($item['name']) ?></td>
              <td class="text-danger"><?= number_format((float)$item['price']) ?> VND</td>
              <td style="width:100px">
                <input type="number" name="qty[<?= $item['id'] ?>]" value="<?= (int)$item['qty'] ?>" min="1" class="form-control form-control-sm">
              </td>
              <td class="fw-bold"><?= number_format((float)$item['subtotal']) ?> VND</td>
              <td>
                <a href="index.php?page=remove-from-cart&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này khỏi giỏ?')">Xoá</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="d-flex justify-content-between align-items-center mt-3">
        <button type="submit" class="btn btn-primary">🔄 Cập nhật giỏ hàng</button>
        <h4 class="mb-0">Tổng cộng: <span class="text-danger"><?= number_format((float)$total) ?> VND</span></h4>
      </div>
    </form>

    <div class="text-end mt-3">
      <a href="index.php?page=checkout" class="btn btn-success btn-lg">💳 Thanh toán</a>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
