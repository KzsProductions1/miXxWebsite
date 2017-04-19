<?php
ob_start();
require 'db.php';
session_start();
if (isset($_POST['email']) && isset($_POST['password'])){
	$email = $mysqli->escape_string($_POST['email']);
	$result = $mysqli->query("SELECT * FROM Users WHERE email='$email'");
	
	if ( $result->num_rows == 0 ){ // User doesn't exist
    	$_SESSION['message'] = "User with that email doesn't exist!";
	}
	else { // User exists
		$user = $result->fetch_assoc();
		if ( password_verify($_POST['password'], $user['password']) ) {
			$_SESSION['email'] = $user['email'];
			$_SESSION['firstname'] = $user['firstname'];
			$_SESSION['lastname'] = $user['lastname'];
			$_SESSION['active'] = $user['active'];
			$_SESSION['Id'] = $user['Id'];       
			$_SESSION['logged_in'] = 1;
			
			if($_SESSION['active'] !=1){
				$_SESSION['message'] = "Please activate your account";
				header('location: ../miXx Website/Login.php');
				die;
			}
				else{
				header('location: ../miXx Website/Filming FormV3.php');
				die;
				}
		}
		else {
        	$_SESSION['message'] = "You have entered wrong password, try again!";
    	}
	}
}
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login</title>

<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="Registration.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container-fluid">
	<div class="body-content">
    <div class="module">
    	<h2>Login</h2>
        <form class="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="alert alert-error"><?php echo $_SESSION['message']; ?></div>
          <input type="email" placeholder="Email" name="email" required />
          <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
          <input type="submit" value="Login" name="Login" class="btn btn-block btn-primary" />
        </form>
        <div style="float:right; padding-top:1%;color: rgba(255, 255, 255, 0.7);"><a style="text-decoration:none" href="forgot.php">Forgot Password?</a></div>
        <div style="float:left;padding-top:1%;color: rgba(255, 255, 255, 0.7);"><a style="text-decoration:none" href="RegisterV2.php">Register</a></div>
	</div>
    </div>
</div>

</body>
</html>