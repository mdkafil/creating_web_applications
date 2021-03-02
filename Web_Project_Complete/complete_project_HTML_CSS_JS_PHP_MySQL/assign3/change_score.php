<!-- This is the page to change the score for the student in one specific attempt
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Change Score</title>
</head>
<body>
	<form method="post" action="change_score.php">
		<fieldset>
			<legend>Change Score</legend>
			<p><label for="student_id">Student ID: </label><input type="text" name="student_id" id="student_id" /></p>
			<p><label for="attemptsNum">Attempt Number: </label><input type="text" name="attemptsNum" id="attemptsNum" /></p>
			<p><label for="score">New Score: </label><input type="text" name="score" id="score" /></p>
			<p><input type="submit" name="change" value="Change Score" /></p>
		</fieldset>
	</form>
<?php
	// make sure the id, attempt number and new score is set.
	if (isset($_POST["student_id"]) && isset($_POST["attemptsNum"]) && isset($_POST["score"])) {
		$studentId = trim($_POST["student_id"]);
		$attemptsNum = trim($_POST["attemptsNum"]);
		$score = trim($_POST["score"]);

		if ($studentId != "" && $attemptsNum != "" && $score != "") {
			require_once('settings.php');
			$conn = @mysqli_connect($host, $user, $pwd, $sql_db); // make a connection with the database.

			if (!$conn) {
				echo "<p>Database connection failure</p>";
			}
			else {
				$sql_table = "attempts";
				$query = "update $sql_table set score = $score where student_number = $studentId and attempts = $attemptsNum";
				$result = mysqli_query($conn, $query); // insert the query to the databae

				if (!$result) {
					echo "<p> Something is wrong with ", $query, "</p>";
				}
				else {
					$query_2 = "select * from $sql_table where student_number = $studentId and attempts = $attemptsNum";
					$result_2 = mysqli_query($conn, $query_2); // show the result after it change the score.
					if (!$result_2) {
						echo "<p> Something is wrong with ", $query_2, "</p>";
					}
					else {
						// make sure some data in the table.
						if (mysqli_num_rows($result_2) > 0) {
							echo "<table border=\"1\">";
						echo "<tr>\n"
							."<th scope=\"col\">Attempt Id</th>\n"
							."<th scope=\"col\">Date and Time of Attempt</th>\n"
							."<th scope=\"col\">First Name</th>\n"
							."<th scope=\"col\">Last Name</th>\n"
							."<th scope=\"col\">Student Number</th>\n"
							."<th scope=\"col\">Attempts</th>\n"
							."<th scope=\"col\">Score</th>\n";

						// fetch the result in the database
						while ($row = mysqli_fetch_assoc($result_2)){
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

						mysqli_free_result($result_2); // free the result
					}
					}
				}
				mysqli_close($conn); // close the connection with the database.
			}
		}
	}
	echo "<p><a href=\"manage.php\">Go back to manage page</a></p>";
?>
</body>
</html>