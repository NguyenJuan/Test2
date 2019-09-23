<?php
	$conn = mysqli_connect('localhost','root','');
	mysqli_select_db($conn,'demo1');
	if (!$conn) {
    echo("Connection failed: " . mysqli_connect_error());
}
	
?>