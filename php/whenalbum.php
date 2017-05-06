<?php
	
	include 'serverConnection.php';
	$connection=serverConnect();
	session_start();
	$whenmodel = $_POST['whenmodel'];
	$album_name=$_POST['name'];
	$user_id= $_SESSION['id'];
	//$connection= mysqli_connect("localhost", "root", "abcd");
	mysqli_select_db($connection,"login");
	$result = mysqli_query($connection,"select * from whenalbum where user_id='$user_id' and whenmodel='$whenmodel'") or die("Failed to query database ".mysqli_error($connection));
	
	if (mysqli_num_rows($result) <= 0){

	mysqli_query($connection,"insert into whenalbum(user_id,whenmodel,privacy,album_name) values('$user_id','$whenmodel','1','$album_name')") or die("Failed to query database ".mysqli_error($connection));
		echo "1";
	}
	else{
		$row=mysqli_fetch_assoc($result);
		echo $row['privacy'];
	}

?>
