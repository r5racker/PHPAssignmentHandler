<?php
// Connect to MySQL
//include 'connection.php';
session_start();
//provide the email id on behalf of Company
$emailId="";
//it is adviced to use application password 
$emailPassword="";
// Was the form submitted?
if (isset($_POST["user_email"])) {
	
	// Harvest submitted e-mail address
	if (filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST["user_email"];
		
	}else{
		$_SESSION['msg']='e-mail is not valid ';
        header("Location:password.php");
	}

      
        $dbhandler = new PDO('mysql:host=localhost:3306;dbname=ce4_13','root','');

	echo "Connection is established...<br/>";
	$dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql="select * from Users where user_email=?";
	
	$prepared_sql=$dbhandler->prepare($sql);
	$prepared_sql->execute(array($_POST["user_email"]));
	
        

    if($sth=$prepared_sql->fetch()){
    	$selector=bin2hex(random_bytes(8));
    	$token=random_bytes(32);

    	$url="http://localhost:8080/PHP_LAB/PHPAssignmentHandler/PasswordReset/NewPassword.php?user_email=".$_POST["user_email"]."&selector=".$selector."&validator=".bin2hex($token);
    	$expires=date("U") + 6000; //expires in 10 minutes

        

        include 'PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->SMTPDebug = 3;
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPAutoTLS = false; 
        $mail->From = $emailId;
        $mail->FromName = "FROM Assignment Manager";
        $mail->Username = $emailId;                 
        $mail->Password = $emailPAsseord;
        $mail->addAddress($email, "no memory");

        $mail->isHTML(true);

        $mail->Subject = "RESET YOUR PASSWORD FOR Assignment Manager System";
        $mail->Body = 'COPY AND PASTE THE BELOW LINK TO CHANGE YOUR PASSWORD<br>'.$url;

        if(!$mail->send()) {
            $_SESSION['msg']='There was a problem during sending Email.Check your Internet ';
        } 
        else {
             $_SESSION['msg']='Check Your Email';
        }
        header("Location:../login.php?message=View your email inbox for reset link");
    }

    else{
        $_SESSION['message']='e-mail is not registered by user';
        header("Location:../login.php?message=please register yourself");
    }

    
}
else{
    header("Location:../login.php");
}
?>