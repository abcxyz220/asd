<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý sản phẩm</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h2 class="text-center">🔧 Quản lý sản phẩm</h2>
    <a href="index.php?page=logout" class="btn btn-danger float-end">Đăng xuất</a>
    <a href="index.php?page=add-product" class="btn btn-success mb-3">➕ Thêm sản phẩm</a>
    <table class="table table-bordered">
      <thead class="table-dark">
        <tr><th>STT</th><th>Tên</th><th>Giá</th><th>Ảnh</th><th>Hành động</th></tr>
      </thead>
      <tbody>
        <?php foreach ($products as $i => $p): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= $p['name'] ?></td>
          <td><?= number_format($p['price']) ?> VND</td>
          <td><img src="uploads/<?= $p['image'] ?>" width="60"></td>
          <td>
            <a href="index.php?page=edit-product&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
            <a href="index.php?page=delete-product&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xoá?')">Xoá</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>