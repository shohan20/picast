<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_SESSION['id'];
    $whenmodel=$_POST['whenmodel'];
function findimage($myfile,$userid,$image_i){
    foreach(glob("../whentmp/".$userid."/".$image_i.".*") as $filename){

                 $supported_file = array( 'gif','jpg','jpeg','png');
                 $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (in_array($ext, $supported_file)) {
                    return basename($filename);
                 }
            
     }
     return "false";
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");
    $found=array();
    $result = mysqli_query($connection, "SELECT * FROM uploads where user_id='$userid' and whentmp='1' and whenmodel='$whenmodel' ORDER BY time DESC;")or die("Failed to query database ".mysqli_error($connection));
    if (mysqli_num_rows($result) > 0) {
    // output data of each row     
     while($row = mysqli_fetch_assoc($result)) {
            $image=findimage("../whentmp/".$userid."/".$row['image_id'],$userid,$row['image_id'])or die("Failed to query database ".mysqli_error($connection));
           if($image!=="false"){
                $row['image_id']="whentmp/".$userid."/".$image;
               $found[]=$row;
           }
        }
        mysqli_query($connection, "UPDATE uploads SET whentmp='2' where user_id='$userid' and whentmp='1' and whenmodel='$whenmodel';")or die("Failed to query database ".mysqli_error($connection));
         echo json_encode($found);
    } 
   // echo json_encode(array('1'));
?>