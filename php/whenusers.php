<?php
  session_start();
    include 'serverConnection.php'; 
   
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
    $result= mysqli_query($connection, "select * from whenalbum inner join users on whenalbum.user_id=users.id where whenalbum.privacy='2'"); 
    $found=array();
    if (mysqli_num_rows($result) > 0) {
    // output data of each row     
     while($row = mysqli_fetch_assoc($result)) {
     	$found[]=$row;
     }
     echo json_encode($found);
 	}
  
?>