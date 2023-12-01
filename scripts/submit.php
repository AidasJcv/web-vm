<?php

	$newURL = "/order-failed.php";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		if (isset($_POST['ram'], $_POST['cpu'], $_POST['vcpu'], $_POST['storage'])) {
			
			$newURL = "/thank-you";
			
			$ram = $_POST['ram'];
			$cpu = $_POST['cpu'];
			$vcpu = $_POST['vcpu'];
			$storage = $_POST['storage'];

			echo "RAM: " . $ram . "MB<br>";
			echo "CPU: " . $cpu . " Cores<br>";
			echo "VCPU: " . $vcpu . " Cores<br>";
			echo "SSD: " . $storage . "GB<br>";
		} else {
			echo "POST variables are not set.";
		}
	} else {
		echo "This script only accepts POST requests.";
	}
	
	header('Location: '.$newURL);
?>
