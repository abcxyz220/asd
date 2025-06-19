<div class="card shadow-sm mx-auto" style="max-width: 500px;">
  <div class="card-body">
    <h3 class="mb-3 text-center">🔐 Quên mật khẩu</h3>

    <?php if (!empty($message)): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Email đã đăng ký:</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Gửi mã khôi phục</button>
      <a href="index.php?page=reset-password" class="btn btn-link w-100 mt-2">Tôi đã có mã khôi phục</a>
    </form>
  </div>
</div>
