<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Password Forgotten</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("headerlogin.php"); /* Include the specifi header */ ?>
				<br>
				</br>
				<section>
					<div class="logologin">
					<img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
					</div>
					<br></br>
					<div class="forgetpassword">
						<?php
							/* Check if token is good */
							if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
							{
							/* Connection to databse */
							include "db.php";
							$emailId = htmlspecialchars($_POST['email']);
							$token = htmlspecialchars($_POST['reset_link_token']);
							$password = password_hash(($_POST['password']), PASSWORD_DEFAULT);
							$query = mysqli_query($con,"SELECT * FROM `accounts` WHERE `reset_link_token`='".$token."' and `email`='".$emailId."'");
							$row = mysqli_num_rows($query);
							if($row){
							/* Query who change password */
							mysqli_query($con,"UPDATE accounts set  password='" . $password . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
							echo "<p>Congratulations! Your password has been updated successfully.</p></br><a href='index.php' style='color: inherit;'>Back</a>";
							}else{
							echo "<p>Something goes wrong. Please try again</p></br><a href='index.php' style='color: inherit;'>Back</a>";
							}
							}
							?>
					</div>
					</div>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>