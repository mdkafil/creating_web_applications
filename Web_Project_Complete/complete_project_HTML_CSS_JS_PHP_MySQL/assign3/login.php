<!-- This is the login page for manage.php (enhancements)
Author: MD Kafil Uddin
Created: 21 Oct
Last updated: 28 Oct -->
<?php
	session_start();

	// initialzie the data
	if (isset($_POST["userId"]) && isset($_POST["password"])) {
		if (($_POST["userId"] != "") || ($_POST["password"] != "")) {
			$userId = trim($_POST["userId"]);
			$password = trim($_POST["password"]);

			require_once("settings.php");
			$conn = @mysqli_connect($host, $user, $pwd, $sql_db); // make a connection to the database

			if (!$conn) {
				echo "<p>Database connection failure</p>";
			}
			else {
				$sql_table = "login";
				$query = "select * from $sql_table";
				$result = mysqli_query($conn, $query); // insert the query to the database and return the result

				if (!$result) {
					echo "<p>Something is wrong with ", $query, "</p>";
				}
				else {
					if (mysqli_num_rows($result) > 0) {
						$row = mysqli_fetch_assoc($result);
						// fetch the adminstrator id and password
						$adminId = $row["userId"];
						$adminPwd = $row["password"];

						// another enhacement to make user only have three attempts to log in.
						if (!isset($_SESSION["times"])) {
								$_SESSION["times"] = 1;
						}
						else {
							$_SESSION["times"]++;
						}
						
						if ($_SESSION['times'] < 3) {
							if ($userId == $adminId && $password == $adminPwd) {
								$_SESSION["logout"] = 0; // prevent the logout page negetive influence
								header("location: manage.php"); // head to the manage page
							}
							else {
								echo "<p><em>User Id or password doesn't correct. You only have three tries.</em></p>";
							}
						}
						else {
							echo "<p><em>You have used all your tries.</em></p>";
						}
					}
				}
				mysqli_close($conn); // close the connection with the database.
			}
		}
		echo "<p>Please enter the User id and Password.</p>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Login</title>
</head>
<body>
	<h1>Login Form</h1>
	<form method="post" action="login.php">
		<fieldset>
			<legend>Login</legend>
			<p><label for="userId"><strong>User Id:</strong></label>
			<input type="text" name="userId" id="userId" required="required" /></p>
			<p><label for="password"><strong>Password:</strong></label>
			<input type="text" name="password" id="password" required="required" /></p>
			<input type="submit" name="Login" value="Login" id="Login" />
		</fieldset>
	</form>
</body>
</html>