<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Index</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>



        <!-- Including the nav.php file so the navbar functions -->
        <?php
            session_start();
            include 'nav.php';

        ?>
        <script>  $("#home").addClass("active");</script>

        <h4 style="margin-top:100px; text-align: center">
            <!-- Checking the session and producing a nice welcome message using the users stored details. -->
            <?php

            if (isset($_SESSION['user']) && (strcmp($_SESSION['user']->position, "customer") === 0)) {
                echo 'Hello, ' . $_SESSION['user']->username . '. Welcome to Rocky Rackets.';

            } else {
                echo "You can purchase after you log in.";
            }
            ?>

        </h4>
    </body>
</html>