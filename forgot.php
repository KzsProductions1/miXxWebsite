<?php
ob_start(); 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if(isset($_POST['email'])){
	
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM Users WHERE email='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "User with that email doesn't exist!";
       
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $user['email'];
        $hash = $user['hash'];
        $firstname = $user['firstname'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Please check your email <span>$email</span>"
        . " for a confirmation link to complete your password reset!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link (miXx Website)';
        $message_body = '
        Hello '.$firstname.',

        You have requested password reset!

        Please click this link to reset your password:

        http://localhost/miXx%20Website/resetpage.php?email='.$email.'&hash='.$hash;  

        mail($to, $subject, $message_body);

        header("location: ../miXx Website/login.php");
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Your Password</title>
  <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="Registration.css" rel="stylesheet" type="text/css" />
</head>

<body>
    
<div class="container-fluid">
	<div class="body-content">
    <div class="module">
    <h2>Reset Your Password</h2><?php $_SESSION['message']; ?>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        Email Address<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
     <input type="submit" value="Reset" name="Reset" class="btn btn-block btn-primary" />
    </form>
    <div style="float:left;padding-top:1%;color: rgba(255, 255, 255, 0.7);"><a href="/miXx Website/Login.php" style="text-decoration:none;">Login</a></div>
  </div>
  </div>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
