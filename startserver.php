<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Management OpenVPN - Index</title>
		<link rel="stylesheet" href="style.css" />
	</head>
			<body>
				<?php include("header.php"); /* Include the header */ ?>
				<br>
				</br>
				<section>
					<div id=serverbutton>
							<form method="post" action="startserver.php">
   							<input type="submit" value="Start server" />
   							</form><form method="post" action="stopserver.php">
   							<input type="submit" value="Sop server" /></form>
   							<form method="post" action="restartserver.php">
   							<input type="submit" value="Restart server" />
   							</form>
   							<?php
   							/* Execute the commande who start the server */
							$output = shell_exec('sudo systemctl start '.$serviceopenvpn.'');
							?>
   						</div>
					<article>
						<div id=status>
							<p><strong>State of the server :</strong>
								<?php
									/* Execute a commande who return status of the server and show it */
									$output = shell_exec('systemctl status '.$serviceopenvpn.'');
									if (strpos($output, 'running') !== false) {
										echo "<strong><p style='color:green;''>Server Online</p></strong>";
    									echo "<pre style='color:green;''>$output</pre>";
									} else {
										echo "<strong><p style='color:red;''>Server Offline</p></strong>";
										echo "<pre style='color:red;''>$output</pre>";
									}
								?>

							</p>
						</div>
					</article>
				</section>
				<?php include("footer.php"); /* Include the footer */ ?>
			</body>
</html>