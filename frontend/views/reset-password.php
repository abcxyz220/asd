<div class="card shadow-sm mx-auto" style="max-width: 500px;">
  <div class="card-body">
    <h3 class="mb-3 text-center">🔁 Đặt lại mật khẩu</h3>

    <?php if (!empty($message)): ?>
      <div class="alert alert-warning"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Mã xác minh:</label>
        <input type="text" name="code" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Mật khẩu mới:</label>
        <input type="password" name="new_password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Nhập lại mật khẩu:</label>
        <input type="password" name="confirm_password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Đặt lại mật khẩu</button>
    </form>
  </div>
</div>
