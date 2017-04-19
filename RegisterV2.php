<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Register</title>
<?php
require 'db.php';
session_start();

$_SESSION['email'] = $_POST['email'];
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['lastname'] = $_POST['lastname'];

$_SESSION['message'] = '';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password'])){
			if (empty($_POST["firstname"])){
				$firstnameErr = "* First Name is required";}
					else{
					$firstname = $mysqli->real_escape_string($_POST['firstname']);
					}
			
			if(empty($_POST["lastname"])) {
				$lastnameErr = "* Last Name is required";}
				else{
					$lastname = $mysqli->real_escape_string($_POST['lastname']);
					}
			
			if(empty($_POST["email"])) {
				$emailErr = "* Email is required";}
					else{
						$email = $mysqli->real_escape_string($_POST['email']);}
			
			if(empty($_POST["password"])){
				$passwordErr = "* Password is required";}
					else {	
					$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
					$hash = $mysqli->escape_string( md5( rand(0,1000) ) );}
					
					if (!empty($_POST["firstname"])){
						if(!empty($_POST["lastname"])){	
							if(!empty($_POST["email"])){		
								if(!empty($_POST["password"])){
									$result = $mysqli->query("SELECT * FROM Users WHERE email='$email'");
									if ( $result->num_rows > 0 ) {
										$_SESSION['message'] = 'User with this email already exists!';
										header("location: error.php");
									}
									else {
									$sql = "INSERT INTO Users (firstname, lastname, email, password, hash, active) " 
            						. "VALUES ('$firstname','$lastname','$email','$password', '$hash', 0)";
										}
					
								}
							}
						}
					}
					if ($mysqli->query($sql) === true){
                   		$_SESSION['active'] = 0; //0 until user activates their account with verify.php
						$_SESSION['logged_in'] = true; // So we know the user has logged in
						$_SESSION['message'] =
								
								 "Confirmation link has been sent to $email, please verify
								 your account by clicking on the link in the message!";
				
						// Send registration confirmation link (verify.php)
						$to      = $email;
						$subject = 'Account Verification ( miXx Filming )';
						$message_body = '
						Hello '.$firstname.',
				
						Thank you for signing up!
				
						Please click this link to activate your account:
				
						http://localhost/miXx%20Website/verify.php?email='.$email.'&hash='.$hash;  
				
						mail( $to, $subject, $message_body );?>
				
						<script>window.location = "Login.php"</script>	
		<?php
					session_destroy();
					}
					else {
						$_SESSION['message'] = 'Registration failed!';
						header("location: RegisterV2.php");
			   			 $mysqli->close(); 
    }
}
	}
?>
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="Registration.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container-fluid">
	<div class="body-content">
    <div class="module">
    	<h2>Create an Account</h2>
        <form class="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
        		<span class="error"><?php echo $firstnameErr;?></span>
          <input type="text" placeholder="First Name" name="firstname" required /> 
          		<span class="error"><?php echo $lastnameErr;?></span>
          <input type="text" placeholder="Last Name" name="lastname" required /> 
          		<span class="error"><?php echo $emailErr;?></span>
          <input type="email" placeholder="Email" name="email" required />
          		<span class="error"><?php echo $passwordErr;?></span>
          <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
          <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
        </form>
        	<div style="float:left;padding-top:1%;color: rgba(255, 255, 255, 0.7);"><a href="/miXx Website/Login.php" style="text-decoration:none;">Login</a></div>
	</div>
    </div>
</div>
</body>
</html>