<?php
ob_start();
require 'db.php';
session_start();

if(isset($_POST['newpassword']) && isset($_POST['confirmpassword'])) {
	// Make sure email and hash variables aren't empty
	$email = $mysqli->escape_string($_GET['email']); 
	$hash = $mysqli->escape_string($_GET['hash']); 
	
	// Make sure user email with matching hash exist
	$result = $mysqli->query("SELECT * FROM Users WHERE email='$email' AND hash='$hash'");

	if ( $result->num_rows == 0 ){ 
		$_SESSION['message'] = "You have entered invalid URL for password reset!";
		header("location: ../miXx Website/login.php");
	}
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Reset Your Password</title>
</head>
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="Registration.css" rel="stylesheet" type="text/css" />
<body>
<div class="container-fluid">
	<div class="body-content">
    <div class="module">

          <h2>Choose Your New Password</h2><? if(isset($_SESSION['message'])){$_SESSION['message'];} ?>
          
          <form action="../miXx Website/reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              New Password<span class="req"> *</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Confirm New Password<span class="req"> *</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">    
          <input type="submit" value="Submit" name="Apply" class="btn btn-block btn-primary" />   
          
          </form>

    </div>
    </div>
    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="file:///Macintosh HD/Applications/MAMP/htdocs/login-system/js/index.js"></script>

</body>
</html>
