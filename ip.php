<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - IP Address</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("header.php"); /* include of the header */ ?>
				<br>
				</br>
				<section>
					<article>
						<div id="ipp"
							<?php
								/* Variable who go search for the ipp.txt file */
								$ippfile = "".$ippconf."";
								/* Variable who open the ipp.txt file */
								$ipp = fopen( $ippfile, "r" );
								/* Loop who read every line of the ipp.txt file */
								while ($ippdata = fgets($ipp, 1000) ) {
								/* Regex with the pattern to find name of certificate */
								$numberspattern = '*,$';
								/* Regex with the pattern who find the ip */
								$numberspattern2 = '/([0-9]+\.[0-9]+\.[0-9]+\.)([0-9]+)/';
								/* Function who find the occurence of the ip */
								preg_match($numberspattern2, $ippdata, $output_ip);
								/* Calcul of the ip (not the good ip because openvpn use 3 ip for one) */
								$numbersipfinal ="".(int)$output_ip[2].""+2;
								/* Function who find the occurence of the certificate name */
								preg_match("/(.*),/", $ippdata, $output_split);
								/* We shot the waiting result for show ip */
								echo "<p>".$output_split[0]." ".$output_ip[1]."".$numbersipfinal."</p>";
								}
							?>
							<br>
							</br>
							<br>
							</br>
						</div>
					</article>
				</section>
				<?php include("footer.php"); /* Include of the footer */ ?>
			</body>
</html>