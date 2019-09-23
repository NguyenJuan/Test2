<?php
// require("lib/connect.php"); 
$conn = mysqli_connect('localhost','root','','demo1');
mysqli_select_db($conn,'demo1');
if (!$conn) {
  echo("Connection failed: " . mysqli_connect_error());
}
// //kiểm tra url
// $url = "http://localhost/test/test1/register.php";

// // xóa bỏ các ký tự ko hợp lệ khoi url
// $url = filter_var($url, FILTER_SANITIZE_URL);

// Cho một URL
  // $url = "http://localhost/test/test1/register.php/";
 
  // // Xóa ký tự không hợp lệ khỏi URL
  // $urls = filter_var($url, FILTER_SANITIZE_URL);

if(isset($_POST['ok'])){
  $error = array();
  $alert = array();
  //kiểm tra username
  if(!empty($_POST['username'])){
    $username = $_POST['username'];
    $username= trim($_POST['username']);
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($partten ,$_POST['username'], $matchs))
     $error['username'] = "Username bạn vừa nhập không đúng định dạng ";
 }else{
  $error['username'] = "Không được để trống username!" ;
}
// kiểm tra mật khẩu
if(!empty($_POST['password'])){
  $password = md5($_POST['password']);
  $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
  if(!preg_match($partten ,$_POST['password'], $matchs))
   $error['password']="Mật khẩu bạn vừa nhập không đúng định dạng ";
}else{
  $error['password'] = "Không được để trống password!";
}
//kiểm tra email
if(!empty($_POST['email'])){
  $email= $_POST['email'];
  // // xóa tất cả các ký tự ko hop le khoi email

  if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  } else {
    $error['email']=("$email is not a valid email address");
  }
}else{
  $error['email'] = "Không được để trống email!";
}


//kiem tra database xem có username trùng nào ko
if(empty($error)){
  $checkUser1 = "SELECT * FROM `users` WHERE `username` = '$username'";
  $checkUser = mysqli_query($conn, $checkUser1);
  if(mysqli_num_rows($checkUser) > 0){
   $error['not_success'] = "tài khoản đã tồn tại trên hệ thống";
 }else{
  $sql = "INSERT INTO `users` (username, password, email) VALUES ('$username', '$password', '$email')";//chèn dữ liệu vào database
  if(mysqli_query($conn, $sql)){
    $alert['success'] = 'Đăng kí tài khoản thanh công!';
  }
}
}
}
?>			
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Form đăng ký</title>

</head>

<body>
  <fieldset>
    <div align="center">
     <form action="" method="post">

      <h1 align="center" style="color:#FF0000;">Đăng Ký</h1>
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
        if(!empty($error['password'])){
          ?>
          <tr>
            <td colspan="2" style="background-color:#FF0000"><?php echo $error['password'] ?></td>
          </tr>
          <?php
        }
        ?>
        <?php
        if(!empty($error['email'])){
          ?>
          <tr>
            <td colspan="2" style="background-color:#FF0000"><?php echo $error['email'] ?></td>
          </tr>
          <?php
        }
        ?>
        <?php
        if(!empty($error['not_success'])){
          ?>
          <tr>
            <td colspan="2" style="background-color:#FF0000"><?php echo $error['not_success'] ?></td>
          </tr>
          <?php
        }
        ?>
        <?php
        if(!empty($alert['success'])){
          ?>
          <tr>
            <td colspan="2" style="background-color:green"><?php echo $alert['success'] ?></td>
          </tr>
          <?php
        }
        ?>

        <tr>
          <td >Tên đăng nhập:</td>
          <td ><input type="text" name="username" value="" /></td>
        </tr>
        <tr>
          <td>Mật Khẩu:</td>
          <td><input type="password" name="password" value="" /></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="text" name="email" value="" /></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
            <input type="submit" name="ok" value="Đăng Ký" />
          </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center"> Đã có tài khoản><a href="login.php">Đăng Nhập</td>
          </tr>
        </table>

      </form>
    </div>
    <div style="margin-left:500px; color:#F00"> 	
    </div>
    <h4 style="float:right;margin-right:30px;">33.Nguyen Van Luan.AT120633</h4>
  </fieldset>
</body>
</html>