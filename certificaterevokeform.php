<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Certificate</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("header.php"); /* Include the header */ ?>
				<br>
				</br>
				<section>
					<article>
						<div id="certificate">
							<form method="post" action="certificateform.php">
 								<p>
 									<strong>Check a certificate</strong>
 									<br></br>
   									<input type="text" name="Certificate"/>
   									<input type="submit" value="Show Certificate" />
								</p>
 							</form>
 							<form method="post" action="certificategenerationform.php">
 								<p>
   									<strong>Generate a certificate</strong>
 									<br></br>
   									<input type="text" name="cagen"/>
   									<input type="submit" value="Generate a Certificate" />
								</p>
 							</form>
 							<form method="post" action="certificaterevokeform.php">
 								<p>
   									<strong>Revoke a certificate</strong>
 									<br></br>
   									<input type="text" name="carevoke"/>
   									<input type="submit" value="Revoke a Certificate" />
								</p>
 							</form>
							<br></br>
							<strong>Logs :</strong>
							<br></br>
								<div class="certificaterevoke">
									<?php
										/* Execute command in the system to revoke the certificate (delete the file of certificate and revoke too) */
										$carevokefilebefore = "".$patheasyrsaopenvpn."pki/issued/".htmlspecialchars($_POST['carevoke']).".crt";
										if (file_exists($carevokefilebefore)) {
											chdir('/etc/openvpn/easy-rsa');
											$output = shell_exec('echo "yes"| ./easyrsa revoke '.htmlspecialchars($_POST['carevoke']).'');
											$output = shell_exec('rm '.$patheasyrsaopenvpn.'pki/private/'.htmlspecialchars($_POST['carevoke']).'key');
											$output = shell_exec('rm '.$patheasyrsaopenvpn.'pki/reqs/'.htmlspecialchars($_POST['carevoke']).'req');

											$carevokefile = ''.$patheasyrsaopenvpn.'pki/issued/'.htmlspecialchars($_POST['carevoke']).'.crt';
											if (file_exists($carevokefile)) {
	    										echo "<p style='color:red;'>The certificate ".htmlspecialchars($_POST['carevoke'])." is not revoked !</p>";
	    									} else {
	    										echo "<p style='color:green;''>The certificate ".htmlspecialchars($_POST['carevoke'])." is revoked.</p>";

	    									}
	    								} else {
	    									echo "<p style='color:red;'>The certificate ".htmlspecialchars($_POST['carevoke'])." dosen't exist !</p>";
	    								}
									?>

								</div>
								<br></br>
								<strong>Available Certificate :</strong>
								<?php
								/* Look what file there is in the directory of certifcate to show name of every certificate */
								$cadir = ''.$patheasyrsaopenvpn.'pki/issued';
								$cafiles = array_diff(scandir($cadir), array('..', '.'));
								foreach($cafiles as $careturn)
									{
   										$cafilename = pathinfo($careturn);
										echo '<p>'.$cafilename['filename'], "\n".'</p>';
									}
								?>
								<br></br>
								<br></br>
						</div>
					</article>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>