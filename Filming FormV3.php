<?php
require 'db.php';
session_start();
ob_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>miXx Filming Request</title>
<?php
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: /miXx Website/Login.php");    
}
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['song']) && isset($_POST['artist']) && isset($_POST['project']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['location']) && isset($_POST['package']) && isset($_POST['Quality']) && isset($_POST['filmer']) && isset($_POST['Editor']) ){
		
		$Id = $_SESSION['Id'];
		$song = $_POST["song"];
		$artist = $_POST["artist"];
		$project = $_POST["project"];
		$date = $mysqli->real_escape_string($_POST['date']);
		$time = $mysqli->real_escape_string($_POST['time']);
		$location = $mysqli->real_escape_string($_POST['location']);
		$package = $_POST['package'];
		$Quality = $_POST['Quality'];
		$effects = array_sum ($_POST['effects']);
		$filmer = $_POST['filmer'];
		$editor = $_POST['Editor'];
		$requests = $mysqli->real_escape_string($_POST['requests']);
		$sql = "INSERT INTO requests (dancerid, song, artist, project, date, time, location, package, Quality, effects, filmer, Editor, requests)
				 VALUES ('$Id', '$song', '$artist', '$project', '$date', '$time', '$location', '$package', '$Quality', '$effects', '$filmer', '$editor', '$requests')";
		$mysqli->query($sql); 	
		echo "<script>";
		echo 'function thanks(){
	alert("Thank you for your request. </br> If you want to submit another request please continue to fill out another request. </br> Please dont forget to logout");
}';
		echo "</script>";
	
	}
	}
?>
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="Form.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container-fluid jumbotron">
	 <div class="col-lg-12">
     <div style="text-align:right"><a href="logout.php">Logout</a></div>
                <h1 style="text-align:center">
                Filming Packages and Accessories
                </h1><br />
                    <h3>
                    How Does This Affect Future Filming?
                   </h3>
                        <p>Some of the requests below require a small donation to cover some of the costs associated with filming. Such as parking, light bulbs, batteries, gas, Adobe Premiere and Dropbox subscriptions. We want to continue to properly allocate resources and time to make the highest quality productions possible. Your donations will most likely be invested in future filming equipment that will ultimately end up in a different video.
                        </p>
            </div> <br />
            <div class="col-lg-12">
                <h3>Basic Project - $0</h3>
                    <p>Standard production, about 7 shots, minimal lighting needed to get the shot done. We will let you know if this option is not right for your project. <br /><br />Examples: <br />Red Velvet - Russian Roulette <br />iKON - Rhythm Ta <br />Blackpink - Whistle <br />Miss A - Only You <br />Apink - Only One
                    </p>
                <h3>Experimental Project - $0</h3>
                    <p>You let us do anything we see fit. The final result could be anything from a basic video all the way up to a competition level video package. Kyle or Kai will also do the editing. We also reserve the right to film back stage for behind the scenes videos.*</p>
                <h3>Lighting and Steady Shot Guarantee, Donate - $20</h3>
                    <p>Basic + lighting setup that can light up just about any set. We'll be sure to bring a couple of stabilizing features such as a dolly or the SteadyCam. A few additional shots. <br /><br />Examples: <br />Twice - TT <br />Got7 - Hard Carry <br />SNSD - Catch Me If You Can　<br />EXO - Monster　<br />Mamamoo - Decalcomanie
                    </p>
                <h3>I Love Kai, Donate - $80</h3>
                    <p>We will pay special attention and prioritize your project. Attendance in 1 to 2 dance practices to make sure everything runs smoothly. Every single light in the arsenal to make a look that fits the mood of the dance. Early arrival to filming location for setup. The video will be shot and edited in 4K with as many shots taken as necessary to get the right look and perfect shot. If there are any equipment requests will be accepted with no extra charge. The edits will be a personal edit with a custom color look to make the video a one of a kind. 
                    </p>
             </div>
<br />
        <div class="col-lg-12">
         <?php $_SESSION['message']?>
            <form action="" method="post">
                <div class="question">What is the Project? (Song)</div> 
                    <input type="text" name="song"/>
                <div class="question">Who is the Artist?</div>
                    <input type="text" name="artist" required="required" />
                <div class="question">What Kind of Project is it?</div>
                    <input type="radio" name="project" value="Main Project" />Main Project<br />
                    <input type="radio" name="project" value="Side Project" />Side Project<br />
                    <input type="radio" name="project" value="Other" />Other<br />   
                <div class="question">When is the Filming?</div>
                    <input type="text" name="date" required="required" /><br /> 
                <div class="question">What time of the day do you want to film?</div>
                    <input type="radio" name="time" value="Early Moring (6AM - 9AM)" />Early Moring (6AM - 9AM)<br />
                    <input type="radio" name="time" value="Morning (9AM-11AM)" />Morning (9AM-11AM)<br />
                    <input type="radio" name="time" value="Noon (11AM-2PM)" />Noon (11AM-2PM)<br />
                    <input type="radio" name="time" value="Afternoon (2PM - 4PM)"/>Afternoon (2PM - 4PM)<br />
                    <input type="radio" name="time" value="Evening (4PM - 9PM)"/>Evening (4PM - 9PM)<br />
                    <input type="radio" name="time" value="Night (9PM - 11PM)"/>Night (9PM - 11PM)<br />
                    <input type="radio" name="time" value ="Midnight (11PM-2AM)"/>Midnight (11PM-2AM)<br />
                    
                <div class="question">Where is your ideal Filming Location?</div>
                    <input type="text" name="location"/><br />
           
                <form action="" method="post">  
                  <div class="question">Which package fits your needs?</div>
                    <input type="radio" name="package" value="Basic Project" />Basic Project<br />
                    <input type="radio" name="package" value="Experimental Project"/>Experimental Project<br />
                    <input type="radio" name="package" value="Lighting and Steady Shot Guarantee"/>Lighting and Steady Shot Guarantee<br />
                    <input type="radio" name="package" value="I Love Kai" />I Love Kai<br />
                  
                  <div class="question">What Quality Do You Want Your Filming In?</div>
                        <input type="radio" name="Quality" value="4k To be cool - $25" />4k To be cool - $25<br />
                        <input type="radio" name="Quality" value="1080p HD Standard" />1080p HD Standard<br />
                 
                  <div class="question">What Type of special effects/needs?</div>
                        <input type="checkbox" name="effects[]" value="2" />High Beam Decorative Lights (+$2, low-life bulbs and batteries)<br />
                        <input type="checkbox" name="effects[]" value="15" />Smoke Machine (+$15, Including special liquids needed)<br />
                        <input type="checkbox" name="effects[]" value="7.5" />Speakers (+$7.50)<br />
                        <input type="checkbox" name="effects[]" value="8" />Saturday videoshoot parking (+$8.00)<br />
                  
                    <h2>Filmer Selection</h2>
                    <div class="question">Which filmers do you want to request?</div>
                        <input type="radio" name="filmer" value="Kai" />Kai<br />
                        <input type="radio" name="filmer" value="Kai and Kyle" />Kai and Kyle<br />
                   
                    <div class="question">Do you want editing?</div>
                        <input type="radio" name="Editor" value="Kai" />Yes, Kai edits<br />
                        <input type="radio" name="Editor" value="Kyle" />Yes, Kyle's edits<br />
                        <input type="radio" name="Editor" value="Anyone" />Yes, anyone is fine<br />
                        <input type="radio" name="Editor" value="No" />No<br />
                    
                    <div class="question">Any additional needs or requests?</div>
                        <input type="text" name="requests" value="" /><br /><br />
                        
                    <input type="submit" value="Submit" onclick="thanks()"/><br />    
                     <?php 
		$mysqli->close(); ?>      
                </form><br /><br />
               
            </div>
	</div>
</div>

</body>
</html>

