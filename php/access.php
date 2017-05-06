<?php
	session_start();
	include 'serverConnection.php';
	$id =$_SESSION['id'];
	$connection=serverConnect();
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	$result = mysqli_query($connection,"select * from users where id='$id'") or die("Failed to query database ".mysqli_error($connection));
	
	$row = mysqli_fetch_assoc($result);
	echo $row['whencast'];
?>