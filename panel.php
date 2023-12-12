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
			<h2>Active virtual machines:</h2>
			<?php
				
			?>
		</div>
	</div>
	
</body>

</html>
