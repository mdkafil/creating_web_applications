<!-- This is for ressetign the attempt id
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	session_start();
	$_SESSION = array(); // reinitialize the session
	session_destroy(); // clear the session data
	header("locaiton: quiz.php");
?>