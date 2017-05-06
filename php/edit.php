<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $imgid=$_POST['name'];
    $val=$_POST['result'];
    $locat=$_POST['location'];

function findi($myfile,$userid,$image_i,$connection,$val,$locat){

    if(file_exists($myfile)){
       
        $image_i=str_replace(pathinfo($myfile, PATHINFO_EXTENSION), "", $image_i);
        $image_i=str_replace(".", "", $image_i);
        $stmt = $connection->prepare("UPDATE uploads SET description=?, location=? where image_id=?")or die("Failed to query database ".mysqli_error($connection));
        $stmt->bind_param('sss',$val,$locat,$image_i);
        $stmt->execute();
         echo $locat;
        //mysqli_query($connection, "UPDATE uploads SET description='$val', location='$locat' where image_id='$image_i'"); 
          
    }
    
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");  
     findi("../upload/".$userid."/".$imgid,$userid,$imgid,$connection,$val,$locat);
     
     // $image_i=str_replace(pathinfo("../upload/".$userid."/".$imgid, PATHINFO_EXTENSION), "", $imgid);
            
       // $image_i=str_replace(".", "", $image_i);
   
     //$result = mysqli_query($connection, "SELECT * FROM uploads where image_id='$image_i'");
     //$row = mysqli_fetch_assoc($result)
     //echo $row['description'];
     
  
?>