<header>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<?php include("config.php"); /* Include config of the website */ ?>
	<?php
	// Starting session
	session_start();
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		header('Location: login.php');
		exit;
	}
	?>
	<div class="logoheader">
	<img src="openvpnlogo.png" class="logologin" alt="logo" title="Logo OpenVPN" />
	</div>
	<nav>
		<div class="navbutton">
			<a href="index.php" style="color: inherit; text-decoration: none;">Home</a>&emsp;<a href="certificate.php" style="color: inherit; text-decoration: none;">Certificate</a>&emsp;<a href="ip.php" style="color: inherit; text-decoration: none;">IP Address</a>
		</div>
		<div id="logoutbutton">
			<a href="profile.php" style="color: inherit; text-decoration: none;">Profile&emsp;</a><a href="logout.php" style="color: inherit; text-decoration: none;">Logout</a>
		</div>
	</nav>
</header>