<?php
session_start();
$page = $_GET['page'] ?? 'home';

switch ($page) {
  // Đăng xuất (đặt đầu tiên hoặc trước khi bị break)
  case 'logout':
    session_destroy();
    header("Location: index.php?page=login");
    exit;

  // Trang chủ
  case 'home':
    require_once 'frontend/models/Product.php';
    $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
    $productModel = new Product($db);
    $products = $productModel->getAll();

    ob_start();
    include 'frontend/views/home.php';
    $content = ob_get_clean();
    $title = "Trang chủ";
    include 'frontend/views/layout.php';
    break;

    // Đăng xuất
case 'logout':
  session_start();
  session_destroy();
  header("Location: index.php?page=login");
  exit;


  // Đăng nhập
  case 'login':
  require 'frontend/controller/LoginController.php';
  $controller = new LoginController();
  $controller->login();
  break;

  // Đăng ký
  case 'register':
  require_once __DIR__ . '/frontend/controller/RegisterController.php';
  $controller = new RegisterController();
  $controller->register();
  break;

  case 'forgot-password':
  require 'frontend/controller/ForgotPasswordController.php';
  $controller = new ForgotPasswordController();
  $controller->forgotPassword();
  break;

case 'reset-password':
  require 'frontend/controller/ForgotPasswordController.php';
  $controller = new ForgotPasswordController();
  $controller->resetPassword();
  break;



  // Trang admin
  case 'admin':
    if (!isset($_SESSION['admin'])) {
      header("Location: index.php?page=login");
      exit;
    }

    require 'frontend/models/Product.php';
    $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
    $productModel = new Product($db);
    $products = $productModel->getAll();
    include 'frontend/views/admin.php';
    break;

  // Thêm sản phẩm
  case 'add-product':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $image = $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);

      $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
      $stmt = $db->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
      $stmt->execute([$name, $price, $image]);

      header("Location: index.php?page=admin");
    } else {
      include 'frontend/views/add_product.php';
    }
    break;

  // Sửa sản phẩm
  case 'edit-product':
    $id = $_GET['id'];
    $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $image = $_FILES['image']['name'];

      if (!empty($image)) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
      } else {
        $stmt = $db->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $image = $stmt->fetchColumn();
      }

      $stmt = $db->prepare("UPDATE products SET name=?, price=?, image=? WHERE id=?");
      $stmt->execute([$name, $price, $image, $id]);
      header("Location: index.php?page=admin");
    } else {
      $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
      $stmt->execute([$id]);
      $product = $stmt->fetch(PDO::FETCH_ASSOC);
      include 'frontend/views/edit_product.php';
    }
    break;

  // Xoá sản phẩm
  case 'delete-product':
    $id = $_GET['id'] ?? 0;
    $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
    $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?page=admin");
    break;

  // Chi tiết sản phẩm
  case 'product-detail':
    require 'frontend/models/Product.php';
    $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
    $productModel = new Product($db);
    $product = $productModel->getById($_GET['id']);
    include 'frontend/views/product_detail.php';
    break;

  // Thêm vào giỏ hàng
  case 'add-to-cart':
    $id = $_GET['id'] ?? 0;

    // Nếu chưa có giỏ hàng thì khởi tạo
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Nếu giá trị hiện tại không phải số thì gán = 1
    if (!isset($_SESSION['cart'][$id]) || !is_numeric($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }

    header("Location: index.php?page=view-cart");
    break;


  // Xem giỏ hàng
 case 'view-cart':
    require 'frontend/models/Product.php';
    $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
    $productModel = new Product($db);
    $cart = $_SESSION['cart'] ?? [];
    $items = [];
    $total = 0;

    foreach ($cart as $id => $qty) {
        $p = $productModel->getById($id);
        if (!is_array($p) || !isset($p['price']) || !is_numeric($p['price'])) continue;

        $p['qty'] = (int)$qty;
        $p['price'] = (float)$p['price'];
        $p['subtotal'] = $p['qty'] * $p['price'];
        $total += $p['subtotal'];
        $items[] = $p;
    }

    ob_start();
    include 'frontend/views/cart.php';
    $content = ob_get_clean();
    $title = "Giỏ hàng";
    include 'frontend/views/layout.php';
    break;


    case 'update-cart':
    foreach ($_POST['qty'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = (int)$qty;
        }
    }
    header("Location: index.php?page=view-cart");
    break;

    case 'remove-from-cart':
    $id = $_GET['id'] ?? 0;
    unset($_SESSION['cart'][$id]);
    header("Location: index.php?page=view-cart");
    break;

     case 'checkout':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $cart = $_SESSION['cart'] ?? [];

        if (empty($cart)) {
            echo "<script>alert('Giỏ hàng rỗng'); location.href='index.php';</script>";
            exit;
        }

        require 'frontend/models/Product.php';
        $db = new PDO("mysql:host=localhost;dbname=shopping_cart;charset=utf8", "root", "");
        $productModel = new Product($db);

        $total = 0;
        $orderItems = [];

        foreach ($cart as $id => $qty) {
            $p = $productModel->getById($id);
            if ($p && isset($p['price'])) {
                $price = (float)$p['price'];
                $orderItems[] = ['id' => $id, 'qty' => $qty, 'price' => $price];
                $total += $qty * $price;
            }
        }

        // 💡 INSERT đơn hàng
        $stmt = $db->prepare("INSERT INTO orders (fullname, phone, address, total) VALUES (?, ?, ?, ?)");
        $orderId = $db->lastInsertId();

        // 💡 INSERT chi tiết từng sản phẩm
        $stmtDetail = $db->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($orderItems as $item) {
        }

        unset($_SESSION['cart']);
        echo "<script>alert('✅ Đặt hàng thành công!'); location.href='index.php';</script>";
    } else {
        ob_start();
        include 'frontend/views/checkout.php';
        $content = ob_get_clean();
        $title = "Thanh toán";
        include 'frontend/views/layout.php';
    }
    break;
  }