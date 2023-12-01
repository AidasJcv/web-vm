<!DOCTYPE html>
<html>

<head>
	<title>Telecoms - Sign Up</title>
	<?php include '../addons/stylesheet.html'; ?>
</head>

<body>

	<?php include '../addons/navbar.html'; ?>
	
	<div id="outer">
		<form action="#" method="post">
		
			<div class="imgcontainer">
				<h1>Telecoms - Sign Up</h1>
				<p>To create an account, please enter your desired username and a strong password.</p>
			</div>

			<div class="container">
				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required>
			
				<button type="submit">Login</button>
			</div>

		</form>
	</div>
	
</body>

</html>
