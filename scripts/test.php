<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}



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

if (isset($_GET["logout"])) {
	if ($_GET["logout"] == "true") {
		
		if (isset($_COOKIE["session_id"])) {
			$cookie_value = $_COOKIE["session_id"];
			
			$query = "DELETE FROM sessions_data WHERE session_id = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("s", $cookie_value);
			$stmt->execute();
			$stmt->close();
			
			setcookie("session_id", "", time() - 3600, "/");
			$mysqli->close();
			$dbmysqli->close();
			header('Location: /auth/login.php?status=logout');
			exit();
			
		} else {
			
			header('Location: /');
			exit();
			
		}
	}
}

if (!isset($_COOKIE["session_id"])) {
	
	$postusername = $_POST["uname"];
	$postpassword = $_POST["psw"];
	
	echo "b";
	
	if (!isset($_POST["uname"])) { exit(); }
	if (!isset($_POST["psw"])) { exit(); }
	
	echo "c";
	
	$postusername = $dbmysqli->real_escape_string($postusername);
	$postpassword = $dbmysqli->real_escape_string($postpassword);
	
	$query = "SELECT * from userdata where username = '$postusername' and password = '$postpassword'";
	$result = $dbmysqli->query($query);
	
	if ($result && $result->num_rows > 0) {
		
		$row = $result->fetch_assoc();
		
		$cookie_value = generateRandomString(128);
		setcookie("session_id", $cookie_value, time() + 86400, "/"); // 86400 seconds = 1 day
		
		$cookie_value = $mysqli->real_escape_string($cookie_value);
		$query = "INSERT INTO sessions_data (session_id, user_id, username) VALUES ('$cookie_value', " . $row["user_id"] . ", '" . $row["username"] . "')";
		$mysqli->query($query);
		
		$mysqli->close();
		$dbmysqli->close();
		$result->free_result();
		header('Location: /');
		exit();
	
	} else {
		
		$mysqli->close();
		$dbmysqli->close();
		header('Location: /auth/login.php?status=failed');
		exit();
		
	}
	
}

$mysqli->close();
$dbmysqli->close();

echo "whar";

?>
