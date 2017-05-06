<?php
  session_start();
    include 'serverConnection.php';
    $id=$_SESSION['id'];
    $connection=serverConnect();
    mysqli_select_db($connection,"login"); 

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

    //$connection= mysqli_connect("localhost", "root", "abcd");
   $found=array();
    $result=mysqli_query($connection, "select * from  follow inner join users on follow.follow_to=users.id where follow_by='$id'");
  if (mysqli_num_rows($result) > 0) {
    // output data of each row     
     while($row = mysqli_fetch_assoc($result)) {
     	$uimage=finduimg($row['id']);
     	$row['whentmp']=$uimage;
     	$found[]=$row;
     }
     echo json_encode($found);
 }
  
?>