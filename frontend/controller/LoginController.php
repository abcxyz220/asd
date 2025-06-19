<?php
class LoginController {
  public function login() {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = trim($_POST['username']);
      $password = $_POST['password'];

      try {
        $db = new PDO("mysql:host=localhost;dbname=shopping_carts;charset=utf8", "root", "");
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
          // Kiểm tra nếu là admin
          if ($username === 'admin') {
            $_SESSION['admin'] = $username;
            $_SESSION['success'] = "✅ Đăng nhập quản trị thành công!";
            header("Location: index.php?page=admin");
          } else {
            $_SESSION['user'] = $username;
            $_SESSION['success'] = "✅ Đăng nhập thành công!";
            header("Location: index.php?page=home");
          }
          exit;
        } else {
          $error = '❌ Tên đăng nhập hoặc mật khẩu sai.';
        }

      } catch (PDOException $e) {
        $error = "Lỗi kết nối CSDL: " . $e->getMessage();
      }
    }

    // Giao diện form đăng nhập
    ob_start();
    include 'frontend/views/login.php';
    $content = ob_get_clean();
    $title = 'Đăng nhập';
    include 'frontend/views/layout.php';
  }
}
