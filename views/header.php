<header>
	<div class="user">
	<?php
		if(isset($_SESSION['username'])) {
			$u = $_SESSION['username'];
	  	echo 'Logged in as <a href="'.$path.'u/user.php?u='.$u.'"><b>' . $u . '</b></a><br>';
	  	echo '<a href="'.$path.'login.php?logout=1"><i>log out</i></a> ';
		} else {
	  	echo '<a href="'.$path.'login.php"><i>log in</i></a> ';
	  	// doesn't work because of auth.php redirecting.
		}
	?>
	</div>

	<div class="index">
	<?php 
		echo '<a href="'.$path.'index.php">index</a>';
	?>
	</div>
	
</header>