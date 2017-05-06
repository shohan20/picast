<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $path=$_POST['src'];
 
    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");
    $result=mysqli_query($connection,"select * from uploads WHERE user_id='$userid' and whenmodel='$path'")or die("Failed to query database ".mysqli_error($connection));
  if (mysqli_num_rows($result) > 0) {
    // output data of each row     
  while($row = mysqli_fetch_assoc($result)) {
    foreach(glob("../whentmp/".$userid."/".$row['image_id'].".*") as $filename){
        unlink($filename);
      }
    }
  }
    mysqli_query($connection, "DELETE FROM uploads WHERE user_id='$userid' and whenmodel='$path'")or die("Failed to query database ".mysqli_error($connection));
    mysqli_query($connection, "DELETE FROM whenalbum WHERE user_id='$userid' and whenmodel='$path'")or die("Failed to query database ".mysqli_error($connection));
?>