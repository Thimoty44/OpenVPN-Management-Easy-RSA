<footer>
	<div class="powered">Powered by Thimoty</div>
	<div class="onlinefooter">
		<?php
		/* Check who is log to return the result at the left bottom of the page */
		if ($_SESSION['name'] == "")
			{
			echo "Your are not connected";
		}
		else
		{
			echo "Your are connected as ".$_SESSION['name'].".";
		}
		?>
	</div>
	<div class="version">
		<?php
		    /* Show version of the website */
			$version = fopen( "version.txt", "r" );
			while ( $versiondata = fgets($version, 1000) ) {
			echo "Version ".$versiondata."";
		}
		?>
	</div>
</footer>