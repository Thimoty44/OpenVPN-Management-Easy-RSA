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
								<div class="certificategenerationlog">
									<?php
										/* Command executed for the creation of a certificate and return logs */
										chdir(''.$patheasyrsaopenvpn.'');
										$cagenfilebefore = ''.$patheasyrsaopenvpn.'pki/issued/'.htmlspecialchars($_POST['cagen']).'.crt';
										if (file_exists($cagenfilebefore)) {
										echo "<p style='color:red;'>The certificate already exist !</p>";
									} else {
											$output = shell_exec('./easyrsa build-client-full '.htmlspecialchars($_POST['cagen']).' nopass');

											$cagenfile = ''.$patheasyrsaopenvpn.'pki/issued/'.htmlspecialchars($_POST['cagen']).'.crt';
											if (file_exists($cagenfile)) {
	    										echo "<p style='color:green;''>The certificate ".htmlspecialchars($_POST['cagen'])." is created.</p>";
	    									} else {
	    										echo "<p style='color:red;''>The generation failed !</p>.";

	    									}
	    							}
									?>

								</div>
								<br></br>
								<strong>Config OVPN :</strong>
								<br></br>
								<div class="configovpn">
									<?php
									/* Generation of the config OVPN */
									echo "
													client
													<br></br>
													dev tun
													<br></br>
													remote ".$ipserver." ".$portserver."
													<br></br>
													resolv-retry infinite
													<br></br>
													nobind
													<br></br>
													persist-key
													<br></br>
													persist-tun
													<br></br>
													mute-replay-warnings
													<br></br>
													remote-cert-tls server
													<br></br>
													verb 4
													<br></br>
													auth ".$auth."
													<br></br>
													cipher ".$cipher."
													<br></br>
													user nobody
													<br></br>
													group nogroup
													<br></br>
													dev-type tun
													<br></br>
													proto ".$protoserver."
													<br></br>
													comp-lzo ".$complzo."
													<br></br>";
										if ($tls == "true") {
														echo "key-direction 1
														<br></br>
													&ltca&gt
													<br></br>";
													} else {
														echo "<br></br>
													&ltca&gt
													<br></br>";
													}
										$caaform =  'ca.crt';
										$caafilepath = "".$patheasyrsaopenvpn."pki/";
										$caaf = fopen( $caafilepath .$caaform, "r" );
										if (file_exists($caafilepath .$caaform)) {
											while ( $caafdata = fgets($caaf, 1000) ) {
											echo '<pre>'.$caafdata.'</pre>';
											}
										}
										else {
    										echo "<p style='color:red;''>The authorities certificate dosen't exist !</p>.";

    									}
    									echo "&lt/ca&gt
    										  <br></br>
    										  &ltcert&gt
    										  <br></br>";

	    								$caformca =  htmlspecialchars($_POST['cagen']).'.crt';
										$cafilepathca = "".$patheasyrsaopenvpn."pki/issued/";
										$cafca = fopen( $cafilepathca .$caformca, "r" );
										if (file_exists($cafilepathca .$caformca)) {
											while ( $cafdataca = fgets($cafca, 1000) ) {
											echo '<pre>' . htmlspecialchars($cafdataca) . '</pre>';
											}
										}
										else {
    										echo "<p style='color:red;''>The certificate generation failed !</p>.";

    									}

    									echo "&lt/cert&gt
    										  <br></br>
    										  &ltkey&gt
    										  <br></br>";


										$caformkey =  htmlspecialchars($_POST['cagen']).'.key';
										$cafilepathkey = "".$patheasyrsaopenvpn."pki/private/";
										$cafkey = fopen( $cafilepathkey .$caformkey, "r" );
										if (file_exists($cafilepathkey .$caformkey)) {
											while ( $cafdatakey = fgets($cafkey, 1000) ) {
											echo '<pre>' . htmlspecialchars($cafdatakey) . '</pre>';
											}
										}
										else {
    										echo "<p style='color:red;''>The key generation failed !</p>.";

    									}
    									echo "&lt/key&gt";
    									if ($tls == "true") {
    										echo "<br></br>
    										  &lttls-auth&gt
    										  <br></br>";
	    									$takeyform =  'ta.key';
											$takeyfilepath = "".$patheasyrsaopenvpn."pki/";
											$takeyf = fopen( $takeyfilepath .$takeyform, "r" );
											if (file_exists($takeyfilepath .$takeyform)) {
												while ( $takeyfdata = fgets($takeyf, 1000) ) {
												echo '<pre>' .$takeyfdata. '</pre>';
												}
											}
											else {
	    										echo "<p style='color:red;''>The static key dosen't exist !</p>.";

	    									}
	    									echo "&lt/tls-auth&gt
	    									<br></br>";
	    								} else {
	    									echo "";
	    								}
									?>
								</div>
							<br></br>
							<strong>Authorities Certificate :</strong>
							<br></br>
							<div class="acertificateformca">
								<?php
										/* Open the file of authorities certificate */
										$acaformca =  htmlspecialchars('ca.crt');
										$acafilepathca = "".$patheasyrsaopenvpn."pki/";
										$acafca = fopen( $acafilepathca .$acaformca, "r" );
										/* Check if file exist and read the authoritie certificate */
										if (file_exists($acafilepathca .$acaformca)) {
											while ( $acafdataca = fgets($acafca, 1000) ) {
											echo '<pre>' . htmlspecialchars($acafdataca) . '</pre>';
											}
										}
										else {
    										echo "<p style='color:red;''>The certificate dosen't exist !</p>.";

    									}
									?>
							</div>
							<br></br>
									<?php
										if ($tls == "true") {
    										echo '<strong>Static TLS Open VPN Key :</strong><br></br><div class="certificateformkey">';
    										/* Show tls key */
	    									$takeyform =  'ta.key';
											$takeyfilepath = "".$patheasyrsaopenvpn."pki/";
											$takeyf = fopen( $takeyfilepath .$takeyform, "r");
											/* Check if tls key exist */
											if (file_exists($takeyfilepath .$takeyform)) {
												while ( $takeyfdata = fgets($takeyf, 1000) ) {
												echo "<pre>" . $takeyfdata . "</pre>";
												}
											}
											else {
	    										echo "<p style='color:red;''>The static key dosen't exist !</p>.";

	    									}
	    								} else {
	    									echo "";
	    								}
	    							?>
	    					</div>
							<br></br>
							<strong>Certificate :</strong>
							<br></br>
							<div class="certificateformca">
								<?php
										/* Open the certificate file */
										$caformca =  htmlspecialchars($_POST['cagen']).'.crt';
										$cafilepathca = "".$patheasyrsaopenvpn."pki/issued/";
										$cafca = fopen( $cafilepathca .$caformca, "r" );
										/* Check if certificate file exist and read it */
										if (file_exists($cafilepathca .$caformca)) {
											while ( $cafdataca = fgets($cafca, 1000) ) {
											echo '<pre>' . htmlspecialchars($cafdataca) . '</pre>';
											}
										}
										else {
    										echo "<p style='color:red;''>The certificate generation failed !</p>.";

    									}
									?>
							</div>
								<br></br>
								<strong>Key :</strong>
								<br></br>
								<div class="certificateformkey">
									<?php
										/* Open the key file */
										$caformkey =  htmlspecialchars($_POST['cagen']).'.key';
										$cafilepathkey = "".$patheasyrsaopenvpn."pki/private/";
										$cafkey = fopen( $cafilepathkey .$caformkey, "r" );
										/* Check if key file exist and read the key file */
										if (file_exists($cafilepathkey .$caformkey)) {
											while ( $cafdatakey = fgets($cafkey, 1000) ) {
											echo '<pre>' . htmlspecialchars($cafdatakey) . '</pre>';
											}
										}
										else {
    										echo "<p style='color:red;''>The key generation failed !</p>.";

    									}
									?>
								</div>
								<br></br>
								<br></br>
						</div>
					</article>
				</section>
				<?php include("footer.php"); /*Include the footer */ ?>
			</body>
</html>