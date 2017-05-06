<?php
 $uimag=$_POST['uid'];
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
 echo finduimg($uimag);
 ?>