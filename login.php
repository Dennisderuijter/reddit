<?php
	session_start();
  	$path = '';
  	require $path.'backend/connect.php';
?>

<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login</title>

	<!-- jQuery source -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/reddit/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/reddit/assets/css/login.css">

</head>
<body>

	<?php
	// If form submitted, insert values into the database.
	if (isset($_POST['username'])){
	    // removes backslashes
		$username = stripslashes($_REQUEST['username']);
	    //escapes special characters in a string
		$username = mysqli_real_escape_string($conn,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn,$password);
		//Checking is user existing in the database or not
	    $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
	    	$_SESSION['username'] = $username;
            // Redirect user to index.php
	    	header("Location: index.php");
        } else {
			echo "<div class='form' id='login'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
		}
	} else{
		if (isset($_GET['logout'])) {
			echo "You are succesfully logged out!";
		}
	?>

	<form action="" method="post" id="login">
		<section>
			<h3>Aanmelden</h3>
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="submit">
		</section>
		<p>Nog geen account? <a href='register.php'><i>Registreer hier</i></a></p>
	</form>

	<?php } ?>

	<!-- JavaScript -->
	<script type="text/javascript" src="/reddit/script.js"></script>

</body>
</html>
