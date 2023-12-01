<?php

	function is_authenticated() {

		$cookie_name = "session_id";
		
		if (!isset($_COOKIE[$cookie_name])) {
			return false;
		} else {
		
			$host = 'localhost';
			$username = 'webserver';
			$password = 'admin';
			$database = 'sessions';

			$mysqli = new mysqli($host, $username, $password, $database);

			if ($mysqli->connect_error) {
				die('Connection failed: ' . $mysqli->connect_error);
			}
		
			$cookie_value = $_COOKIE[$cookie_name];
			$cookie_value = $mysqli->real_escape_string($cookie_value);
			$query = "SELECT * FROM sessions_data WHERE session_id = '$cookie_value'";
			$result = $mysqli->query($query);
		
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			} else {
				return false;
			}
			
		}

	}

?>