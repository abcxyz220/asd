<?php
class RegisterController {
  public function register() {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = trim($_POST['username']);
      $password = $_POST['password'];
      $confirm = $_POST['confirm'];
      $fullname = trim($_POST['fullname']);
      $email = trim($_POST['email']);
      $phone = trim($_POST['phone']);
      
      // Kiểm tra điều kiện mật khẩu
      if (strlen($password) < 8 || strlen($password) > 20) {
        $error = '❌ Mật khẩu phải từ 8 đến 20 ký tự.';
      } elseif (!preg_match('/[A-Z]/', $password)) {
        $error = '❌ Mật khẩu cần ít nhất 1 chữ in hoa.';
      } elseif (!preg_match('/[\W_]/', $password)) {
        $error = '❌ Mật khẩu cần ít nhất 1 ký tự đặc biệt.';
      } elseif (!preg_match('/[0-9]/', $password)) {
        $error = '❌ Mật khẩu cần ít nhất 1 số.';
      } elseif ($password !== $confirm) {
        $error = '❌ Mật khẩu xác nhận không khớp.';
      } else {
        try {
          $db = new PDO("mysql:host=localhost;dbname=shopping_carts;charset=utf8", "root", "");
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // Kiểm tra trùng username
          $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
          $stmt->execute([$username]);
          if ($stmt->fetch()) {
            $error = '❌ Tên đăng nhập đã tồn tại.';
          } else {
            // Thêm user đầy đủ thông tin
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO users(username, password, fullname, email, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $hashedPassword, $fullname, $email, $phone]);

            echo "<script>alert('✅ Đăng ký thành công!'); location.href='index.php?page=login';</script>";
            exit;
          }
        } catch (PDOException $e) {
          $error = 'Lỗi kết nối DB: ' . $e->getMessage();
        }
      }
    }

    include 'frontend/views/register.php';
  }
}
