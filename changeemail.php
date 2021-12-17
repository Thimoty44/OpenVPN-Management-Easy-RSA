<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Profile</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("header.php"); /* Include the header */ ?>
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
							// Query to select the id account to get email.
							$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
							// In this case we can use the account ID to get the account info.
							$stmt->bind_param('i', $_SESSION['id']);
							$stmt->execute();
							$stmt->bind_result($password, $email);
							$stmt->fetch();
							$stmt->close();
							?>
							<p>Your account details are below:</p>
							<p>Username: <?=$_SESSION['name']?></p>
							<p>Email: <?=$email?></p>
							<p style="color:red;">If the email did not update click on Profile.</p>
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
		                	<?php
							try
							{
								/* Databse connection */
								$bdd = new PDO('mysql:host='.$DATABASE_HOST.';dbname='.$DATABASE_NAME.';charset=utf8', ''.$DATABASE_USER.'', ''.$DATABASE_PASS.'');
							}
								catch(Exception $e)
							{
								die('Error : '.$e->getMessage());
							}
							/* Query to change the email */
							$emailtaken = htmlspecialchars($_POST['email']);
							$reqpasswordreset = $bdd->prepare('UPDATE accounts SET email = :emailchange WHERE id = :idlog');
							$reqpasswordreset->execute(array(
								'emailchange' => $emailtaken,
								'idlog' => $_SESSION['id']
							));
							echo "</form><p style='color:green';><strong>Email updated for ".$emailtaken." !</strong></p>";
							?>
							<br></br>
							<br></br>
						</div>
					</article>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>