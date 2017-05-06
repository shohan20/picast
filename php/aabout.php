<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_POST['id'];

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     $result=mysqli_query($connection, "select * from users where id='$userid'"); 
     $found=array();
     $found[] = mysqli_fetch_assoc($result);
     echo json_encode($found);
?>