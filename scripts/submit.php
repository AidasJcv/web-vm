<?php

	$newURL = "/order-failed.php";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if (isset($_POST['ram'], $_POST['cpu'])) {

			$ram = $_POST['ram'];
			$cpu = $_POST['cpu'];


			$wshost = 'localhost';
			$wsusername = 'webserver';
			$wspassword = 'admin';
			$wsdatabase = 'sessions';

			$ipfile = fopen("../databaseIP.txt", "r") or die("Unable to open file!");
			$remote_database_host = fgets($ipfile);
			fclose($ipfile);

			$remote_database_host = str_replace(" ", "", $remote_database_host);
			$remote_database_host = str_replace("\n", "", $remote_database_host);

			$dbhost = $remote_database_host;
			$dbusername = "admin";
			$dbpassword = "admin";
			$dbdatabase = "users";

			$mysqli = new mysqli($wshost, $wsusername, $wspassword, $wsdatabase);
			$dbmysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbdatabase);
			
			if ($mysqli->connect_error) {
				echo 'Connection failed: ' . $mysqli->connect_error;
				exit();
			}

			if ($dbmysqli->connect_error) {
				echo 'Connection failed: ' . $dbmysqli->connect_error;
				exit();
			}
			
			$cookie_value = $_COOKIE["session_id"];
			$cookie_value = $mysqli->real_escape_string($cookie_value);
			$query = "select user_id from sessions_data where session_id='$cookie_value'";
			$result = $mysqli->query($query);
			
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
				$query = "insert into vminfo (owner_id, cpu, ram) values (" . $row["user_id"] . ", $cpu, $ram)";
				$result = $dbmysqli->query($query);
				
				$newURL = "/thank-you.php";
			}
		}
	}

	header('Location: '.$newURL);

?>
