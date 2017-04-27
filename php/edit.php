<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $imgid=$_POST['name'];
    $val=$_POST['result'];
function findi($myfile,$userid,$image_i,$connection,$val){

    if(file_exists($myfile)){
       
        $image_i=str_replace(pathinfo($myfile, PATHINFO_EXTENSION), "", $image_i);
        $image_i=str_replace(".", "", $image_i);
        mysqli_query($connection, "UPDATE uploads SET description='$val' where image_id='$image_i'"); 
          
    }
    
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     findi("../upload/".$userid."/".$imgid,$userid,$imgid,$connection,$val);
      
     // $image_i=str_replace(pathinfo("../upload/".$userid."/".$imgid, PATHINFO_EXTENSION), "", $imgid);
            
       // $image_i=str_replace(".", "", $image_i);
   
     //$result = mysqli_query($connection, "SELECT * FROM uploads where image_id='$image_i'");
     //$row = mysqli_fetch_assoc($result)
     //echo $row['description'];
     
  
?>