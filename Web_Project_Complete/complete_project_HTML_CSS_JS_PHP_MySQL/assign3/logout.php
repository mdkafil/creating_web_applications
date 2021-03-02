<!-- This is the logout php for manage.php (enhancements)
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	session_start();
	$_SESSION = array(); // reinitialize the session
	session_destroy(); // clear the session data

	session_start(); // start the session store
	$_SESSION["logout"] = 1;
	header("location: login.php");
?>