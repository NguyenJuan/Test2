<?php
session_start();

// $url = "http://localhost/test/test1/login.php/";
 
//   // Xóa ký tự không hợp lệ khỏi URL
//   $urls = filter_var($url, FILTER_SANITIZE_URL);
?>
<html>
<head>
	<title>Trang đăng nhập</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	//kết nối database
	$conn = mysqli_connect('localhost','root','','demo1');
	mysqli_select_db($conn,'demo1');
	if (!$conn) {
		echo("Connection failed: " . mysqli_connect_error());
	}
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["btn_submit"])) {
		$error = array();
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];
		//lọc bỏ ,xóa tất cả các thẻ HTML khỏi chuỗi
		$username= filter_var($username, FILTER_SANITIZE_STRING);
		// loại bỏ dau cách
		$username= trim($_POST['username']);
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if (empty($username) || empty($password)) {
			$error['username']= "username hoặc password bạn không được để trống!";
		}else{
			if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
				$error['username1'] = "Only letters,numbers and white space allowed";
			}else{
				$sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' ";
				$check = mysqli_query($conn, $sql) ; 
				if (mysqli_num_rows($check) == 1) {
					$_SESSION['username'] = $username;
					header('Location: login1.php');
				}

				else{
				$error['loginstatus']="tên đăng nhập hoặc mật khẩu không đúng !";
				//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
				
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php

			}

			}
		}
	}
	?>
	<form method="POST" action="login.php">
		<fieldset>
			<h1 align="center" style="color:#FF0000;">Đăng Nhập </h1>
			<table align="center">
				<?php
				if(!empty($error['username'])){
					?>
					<tr>
						<td colspan="2" style="background-color:#FF0000"><?php echo $error['username'] ?></td>
					</tr>
					<?php
				}
				?>
				<?php
				if(!empty($error['username1'])){
					?>
					<tr>
						<td colspan="2" style="background-color:#FF0000"><?php echo $error['username1'] ?></td>
					</tr>
					<?php
				}
				?>
				<?php
				if(!empty($error['loginstatus'])){
					?>
					<tr>
						<td colspan="2" style="background-color:#FF0000"><?php echo $error['loginstatus'] ?></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" size="30"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" size="30"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"> <input name="btn_submit" type="submit" value="Đăng nhập"></td>
				</tr>
				<tr ></tr>

				<tr>
					<td colspan="2" align="center"> Chưa có tài khoản?<a href="register.php">Đăng ký</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><a href="changePass.php">Đổi mật khẩu</td>
						</tr>

					</table>
					<h4 style="float:right;margin-right:30px;">33.Nguyen Van Luan.AT120633</h4>
				</fieldset>
			</form>
		</body>
		</html>