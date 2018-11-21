<?php
  $path = '';
  require $path.'backend/connect.php';
?>

<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register</title>

    <!-- jQuery source -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/reddit/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/reddit/assets/css/login.css">

</head>
<body>
    <?php
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn,$username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn,$password);
        $trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, trn_date) VALUES ('$username', '".md5($password)."', '$trn_date')";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<div class='form'>
    <h3>You are registered successfully.</h3>
    <br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
    ?>
    <form name="registration" action="" method="post" id="register">
        <h3>Registratie</h3>
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" name="submit" value="Registreren" />
    </form>
    <?php } ?>

    <!-- JavaScript -->
    <script type="text/javascript" src="/reddit/script.js"></script>
</body>
</html>