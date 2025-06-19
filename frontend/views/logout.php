<?php
session_start();
$_SESSION = []; // xoá dữ liệu phiên
session_destroy();
header("Location: index.php");
exit;
