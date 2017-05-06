<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $to=$_POST['j'];
    $connection=serverConnect();
     mysqli_select_db($connection,"login"); 
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    mysqli_query($connection, "delete from follow where follow_to='$to' and follow_by='$id'");
  
?>