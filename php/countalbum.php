<?php
  session_start();
    include 'serverConnection.php';
    $id=$_POST['id'];
    $connection=serverConnect();
    mysqli_select_db($connection,"login"); 
    //$connection= mysqli_connect("localhost", "root", "abcd");
   
    $result=mysqli_query($connection, "select count(user_id) as number from whenalbum where user_id='$id' and privacy='2'");
    if(mysqli_num_rows($result)>0){
   $row= mysqli_fetch_assoc($result);
    echo $row['number'];
  }
  else
    echo "0";
  
?>