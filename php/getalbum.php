<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
    mysqli_select_db($connection,"login"); 
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    $result=mysqli_query($connection, "select * from whenalbum where user_id='$id'");
    $found=array();
    if(mysqli_num_rows($result)>0){
   while($row= mysqli_fetch_assoc($result)){
      $found[]=$row;
   }
    echo json_encode($found);
  }
  
?>