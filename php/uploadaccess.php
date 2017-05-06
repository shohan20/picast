<?php
	session_start();
	include 'serverConnection.php';
	$id =$_SESSION['id'];
	$whencast=$_POST['whencast'];
	$cast_id=$_POST['cast_id'];
	$connection=serverConnect();
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	$stmt = $connection->prepare("update users set whencast= ?, cast_id=? where id='$id'")or die("Failed to query database ".mysqli_error($connection));
	$stmt->bind_param('ss',$whencast,$cast_id);
	$stmt->execute();
	$_SESSION['whencast']=$whencast;
	$_SESSION['cast_id']=$cast_id;
?>