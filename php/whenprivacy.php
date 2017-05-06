<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $imgid=$_POST['name'];
    $val=$_POST['value'];
   
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     mysqli_query($connection, "UPDATE whenalbum SET privacy=$val where user_id=$userid and whenmodel='$imgid'"); 
  
?>