<!-- This is for marking up the quiz (calculating score anf find errors).
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	// to sanitise the input data.
	function sanitise_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<?php
	// to caculate the attempt id.
	session_start();
	$attempt_id = $_SESSION["attempt_id"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Mark Quiz</title>
</head>
<body>
<?php
	if (!isset($_POST["studentid"])) {
		header("location: quiz.php");
	}

	require_once ("settings.php"); // add the account details
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db); // make a connection to the database
	$sql_table = "attempts";
	$fileDefinition = "attempt_id INT AUTO_INCREMENT PRIMARY KEY, date_and_time_of_attempt VARCHAR(15), fname VARCHAR(40), mname VARCHAR(40), lname VARCHAR(40), student_number VARCHAR(20), attempts VARCHAR(1), score VARCHAR(5)";
	$sqlString = "show tables like '$sql_table'";

	// require to type all the information and initialize the data
	$errMsg = "";
	if (isset($_POST["studentid"]) && $_POST["studentid"] != "") {
		$id = sanitise_input($_POST["studentid"]);
	}

	if (isset($_POST["fname"]) && $_POST["fname"] != "") {
		$firstname = sanitise_input($_POST["fname"]);
	}

	if (isset($_POST["fmname"]) && $_POST["mname"] != "") {
		$middlename = sanitise_input($_POST["mname"]);
	}
	else {
		$middlename = "";
	}

	if (isset($_POST["lname"]) && $_POST["lname"] != "") {
		$lastname = sanitise_input($_POST["lname"]);
	}

	if ($_POST["studentid"] == "") {
		$errMsg .= "You must enter your sutdent ID.<br />";
	}
	elseif (!preg_match("/^[0-9]{7}$/", $id)) {
		if (!preg_match("/^[0-9]{10}$/", $id)) {
			$errMsg .= "Your student id must be either 7 or 10 digits.<br />"; // student id format (either 7 or 10 digits.)
		}
	}

	// name format (maxlength 30 and only letters, hyphen and space)
	if ($_POST["fname"] == "") {
		$errMsg .= "You must enter your first name.<br />";
	}
	elseif (!preg_match("/[a-zA-Z- ]+/", $firstname)) {
		$errMsg .= "Only alpha, space and hyphen characters are allowed in your first name. <br />";
	}
	elseif (strlen($firstname) > 30) {
		$errMsg .= "Only 30 characters allowed in your first name.<br />";
	}

	if ($_POST["lname"] == "") {
		$errMsg .= "You must enter your last name.<br />";
	}
	elseif (!preg_match("/[a-zA-Z- ]+/", $lastname)) {
		$errMsg .= "Only alpha, space and hyphen characters are allowed in your last name. <br />";
	}
	elseif (strlen($lastname) > 30) {
		$errMsg .= "Only 30 characters allowed in your last name.<br />";
	}

	// caculate the score
	$score = 0;
	// question one (the radio button)
	$answerServer = "";
	if (isset($_POST["server"])) {
		$answerServer = $_POST["server"];
		$answerServer = sanitise_input($answerServer);
	}
	if (!$answerServer) {
		$errMsg .= "You must select one answer for question one.<br />";
	}
	elseif ($answerServer == "BLDS") {
		$score += 20;
	}

	// question two (checkbox)
	$answerQuery = "";
	if (isset($_POST["recursive"])) {
		$answerServer .= "Recursive Query; ";
		$score += 20; 
	}
	if (isset($_POST["sequence"])) {
		$answerServer .= "Sequence Query(Fault); ";
	}
	if (isset($_POST["nonrecursive"])) {
		$answerServer .= "Non-recursive Query; ";
		$score += 20;
	}
	if (isset($_POST["iterative"])) {
		$answerServer .= "Iterative Query; ";
		$score += 20;
	}
	if (isset($_POST["selection"])) {
		$answerServer .= "Selection Query(Fault); ";
	}
	if (!$answerServer) {
		$errMsg .= "You must select at least one answer for question two.<br />";
	}

	// quetion three (drop down selection)
	if (isset($_POST["born_time"])) {
		$answerBorn = $_POST["born_time"];
	}

	if ($answerBorn == "none") {
		$errMsg .= "You must select an answer for question three.<br />";
	}
	elseif ($answerBorn == "early1980s") {
		$score += 20;
	}

	// quetion four (textarea)
	$answerLookup = "";
	if (isset($_POST["lookup"]) && $_POST["lookup"] != "") {
		$answerLookup = sanitise_input($_POST["lookup"]);
	}
	else {
		$errMsg .= "You must enter your answer for question 4.<br />";
	}
	if ($answerLookup == "1. The user type the URL, such as www.google.com in the web browser. 2. It will translate into the query,which is received by a DNS recursive resolver. 3. The resolver takes the query to the root nameserver. 4. The root nameserver receives the query and responds to the resolver with the address of a TLD nameserver. 5. The resolver then makes a request to the .com TLD. 6. The TLD server takes the query to the authoritative namesever. 7. The authoritative nameserver translates the query into the IP address. 8. Lastly, the resovler will respond  to the web browser with the IP address for www.google.com.") {
		$score += 50;
	}

	// make sure the score is larger than zero
	if ($score == 0) {
		$errMsg .= "Please give at least one right answer.<br /> ";
	}

	// make a query to the database, check whether the attempts table exits or not
	$result = @mysqli_query($conn, $sqlString);
	if (mysqli_num_rows($result)==0) {
		echo "<p>The attempts table doesn't exit, creating table $sql_table</p>";
		$sqlString = "create table " . $sql_table . "(" . $fileDefinition . ")";
		$result_2 = @mysqli_query($conn, $sqlString); // make a attempts table if it doesn't exit

		if ($result_2===false) {
			echo "<p>Unable to create $sql_table table.</p>";
		}
		else {
			echo "<p>$sql_table table has been created.</p>";
		}
	}

	// print the error message to remind the user
	if ($errMsg != "") {
		echo "<p>$errMsg<a href=\"quiz.php\">Back to Quiz.</a></p>";
	}
	else {
		$attempt_id++; // caculate the attempt id correctly
		$_SESSION["attempt_id"] = $attempt_id;
		$_SESSION["arrayId"][] = $id; // store the student id in a session array to check the attempt for each student
		$attempts = 0; // caculate the attempts
		for ($index = 0; $index < count($_SESSION["arrayId"]); $index ++) {
			if ($id == $_SESSION["arrayId"][$index]) {
				$attempts += 1;
			}
		}

		if ($attempts >= 3) {
			echo "<p>You are not allowed to submit another attempt, because you have submmited twice.</p>"; // only two attempts are allowed.
		}
		else {
			echo "<p>Student ID: $id</p>";
			echo "<p>Student name: $firstname $middlename $lastname</p>";
			echo "<p>Your score: $score</p>";
			echo "<p>Your attempt: $attempts</p>";
			if ($attempts == 1) {
				echo "<p>You are allowed to have another <a href=\"quiz.php\">attempt.</a></p>"; // alow to make another attempt
			}
			$date = date("Y-m-d H:i:s"); // store the attempt submit date.
			$query = "insert into $sql_table (attempt_id, date_and_time_of_attempt, fname, mname, lname, student_number, attempts, score) values ('$attempt_id', '$date', '$firstname', '$middlename', '$lastname', '$id', '$attempts', '$score')";
			$result_3 = mysqli_query($conn, $query); // insert the value to the database.

			if (!$result_3) {
				echo "<p>Something is wrong with ", $query, "</p>";
			}
			else {
				echo "<p>Successfully added new attempt.</p>";
			}
		}
	}
	mysqli_close($conn); // close the connection the database.
?>
</body>
</html>