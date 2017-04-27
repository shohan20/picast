<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $val=$_POST['password'];

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
    mysqli_query($connection, "UPDATE users SET password='$val' where id='$userid'");
     
?>