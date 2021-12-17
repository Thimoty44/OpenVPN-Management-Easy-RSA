<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Profile</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("header.php"); /*Include the header */ ?>
				<br>
				</br>
				<section>
					<article>
						<div id="profile">
							<?php
							/* Connection to database */
							$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
							if (mysqli_connect_errno()) {
								exit('Failed to connect to MySQL: ' . mysqli_connect_error());
							}
							// Getting id of the profile
							$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
							$stmt->bind_param('i', $_SESSION['id']);
							$stmt->execute();
							$stmt->bind_result($password, $email);
							$stmt->fetch();
							$stmt->close();
							?>
							<p>Your account details are below:</p>
							<p>Username: <?=$_SESSION['name']?></p>
							<p>Email: <?=$email?></p>
							<form method="post" action="password.php">
 								<p>
   									<strong>Reset Password</strong>
 									<br></br>
   									<input type="password" name="passwordreset" inputmode="numeric" minlength="8"
       maxlength="20" required/>
   									<br></br>
   									<input type="password" name="passwordreset2" inputmode="numeric" minlength="8"
       maxlength="20" required/>
   									<br></br>
   									<input type="submit" value="Change password" />
								</p>
 							</form>
 							<form action="changeemail.php" method="post">
		                    Change email address
		                    <br></br>
		                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
		                    <br></br>
		                	<input type="submit" name="changemail" class="btn btn-primary" value="Change email">
		                	<br></br>
		                	<br></br>
		                	<br></br>
		              	</form>
						</div>
					</article>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>