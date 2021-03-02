<!-- This is the page to list the students who got less than 50% mark in the seconde attempt.
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	require_once('settings.php');
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);// make a connection with the database.
	if (!$conn) {
		echo "<p>Database connection failure</p>";
	}
	else {
		$sql_table = "attempts";
		$query = "select fname, lname, student_number, attempts, score from $sql_table where score <= 75 and attempts = 2"; // the mark less than 50% and it is the second attempt
		$result = mysqli_query($conn, $query); // insert the query to the database.
		if (!$result) {
			echo "<p>Something is wrong with ", $query, "</p>";
		}
		else {
			// make a tabe for the result, show the firstime, lastname and the student id.
			if (mysqli_num_rows($result) > 0) {
				echo "<table border=\"1\">";
				echo "<tr>\n"
					."<th scope=\"col\">First Name</th>\n"
					."<th scope=\"col\">Last Name</th>\n"
					."<th scope=\"col\">Student Number</th>\n"
					."<th scope=\"col\">Attempt</th>\n"
					."<th scope=\"col\">Score</th>\n";
				echo "</tr>";

				while ($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
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
		mysqli_close($conn); // close the connection withe the database.
	}
	echo "<p><a href=\"manage.php\">Go back to manage page</a></p>";
?>