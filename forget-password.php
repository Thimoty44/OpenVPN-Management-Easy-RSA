<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Password Forgotten</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("headerlogin.php"); /* Include header but specific for login page */ ?>
				<br>
				</br>
				<section>
					<div class="logologin">
					<img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
					</div>
					<br></br>
					<div class="forgetpassword">
						<form action="password-reset-token.php" method="post">
		                    Email address
		                    <br></br>
		                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
		                    <br></br>
		                	<input type="submit" name="password-reset-token" class="btn btn-primary">
		              	</form>
		              	<br></br>
		              	<a href="index.php" style="color: inherit;">Back</a>
					</div>
					</div>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>