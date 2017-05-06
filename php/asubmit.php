<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $val=$_POST['name'];

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
    mysqli_query($connection, "UPDATE users SET about='$val' where id='$userid'");
    $_SESSION['about']=$val;
     
?>