<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
    $result=mysqli_query($connection, "select * from users where id='$userid'");
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found); 
  
?>