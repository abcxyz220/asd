<?php
class ForgotPasswordController {
  public function forgotPassword() {
    $message = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = trim($_POST['email']);

      try {
        $db = new PDO("mysql:host=localhost;dbname=shopping_carts;charset=utf8", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
          // Giả lập mã OTP (ở thực tế nên gửi mail hoặc mã xác thực)
          $resetCode = rand(100000, 999999);
          $_SESSION['reset_code'] = $resetCode;
          $_SESSION['reset_email'] = $email;

          $message = "✅ Mã khôi phục của bạn là: <strong>$resetCode</strong> (dùng để đổi mật khẩu)";
        } else {
          $message = '❌ Email không tồn tại trong hệ thống.';
        }

      } catch (PDOException $e) {
        $message = 'Lỗi: ' . $e->getMessage();
      }
    }

    $title = "Quên mật khẩu";
    ob_start();
    include 'frontend/views/forgot_password.php';
    $content = ob_get_clean();
    include 'frontend/views/layout.php';
  }

  public function resetPassword() {
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $code = trim($_POST['code']);
      $newPass = $_POST['new_password'];
      $confirm = $_POST['confirm_password'];

      if (!isset($_SESSION['reset_code']) || !isset($_SESSION['reset_email'])) {
        $message = "❌ Phiên đặt lại đã hết hạn.";
      } elseif ($code != $_SESSION['reset_code']) {
        $message = "❌ Mã khôi phục không đúng.";
      } elseif ($newPass !== $confirm) {
        $message = "❌ Mật khẩu xác nhận không khớp.";
      } elseif (strlen($newPass) < 8) {
        $message = "❌ Mật khẩu quá ngắn (tối thiểu 8 ký tự).";
      } else {
        try {
          $hashed = password_hash($newPass, PASSWORD_DEFAULT);
          $db = new PDO("mysql:host=localhost;dbname=shopping_carts;charset=utf8", "root", "");
          $stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
          $stmt->execute([$hashed, $_SESSION['reset_email']]);

          unset($_SESSION['reset_code'], $_SESSION['reset_email']);

          echo "<script>alert('✅ Mật khẩu đã được đổi!'); location.href='index.php?page=login';</script>";
          exit;
        } catch (PDOException $e) {
          $message = 'Lỗi DB: ' . $e->getMessage();
        }
      }
    }

    $title = "Đặt lại mật khẩu";
    ob_start();
    include 'frontend/views/reset-password.php';
    $content = ob_get_clean();
    include 'frontend/views/layout.php';
  }
}
