<?php
include "includes/ensureNotAuthenticated.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="register.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="login.css">


</head>
<body>

<div class="container">
    <div class="card card-container">

        <form class="form-signin"  action="signup.php" method="POST" id="registerForm">
            <span id="reauth-email" class="reauth-email"></span>
            <input type ="text" name="FirstName" class="form-control" placeholder="FirstName" required >
            <input type ="text" name="LastName" class="form-control" placeholder="LastName" required>
            <input type ="text" name="AddressLine1" class="form-control" placeholder="AddressLine1" required>
            <input type ="text" name="Street" class="form-control" placeholder="Street" required>
            <input type ="text" name="City" class="form-control" placeholder="City" required>
            <input type ="text" name="PostCode" class="form-control" placeholder="PostCode" required >
            <input name="username" type="text" id="username" class="form-control" placeholder="Username"  required autofocus>
            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>

            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" onclick="validateFields()">Sign up</button>
        </form>
        <a href="loginPage.php">
            Login
        </a>

        <?php if ($_GET && $_GET['result']): ?>
            <p id="error"><?php echo $_GET['result']?></p>
        <?php else: ?>
            <p id="error"></p>
        <?php endif; ?>


    </div><!-- /card-container -->
</div><!-- /container -->



</body>
</html>