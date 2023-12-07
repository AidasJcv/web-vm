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
			header('Location: /auth/login.php');
			exit();
		}
	
	?>
	
	<div id="outer" style="margin-top: 30px">
		<div id="inner" style="text-align: center">
			<p>To gain access to your very own virtual machine/server, fill out this form and specify the amount of resources (CPU, RAM and storage) you require.</p>
			<fieldset id="inner" style="background-color: rgb(60 60 60);">
				<form action="/scripts/submit.php" method="POST" id="getserver">
					<div>
						<p style="text-align: left;">RAM: <span id="ram_display"></span>MB</p>
						<input name="ram" id="ram_slider" style="width: 100%" type="range" min="256" max="1024" value="384" step="64">
					</div>
					<div>
						<p style="text-align: left;">CPU: <span id="cpu_display"></span>VCores</p>
						<input name="cpu" id="cpu_slider" style="width: 100%" type="range" min="0.1" max="0.3" value="1" step="1">
					</div>
					<input type="submit" value="Get Server" form="getserver">
				</form>
			</fieldset>
		</div>
	</div>
	
<script>
	var slider1 = document.getElementById("ram_slider");
	var slider2 = document.getElementById("cpu_slider");
	var output1 = document.getElementById("ram_display");
	var output2 = document.getElementById("cpu_display");
	output1.innerHTML = slider1.value;
	output2.innerHTML = slider2.value;

	slider1.oninput = function() {
		output1.innerHTML = this.value;
	}
	slider2.oninput = function() {
		output2.innerHTML = this.value;
	}
</script>
	
</body>

</html>
