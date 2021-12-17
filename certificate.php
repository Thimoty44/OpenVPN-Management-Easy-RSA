<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Certificate</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("header.php"); /* Include of the header */ ?>
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
							<strong>Available Certificate :</strong>
							<?php
								/* Variable who look for the directory of certificate file */
								$cadir = ''.$patheasyrsaopenvpn.'pki/issued';
								/* Scan of the directory */
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
				<?php include("footer.php"); /* Include of the foorter */ ?>
			</body>
</html>