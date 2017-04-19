<?php
ob_start();
session_start();
/* Password reset process, updates database with new user password */
require 'db.php';

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // Make sure the two passwords match
	if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 

        $newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
        
        // We get $_POST['email'] and $_POST['hash'] from the hidden input field of reset.php form
        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);
        
        $sql = "UPDATE Users SET password='$newpassword', hash='$hash' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
        header("location: ../miXx Website/Login.php");   
        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: ../miXx Website/resetpage.php");   
	}

	/*if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) { 
		echo $_POST['newpassword'];
		echo $_POST['confirmpassword'];
		$newpassword = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
		$email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);
		$sql = "UPDATE Users SET password='$newpassword', hash='$hash' WHERE email='$email'";
		echo $_SESSION['message'];
		echo $newpassword;
		echo $hash;
		echo $email; ?></br><?php
		echo $sql;
		if ( $mysqli->query($sql) ) {
			$_SESSION['message'] = "Your password has been reset successfully!";
       		header("location: ../miXx Website/Login.php"); 
			?><br /><?php
			echo $_SESSION['message'];
		}
	}
	else {
		echo 'Fail';
	};
	*/
}
$mysqli->close(); 
?>
