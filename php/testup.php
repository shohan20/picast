<?php
session_start();
if(!empty($_FILES)){
    
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'abcd';
    $dbName = 'login';
    //connect with the database
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    $targetDir = "../upload/".$_SESSION['id'];
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
         if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
        //insert file information into db table
            $conn->query("INSERT INTO files (file_name, uploaded) VALUES('".$fileName."','".date("Y-m-d H:i:s")."')");
    }
    }
    else{
           if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
        //insert file information into db table
            $conn->query("INSERT INTO files (file_name, uploaded) VALUES('".$fileName."','".date("Y-m-d H:i:s")."')");
        }
    }
    
}
?>