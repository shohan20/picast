<?php
	
	include 'serverConnection.php';
	$connection=serverConnect();
	session_start();
	$whenmodel = $_POST['whenmodel'];
	$album_name=$_POST['name'];
	$user_id= $_SESSION['id'];
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");


	mysqli_query($connection,"update whenalbum set album_name='$album_name' where user_id='$user_id' and whenmodel='$whenmodel'") or die("Failed to query database ".mysqli_error($connection));
	
	

?>
