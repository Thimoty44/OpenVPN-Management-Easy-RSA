<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Reset Password</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("headerlogin.php"); /* Include pecific header */ ?>
				<br>
				</br>
				<section>
					<div class="logologin">
					<img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
					</div>
					<br></br>
					<div class="forgetpassword">
						<?php
							/* Check if token for reset password is good */
							if($_GET['key'] && $_GET['token'])
							{
							include "db.php";
							$email = $_GET['key'];
							$token = $_GET['token'];
							/* Looking ofr wich account is it */
							$query = mysqli_query($con,
							"SELECT * FROM `accounts` WHERE `reset_link_token`='".$token."' and `email`='".$email."';"
							);
							$curDate = date("Y-m-d H:i:s");
							if (mysqli_num_rows($query) > 0) {
							$row= mysqli_fetch_array($query);
							if($row['exp_date'] >= $curDate){ ?>
							<form action="update-forget-password.php" method="post">
							<input type="hidden" name="email" value="<?php echo $email;?>">
							<br></br>
							<input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
							<br></br>
							Password
							<br></br>
							<input type="password" name='password' class="form-control" inputmode="numeric" minlength="8"
       maxlength="20" required> 
							<br></br>
							Confirm Password
							<br></br>
							<input type="password" name='cpassword' class="form-control" inputmode="numeric" minlength="8"
       maxlength="20" required>
							<br></br>
							<input type="submit" name="new-password" class="btn btn-primary">
							</form>
							<?php } } else{
							echo "<p>This forget password link has been expired</p>";
								}
							}
							?>
					</div>
					</div>
				</section>
				<?php include("footer.php"); /* Include footer */ ?>
			</body>
</html>