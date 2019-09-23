<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
	 header('Location: login.php');

}else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == "true") {
    // At any time we can logout by sending a "logout" value which will unset the "is_auth" flag.
    // We can also destroy the session if so desired.
    unset($_SESSION['is_auth']);
    session_destroy();
 
    // After logout, send them back to login.php
    header("location: login.php");
    exit;
}
?>
<html>
<head>
	<title>trang chủ</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Chúc mừng bạn có username là <?php echo $_SESSION['username'];  ?> đã đăng nhập thành công !</h1>
	<h2><a href="login.php">Logout</a></h2>
</body>
</html>