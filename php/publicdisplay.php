<?php
    include 'serverConnection.php'; 
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

function finduimg($uimag){
       foreach(glob("../user/".$uimag.".*") as $filenamei){

                 $supported_file = array( 'gif','jpg','jpeg','png');
                 $ext = strtolower(pathinfo($filenamei, PATHINFO_EXTENSION));
                if (in_array($ext, $supported_file)) {
                    return basename($filenamei);
                 }
            
     }
     return "false";
}
   

    $connection=serverConnect();
    //$connection= mysqli_connect("localhost", "root", "abcd");
    mysqli_select_db($connection,"login");
    $found=array();
    $result = mysqli_query($connection, "SELECT uploads.user_id,uploads.image_id,uploads.privacy,uploads.description, uploads.time ,users.username,users.email FROM uploads inner JOIN users ON (users.id=uploads.user_id) and uploads.privacy=2 ORDER BY uploads.time DESC;");
    if (mysqli_num_rows($result) > 0) {
    // output data of each row     
     while($row = mysqli_fetch_assoc($result)) {
            $image=findimage("../upload/".$row['user_id']."/".$row['image_id'],$row['user_id'],$row['image_id']);
            $uimage=finduimg($row['user_id']);
           if($image!=="false"){
                $row['image_id']=$image;
                $row['email']=$uimage;
               $found[]=$row;
           }
        }
         echo json_encode($found);
    } 
   // echo json_encode(array('1'));
?>