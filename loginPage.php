<?php
    include "includes/ensureNotAuthenticated.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="login.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="login.css">

</head>
<body>

<div class="container">
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <div class="form-signin"  action="login.php" method="POST">
            <span id="reauth-email" class="reauth-email"></span>
            <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username"  required autofocus>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <div id="remember" class="checkbox">


                <label class="radio-inline"><input type="radio" name="userTypeRadio" value="customer">Customer</label>
                <label class="radio-inline"><input type="radio" name="userTypeRadio" value="manager" checked="true">Manager</label>
                <label class="radio-inline"><input type="radio" name="userTypeRadio" value="seller">Seller</label>


            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" onclick="checkLoginDetails()">Sign in</button>
        </div>
        <a href="registerCustomer.html" class="forgot-password">
            Register as customer
        </a>
        <p id="error"></p>
    </div><!-- /card-container -->
</div><!-- /container -->



</body>
</html>