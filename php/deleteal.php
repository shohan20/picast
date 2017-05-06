<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $path=$_POST['src'];
  foreach(glob("../whentmp/".$userid."/".$path.".*") as $filename){
        unlink($filename);
      }
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");
   
    mysqli_query($connection, "DELETE FROM uploads WHERE user_id='$userid' and image_id='$path'");
?>