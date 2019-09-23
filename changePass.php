<script language='JavaScript' type='text/javascript'>
	function actionForm()
	{
		alert("......");	
	}
</script>
<?php
  include("lib/connect.php");
	if(isset($_POST["ok"]))
    
	{
    $error = array();
		if($_POST["username"]==NULL or $_POST["password"]==NUll){
			echo'<p style="color:red">Bạn hãy nhập user và mật khẩu</p>';
		}
		else{
			$username = $_POST["username"];
			$password = $_POST["password"];
			$password1 = $_POST["password1"];
			// echo $username.' '.$password;
      $sql_doimk = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password' limit 1";
      $check = mysqli_query($conn, $sql_doimk);
      if (mysqli_num_rows($check) == 0) {
        $error['username']='Sai tài khoản or mật khẩu vui lòng nhập lại';

      }
      else{
        $sql= "UPDATE `users` SET password = '$password1' WHERE username = '$username' AND password = '$password' ";
        mysqli_query($conn, $sql);
         $error['change']='chúc mừng bạn đã thay đổi thành công';
      }
      
     
}
}
?>			
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Đổi mật khẩu</title>

</head>

<body>
 <fieldset>
<h1 align="center" style="color:#FF0000">Đổi Mật Khẩu</h1>
<div align="center">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
  <table width="400" height="224" border="0">
    <?php
        if(!empty($error['change'])){
          ?>
          <tr>
            <td colspan="2" style="background-color:#FF0000"><?php echo $error['change'] ?></td>
          </tr>
          <?php
        }
        ?>
        <?php
        if(!empty($error['username'])){
          ?>
          <tr>
            <td colspan="2" style="background-color:#FF0000"><?php echo $error['username'] ?></td>
          </tr>
          <?php
        }
        ?>
    <tr>
      <td width="133">Tên đăng nhập:</td>
      <td width="195"><input type="text" name="username" value="" /></td>
      </tr>
    <tr>
      <td>Mật Khẩu cũ:</td>
      <td><input type="password" name="password" value="" /></td>
      </tr>
    <tr>
      <td>Mật khẩu mới:</td>
      <td><input type="password" name="password1" value="" /></td>
      </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="ok" value="Change" />
      </div></td>
      </tr>
      <tr>
            <td colspan="2" align="center"> Home---><a href="login.php">Đăng Nhập</td>
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