<?php
function serverConnect(){
	$connectstr_dbhost = '';
	$connectstr_dbname = '';
	$connectstr_dbusername = '';
	$connectstr_dbpassword = '';

	foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    
    	$connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    	$connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    	$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    	$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
	}
	$connection= mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
	return $connection;
}
?>