<!-- This is the quiz page.
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	session_start();
	if (!isset($_SESSION["attempt_id"]) || $_SESSION["attempt_id"] == "") {
		$_SESSION["attempt_id"] = 0; // initialize the attempt_id.
	}
	$attempt_id = $_SESSION["attempt_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Assignment 1" />
	<meta name="keywords" content="html,css,dns" />
	<meta name="author" content="MD Kafil Uddin" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Domain Name System</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" />
</head>
<body>
	<?php
		// include the header and menu.
		include ('header.inc');
		include ('menu.inc');
	?>
	<form id="quiz" method="post" action="markquiz.php" novalidate="novalidate">
		<fieldset>
			<legend>Student details</legend>
			<p id="timer"></p>

			<p><label for="studentid">Student ID:</label>
				<input type="text" name="studentid" id="studentid" pattern="(\d{7})|(\d{10})" required="required" /></p>
			<p><label for="fname">First Name:</label>
				<input type="text" name="fname" id="fname" pattern="[a-zA-Z- ]+" maxlength="30" required="required" /></p>
			<p><label for="mname">Middle Name:</label>
				<input type="text" name="mname" id="mname" pattern="[a-zA-Z- ]+" maxlength="30" placeholder="optional" /></p>
			<p><label for="lname">Last Name:</label>
				<input type="text" name="lname" id="lname" pattern="[a-zA-Z- ]+" maxlength="30" required="required" /></p>
		</fieldset>
		<fieldset>
			<legend>Questions</legend>
			<p id="serverName">1.Which one is not a DNS server?<br />
				<label><input type="radio" name="server" value="Recursor" id="recursor" required="required" />Recursive resovler</label>
				<label><input type="radio" name="server" value="Authoritative" id="authoritative" />Authoritative nameserver</label>
				<label><input type="radio" name="server" value="BLDS" id="BLDS" />Bottom level domain server</label>
				<label><input type="radio" name="server" value="Root" id="root" />Root nameserver</label>
			</p>
			<p>2.Whcih choices are DNS queries?<br />
				<label><input type="checkbox" name="recursive" value="Recursive" id="recursive" />Recursive query</label>
				<label><input type="checkbox" name="sequence" value="Sequence" id="sequence" />Sequence query</label>
				<label><input type="checkbox" name="nonrecursive" value="NonRecursive" id="nonrecursive" />Non-recursive query</label>
				<label><input type="checkbox" name="iterative" value="Iterative" id="iterative" />Iterative query</label>
				<label><input type="checkbox" name="selection" value="Selection" id="selection" />Selection query</label>
			</p>
			<p><label>3.When the DNS was born?</label>
				<select name="born_time" id="born_time">
					<option value="none">Please select</option>
					<option value="early1970s_false">In the early 1970s</option>
					<option value="early1980s">In the early 1980s</option>
					<option value="late1970s_false">In the late 1970s</option>
					<option value="late1980s_false">In the late 1980s</option>
					<option value="middle1980s_false">In the middle 1980s</option>
				</select>
			</p>
			<p><label>4.The steps of DNS lookup:<br />
				<textarea name="lookup" rows="8" cols="40" id="lookup" placeholder="Enter your answer here."></textarea></label>
			</p>
		</fieldset>
		<input type="submit" name="Submit" value="Submit" id="submit" />
		<input type="reset" name="Reset" />
	</form>
	<hr />
	<?php
		// include the common footer.
		include ('footer.inc');
	?>
</body>
</html>