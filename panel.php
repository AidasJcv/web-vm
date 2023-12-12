<!DOCTYPE html>
<html>

<head>
	<?php include 'addons/stylesheet.html'; ?>
</head>

<body>

	<?php include 'addons/navbar.html'; ?>
	
	<?php
	
		$row = is_authenticated();
	
		if ($row) {
			echo "username: " . $row["username"] . ", id: " . $row["user_id"];
		} else {
			header('Location: /auth/login.php?status=noauth');
			exit();
		}
	
	?>
	
	<div id="outer" style="margin-top: 30px">
		<div id="inner" style="text-align: center">
			<h2>User Control Panel</h2>
			
			<?php

				$wshost = 'localhost';
				$wsusername = 'webserver';
				$wspassword = 'admin';
				$wsdatabase = 'sessions';
	
				$ipfile = fopen("databaseIP.txt", "r") or die("Unable to open file!");
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
					
					$query = "select vm_id, connect_info from users.vminfo where owner_id=$user_id";
					$result = $dbmysqli->query($query);
					
					if ($result && $result->num_rows > 0) {

						$counter = 1;
						echo "<table> <tr> <th>ID</th> <th>VM ID</th> <th>SSH Connection Information</th> </tr>";
						
						while ($row = $dbmysqli->fetch_assoc()) {

							$temp = str_replace(" ", "", $row["connection_info"]);
							$temp = str_replace("\n", "", $temp);

							if ($temp == "NULL") {
								$temp = "Waiting for VM to start...";
							} else {
								$temp = $row["connection_info"];
							}
							
							echo "<tr> <td>" . $counter . "</td> <td>" . $row["vm_id"] . "</td> <td>" . $temp . "</td> </tr>";
							$counter += 1;
							
						}

						echo "</table>";

					} else {
						echo "<div style='text-align: center'><p>No virtual machines found.</p></div>";
					}
				}

			?>
		</div>
	</div>
	
</body>

</html>
