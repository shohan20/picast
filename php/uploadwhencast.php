<?php
session_start();
include 'serverConnection.php';
		if(!empty($_FILES)){
		$file_name=$_FILES['file']['name'];
		$file_tmp=$_FILES['file']['tmp_name'];
		$file_size=$_FILES['file']['size'];
		$file_error = $_FILES['file']['error'];
		$file_ext=explode('.', $file_name);
		$file_ext=strtolower(end($file_ext));
		$whenmodel=$_POST['whenmodel'];
		$check = getimagesize($file_tmp);
    	if($check !== false && $file_error==0) {
    		?>
    		<script type="text/javascript">
    			
    		</script>
    		<?
    		$targetDir="../whentmp/";
    				$connection=serverConnect();
					mysqli_select_db($connection,"login");
					$result = mysqli_query($connection,"insert into uploads(user_id,privacy,description,whentmp,whenmodel,location) values('".$_SESSION['id']."','1','','1','$whenmodel','');") or die("Failed to query database ".mysqli_error($connection));

					$resul = mysqli_query($connection,"SELECT LAST_INSERT_ID();") or die("Failed to query database ".mysqli_error($connection));
					$row =mysqli_fetch_array($resul);
    				$file_name_new=$row['LAST_INSERT_ID()'].'.'.$file_ext;

    			if (!file_exists($targetDir.$_SESSION['id'])) {
    				mkdir($targetDir.$_SESSION['id'], 0777, true);
    				$file_destination=$targetDir.$_SESSION['id'].'/'.$file_name_new;
    				if(move_uploaded_file($file_tmp, $file_destination)){
    					$uploaded=$file_destination;
    				}
    				else{
    					$failed=$file_name." not uploaded";
    				}
				}
				else{
					$file_destination=$targetDir.$_SESSION['id'].'/'.$file_name_new;
    				if(move_uploaded_file($file_tmp, $file_destination)){
    					$uploaded=$file_destination;
    				}
    				else{
    					$failed=$file_name." not uploaded";
    				}
				}
			}
			else{
				$failed=$file_name." extension ".$file_ext." not allowed";
			}
		}
		
	/*if(!empty($uploaded)){
		print_r($uploaded);
	}
	if(!empty($failed)){
		print_r($failed);
	}*/
?>