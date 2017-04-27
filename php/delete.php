<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $delete=$_POST["result"];
function findi($myfile,$userid,$image_i,$connection){

    if(file_exists($myfile)){
        unlink($myfile);

        $image_i=str_replace(pathinfo($myfile, PATHINFO_EXTENSION), "", $image_i);
        mysqli_query($connection, "DELETE FROM uploads WHERE image_id='$image_i'");
    }
    
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     $image=findi("../upload/".$userid."/".$delete,$userid,$delete,$connection);
   // echo json_encode(array('1'));
?>