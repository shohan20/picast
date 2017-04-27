<?php
	include 'serverConnection.php';
	
	require_once '../dist/lib/swift_required.php';
	
	$email =$_POST['email'];
	$connection=serverConnect();
	mysqli_select_db($connection,"login");
	$result = mysqli_query($connection,"select * from users where email='$email'") or die("Failed to query database ".mysqli_error($connection));
	$row =mysqli_fetch_array($result);

	if($row['email']==$email){
		// Mail Transport
		$txt = "Picard account:\n\t Email: ".$email."\n\t Password: ".$row['password'];
		
	$transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
    ->setUsername('shohan@gmail.com') // Your Gmail Username
    ->setPassword('motionlesss10'); // Your Gmail Password

// Mailer



  // Give the message a subject
$message = Swift_Message::newInstance();
$message->setTo(array(
  "shohan.jess@gmail.com" => "Aurelio De Rosa"
));
$message->setSubject("This email is sent using Swift Mailer");
$message->setBody("You're our best client ever.");
$message->setFrom("shohan.jess@gmail.com", "Your bank");

$mailer = Swift_Mailer::newInstance($transport);
		// Send the message
		if ($mailer->send($message)) {
    		echo 'Mail sent successfully.';
		} else {
    		echo 'failed';
		}
	}
/*	else{
		echo "failed";
	}*/
?>