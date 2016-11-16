<!-- Latest compiled and minified CSS -->

<?php
include  "./ensureSellerAuthenticated.php";
?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<body>


<?php
include  "./headerSales.php";
?>


<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">


                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="view_profile.php">
                                <i class="glyphicon glyphicon-home"></i>
                                View Profile </a>
                        </li>
                        <li>
                            <a href="editprofile.php">
                                <i class="glyphicon glyphicon-user"></i>
                                Edit Profile </a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>

<br>
<br>

</body>
</html>
