<!-- This is manage.php for the quiz supervisors.
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	// enhancements
	session_start(); // start the session store
	if (isset($_SESSION["logout"])) {
		// make sure the user couldn't access to this page by typing the URL after logout.
		if ($_SESSION["logout"] == 1){
			header("location: login.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Manage Attemps</title>
	<script src="script/manage.js"></script>
</head>
<body>
	<form method="post" action="manage.php">
		<fieldset>
			<legend>Student search</legend>
			<p><label for="student_id">Student ID: </label><input type="text" name="student_id" id="student_id" /></p>
			<p><label for="firstname">First Name: </label><input type="text" name="firstname" id="firstname" /></p>
			<p>	<label for="lastname">Last Name: </label>
			<input type="text" name="lastname" id="lastname" /></p>
			<p><input type="submit" name="submit" value="Search" /></p>
		</fieldset>
	</form>
	<p><a href="all_attempts.php">List all attempts.</a></p>
	<p><a href="full_mark.php">List all students who got 100% on their first attempt.</a></p>
	<p><a href="fail.php">List all students who got less than 50% on their second attempt.</a></p>
	<p><a href="delete.php">Delete attempts for a particular student.</a></p>
	<p><a href="change_score.php">Change score for a quiz attempt.</a></p>
	<button type="button" id="logout">Logout</button>
	<hr />
<?php
	// this is a self call php, make sure the following commands wouldn't be executed before the form is filled.
	if (isset($_POST["student_id"]) || isset($_POST["firstname"]) || isset($_POST["lastname"])) {
		$student_id = trim($_POST["student_id"]);
		$firstname = trim($_POST["firstname"]);
		$lastname = trim($_POST["lastname"]);

		if ($student_id != "" || $firstname != "" || $lastname != "") {
			require_once('settings.php');
			$conn = @mysqli_connect($host, $user, $pwd, $sql_db); // make a connection with the data base.


		if (!$conn) {
			echo "<p>Database connection failure</p>";
		}
		else {
			$sql_table = "attempts";
			$query = "select * from $sql_table where student_number like '%$student_id%' and fname like '%$firstname%' and lname like '%$lastname%' ";
			$result = mysqli_query($conn, $query); // insert the query to teh database and return the result.

			if (!$result) {
				echo "<p> Something is wrong with ", $query, "</p>";
			}
			else {
				// make sure some data in the database
				if (mysqli_num_rows($result) > 0) {
					// craete a table for the result
					echo "<table border=\"1\">";
					echo "<tr>\n"
						."<th scope=\"col\">Attempt Id</th>\n"
						."<th scope=\"col\">Date and Time of Attempt</th>\n"
						."<th scope=\"col\">First Name</th>\n"
						."<th scope=\"col\">Last Name</th>\n"
						."<th scope=\"col\">Student Number</th>\n"
						."<th scope=\"col\">Attempts</th>\n"
						."<th scope=\"col\">Score</th>\n";

					// fetch the result in the table
					while ($row = mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>", $row["attempt_id"], "</td>";
						echo "<td>", $row["date_and_time_of_attempt"], "</td>";
						echo "<td>", $row["fname"], "</td>";
						echo "<td>", $row["lname"], "</td>";
						echo "<td>", $row["student_number"], "</td>";
						echo "<td>", $row["attempts"], "</td>";
						echo "<td>", $row["score"], "</td>";
						echo "</tr>";
					}
					echo "</table>";

					mysqli_free_result($result); // free the result
				}
			}
			mysqli_close($conn); // close the conneciton with the database.
		}
	}
	}
?>
</body>
</html>