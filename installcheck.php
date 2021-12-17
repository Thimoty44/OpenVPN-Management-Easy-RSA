<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Installation</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("headerlogin.php"); ?>
				<?php
					/* Condition to redirect to home page if the website is already configured */
					if ($installed == "true") {
						header('Location: login.php');
						exit;
					}
				?>
				<br>
				</br>
				<section>
					<div class="logologin">
					<img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
					</div>
					<br></br>
					<div class="install">
						<p>
						<h1>Installation</h1>
						<form action="installcheck.php" method="post">
						<br></br>
						Configuration file :
						<div class ="installconf">
						<?php
							/* Open the config file */
							$installfile = fopen('config.php', 'r+');
							/* Function who write the config */
							fputs($installfile, '
							<?php
							$ipserver = "'.htmlspecialchars($_POST['ipserver']).'";
							$portserver = "'.htmlspecialchars($_POST['portserver']).'";
							$protoserver = "'.htmlspecialchars($_POST['protoserver']).'";
							$patheasyrsaopenvpn = "'.htmlspecialchars($_POST['patheasyrsaopenvpn']).'";
							$serviceopenvpn = "'.htmlspecialchars($_POST['serviceopenvpn']).'";
							$cipher = "'.htmlspecialchars($_POST['cipher']).'";
							$auth = "'.htmlspecialchars($_POST['auth']).'";
							$complzo = "'.htmlspecialchars($_POST['complzo']).'";
							$tls = "'.htmlspecialchars($_POST['tls']).'";
							$installed = "true";
							$DATABASE_HOST = "'.htmlspecialchars($_POST['dbhost']).'";
							$DATABASE_USER = "'.htmlspecialchars($_POST['dbuser']).'";
							$DATABASE_PASS = "'.htmlspecialchars($_POST['dbpass']).'";
							$DATABASE_NAME = "'.htmlspecialchars($_POST['dbname']).'";
							$ippconf = "'.htmlspecialchars($_POST['ippconf']).'";
							$emailusername = "'.htmlspecialchars($_POST['emailusername']).'";
							$emailpassword = "'.htmlspecialchars($_POST['emailpassword']).'";
							$emailsmtpsecure = "'.htmlspecialchars($_POST['emailsmtpsecure']).'";
							$emailhost = "'.htmlspecialchars($_POST['emailhost']).'";
							$emailport = "'.htmlspecialchars($_POST['emailport']).'";
							$emailfrom = "'.htmlspecialchars($_POST['emailfrom']).'";
							$website = "'.htmlspecialchars($_POST['website']).'";
							$ipv6 = "'.htmlspecialchars($_POST['ipv6']).'";
							?>');
							/* Function who check if config exist */
							$installconffile = fopen( "config.php", "r" );
							if (file_exists("config.php")) {
							while ( $installconffiledata = fgets($installconffile, 1000) ) {
								echo '<p>'.$installconffiledata.'</p>';
								}
							}
							else {
    							echo "<p style='color:red;''>Error configuration file do not exist !</p>.";

    						}
							fclose($installfile);
						?>
					</div>
						<p>Defaults credentials are :<br></br>User: admin<br></br> Password: admin</p>
						<br></br>
		              	<a href="index.php" style="color: inherit;">Back to main page</a>
						</p>
						</div>
					</div>
					<br></br>
					<br></br>
					<br></br>
					<br></br>
				</section>
				<?php include("footer.php"); ?>
			</body>
</html>