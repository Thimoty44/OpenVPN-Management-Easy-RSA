<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Installation</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("headerlogin.php"); /* Include of the header */ ?>
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
						<br></br>
						Before begin the installation make sure your folder of your website have right on every file for www-data
						<br></br>
						Your folder easy-rsa and your ip file in .txt need right too
						<br></br>
						For www-data use :
						<br></br>
						chown -R www-data:www-data /yourpathtowebsite/
						<br></br>
						chmod -R 660 /yourpathtowebsite/
						<br></br>
						For easy-rsa folder use :
						<br></br>
						chown -R root:www-data /yourpathtoeasy-rsa/
						<br></br>
						chmod -R 770 /yourpathtoeasy-rsa/
						<br></br>
						For your IP file use :
						<br></br>
						chown root:www-data /yourpathtoipfile/ipfile.txt
						<br></br>
						chmod 660 /yourpathtoipfile/ipfile.txt
						<form action="installcheck.php" method="post">
							<br></br>
						<strong>Server IP</strong>
 						<br></br>
   						<input type="text" name="ipserver"/>
   						<br></br>
   						<strong>Server port</strong>
 						<br></br>
   						<input type="text" name="portserver"/>
   						<br></br>
						<strong>Server protocol</strong>
 						<br></br>
 						<select name="protoserver">
   						<option value="udp">UDP</option>
    					<option value="tcp">TCP</option>
						</select>
						<br></br>
						<strong>Do your VPN subnet use IPV6 ?</strong>
 						<br></br>
						<select name="ipv6">
   						<option value="true">Yes</option>
    					<option value="false">No</option>
						</select>
						<br></br>
						<strong>Cipher</strong>
 						<br></br>
   						<input type="text" name="cipher"/>
   						<br></br>
   						<strong>Auth</strong>
 						<br></br>
   						<input type="text" name="auth"/>
   						<br></br>
   						<strong>Compression LZO</strong>
 						<br></br>
 						<select name="complzo">
   						<option value="yes">Yes</option>
    					<option value="no">No</option>
    					<option value="adaptive">Adaptive</option>
						</select>
						<br></br>
   						<strong>TLS (Openvpn static key)</strong>
 						<br></br>
 						<select name="tls">
   						<option value="true">True</option>
    					<option value="false">False</option>
						</select>
						<br></br>
   						<strong>Path to easy-rsa folder (don't forget the / at the end)</strong>
 						<br></br>
   						<input type="text" name="patheasyrsaopenvpn"/>
   						<br></br>
   						<strong>File who show IP example : /etc/openvpn/server/ipp.txt</strong>
 						<br></br>
   						<input type="text" name="ippconf"/>
   						<br></br>
   						<strong>Name of the Openvpn Server Service</strong>
 						<br></br>
   						<input type="text" name="serviceopenvpn"/>
   						<br></br>
   						<strong>Website example : myvpn.com</strong>
 						<br></br>
   						<input type="text" name="website"/>
   						<br></br>
   						<strong>SMTP Username</strong>
 						<br></br>
   						<input type="text" name="emailusername"/>
   						<br></br>
   						<strong>SMTP Password</strong>
 						<br></br>
   						<input type="password" name="emailpassword"/>
   						<br></br>
   						<strong>SMTP Secure type (SSL/TLS ...)</strong>
 						<br></br>
   						<input type="text" name="emailsmtpsecure"/>
   						<br></br>
   						<strong>SMTP Host</strong>
 						<br></br>
   						<input type="text" name="emailhost"/>
   						<br></br>
   						<strong>SMTP Port</strong>
 						<br></br>
   						<input type="text" name="emailport"/>
   						<br></br>
   						<strong>SMTP Email sender</strong>
 						<br></br>
   						<input type="text" name="emailfrom"/>
   						<br></br>
   						<strong>Database IP Host</strong>
 						<br></br>
   						<input type="text" name="dbhost"/>
   						<br></br>
   						<strong>Database User</strong>
 						<br></br>
   						<input type="text" name="dbuser"/>
   						<br></br>
   						<strong>Database Password</strong>
 						<br></br>
   						<input type="password" name="dbpass"/>
   						<br></br>
   						<strong>Database Name</strong>
 						<br></br>
   						<input type="text" name="dbname"/>
   						<br></br>
   						<input type="submit" value="Initiate website" />
   						<br></br>
   						<br></br>
   						<br></br>
						</form>
						</p>
						</div>
				</section>
				<?php include("footer.php"); /* Include of the footer */ ?>
			</body>
</html>