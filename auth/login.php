<!DOCTYPE html>
<html>

<head>
	<title>Telecoms - Login</title>
	<?php include '../addons/stylesheet.html'; ?>
</head>

<body>

	<?php include '../addons/navbar.html'; ?>
	
	<div id="outer">
		<form action="/scripts/test.php" method="post">
		
			<div class="imgcontainer">
				<h1>Telecoms - Login</h1>
				<p>Please enter your username and password.</p>
			</div>

			<div class="container">
				<label for="uname"><b>Username</b></label>
				<input style="color: white" type="text" placeholder="Enter Username" name="uname" required>

				<label for="psw"><b>Password</b></label>
				<input style="color: white" type="password" placeholder="Enter Password" name="psw" required>
			
				<button type="submit">Login</button>
				
				<?php 
					if (isset($_GET["status"]) && $_GET["status"] == "failed") {
						echo '<p style="text-align: center; font-size: 15px; color: red;">Please check username and password.</p>';
					} else if (isset($_GET["status"]) && $_GET["status"] == "logout") {
						echo '<p style="text-align: center; font-size: 15px; color: green;">Logged out.</p>';
					} else if (isset($_GET["status"]) && $_GET["status"] == "noauth") {
						echo '<p style="text-align: center; font-size: 15px; color: red;">You must be logged in to access this page.</p>';
					}
				?>
				
				<p style="text-align: center">Not a member yet? <a href="signup.php" style="color: #4CAF50">Sign Up</a> now!</p>
			</div>

		</form>
	</div>
	
</body>

</html>
