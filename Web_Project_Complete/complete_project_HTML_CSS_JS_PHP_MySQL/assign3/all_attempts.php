<!-- This is for finding all attempts
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->

<?php
	require_once('settings.php');
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db); // make a connection with the database.
	if (!$conn) {
		echo "<p>Database connection failure</p>";
	}
	else {
		$sql_table = "attempts";
		$query = "select * from $sql_table";
		$result = mysqli_query($conn, $query); // insert the query to the database and return the result.
		if (!$result) {
			echo "<p> Something is wrong with ", $query, "</p>";
		}
		else {
			// make sure some data in the table
			if (mysqli_num_rows($result) > 0) {
				// create a table to show the result
				echo "<table border=\"1\">";
				echo "<tr>\n"
					."<th scope=\"col\">Attempt Id</th>\n"
					."<th scope=\"col\">Date and Time of Attempt</th>\n"
					."<th scope=\"col\">First Name</th>\n"
					."<th scope=\"col\">Last Name</th>\n"
					."<th scope=\"col\">Student Number</th>\n"
					."<th scope=\"col\">Attempts</th>\n"
					."<th scope=\"col\">Score</th>\n";

				// fetch the data in the database
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
		mysqli_close($conn); // close the connection to the database.
	}
	echo "<p><a href=\"manage.php\">Go back to manage page</a></p>";
?>