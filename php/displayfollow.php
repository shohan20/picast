<?php
  session_start();
    include 'serverConnection.php'; 
    $userid=$_POST['id'];
function findimage($myfile,$userid,$image_i){
    foreach(glob("../upload/".$userid."/".$image_i.".*") as $filename){

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
    $result = mysqli_query($connection, "SELECT * FROM uploads where user_id='$userid' and privacy='2' ORDER BY time DESC;");
    if (mysqli_num_rows($result) > 0) {
    // output data of each row     
     while($row = mysqli_fetch_assoc($result)) {
            $image=findimage("../upload/".$userid."/".$row['image_id'],$userid,$row['image_id']);
           if($image!=="false"){
                $row['image_id']=$image;
               $found[]=$row;
           }
        }
         echo json_encode($found);
    } 
   // echo json_encode(array('1'));
?>