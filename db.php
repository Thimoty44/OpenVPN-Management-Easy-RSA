<?php include("config.php"); /* include the config of website */ ?>
<?php
	/* Include connection to datbase */
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
							if (mysqli_connect_errno()) {
								exit('Failed to connect to MySQL: ' . mysqli_connect_error());
							}
?>