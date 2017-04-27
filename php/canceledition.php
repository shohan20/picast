<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $imgid=$_POST['name'];
function findi($myfile,$userid,$image_i,$connection){

    if(file_exists($myfile)){
       
        $image_i=str_replace(pathinfo($myfile, PATHINFO_EXTENSION), "", $image_i);
        $image_i=str_replace(".", "", $image_i);
        $result=mysqli_query($connection, "select * from uploads where image_id='$image_i'"); 
        return $result; 
    }
    
}
   

    $connection=serverConnect();
      $found=array();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
    $result= findi("../upload/".$userid."/".$imgid,$userid,$imgid,$connection);
      while($row= mysqli_fetch_assoc($result)){
            $found[]=$row;
      } 
      echo json_encode($found);
     // $image_i=str_replace(pathinfo("../upload/".$userid."/".$imgid, PATHINFO_EXTENSION), "", $imgid);
            
       // $image_i=str_replace(".", "", $image_i);
   
     //$result = mysqli_query($connection, "SELECT * FROM uploads where image_id='$image_i'");
     //$row = mysqli_fetch_assoc($result)
     //echo $row['description'];
     
  
?>