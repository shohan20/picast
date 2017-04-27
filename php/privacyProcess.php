<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $imgid=$_POST['name'];
    $val=$_POST['value'];
function findi($myfile,$userid,$image_i,$connection,$val){

    if(file_exists($myfile)){
        $image_i=str_replace(pathinfo($myfile, PATHINFO_EXTENSION), "", $image_i);
        $image_i=str_replace(".", "", $image_i);
        mysqli_query($connection, "UPDATE uploads SET privacy=$val where image_id='$image_i'");   
    }
    
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     $image=findi("../upload/".$userid."/".$imgid,$userid,$imgid,$connection,$val);
  
?>