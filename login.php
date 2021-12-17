<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Login</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("headerlogin.php"); /* Include the specific header for login page */ ?>
				<br>
				</br>
				<section>
					<div class="logologin">
					<img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
					</div>
					<br></br>
					<div class="login">
						<h1>User Login</h1>
						<div class="loginusername">
						<form action="authenticate.php" method="post">
							<div class="username"><input type="username" name="username" placeholder="Username" id="username" required></div>
							<div class="loginpassword"><input type="password" name="password" placeholder="Password" id="password" required></div>
							<br></br>
							<div class="loginbutton"><input type="submit" value="Login"></div>
						</form>
						<br></br>
						<a href="forget-password.php" style="color: white; text-decoration: none;">Forget password ?</a>
					</div>
					</div>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>