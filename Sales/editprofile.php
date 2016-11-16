<?php
    include  "./ensureSellerAuthenticated.php";
?>

<!-- Latest compiled and minified JavaScript -->
<!DOCTYPE html>
<html lang="en">
<head>


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="editProfileStyle.css">

</head>
<body>


<?php
include "../includes/db.php";


$staffId = $_SESSION['user']->staffId;

$sql = "SELECT  FirstName, LastName, ContactNumber, Email, UserName, Password FROM staff WHERE Id =".$staffId;

$result = $connection->query($sql);
$resultArray = $result->fetch_assoc();

$FirstName = $resultArray['FirstName'];
$LastName = $resultArray['LastName'];
$ContactNumber = $resultArray['ContactNumber'];
$Email = $resultArray['Email'];
$UserName = $resultArray['UserName'];
$Password = $resultArray['Password'];


?>

<?php
include "./headerSales.php";
?>





<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Edit Staff Profile</h2>
    </div>
    <div class="panel-body">

        <form action="updateprofile.php" method="post" id="editProfileForm" >
            <div class="form-group row">
                <label class="control-label col-sm-2" for="First Name">First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="FirstName" placeholder=""
                           value="<?php echo $FirstName; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="Last Name">Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LastName" placeholder=""
                           value="<?php echo $LastName; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="ContactNumber">Contact Number:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ContactNumber" placeholder=""
                           value="<?php echo $ContactNumber; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="Email">Email:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Email" placeholder="" value="<?php echo $Email; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2 mandatory" for="username">Username:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control " id="username" name="username" placeholder=""
                           value="<?php echo $UserName; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-2 mandatory" for="password">Password:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control " id="password" name="password" placeholder=""
                           value="<?php echo $Password; ?>">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>

            <div class="form-group row">
                 <label class="control-label col-sm-2 "></label>

                <?php if($_GET && $_GET['result']){?>
                    <p id="errorPar"><?php echo $_GET['result']?></p>
                <?php } ?>

            </div>
        </form>

    </div>


</div>




</body>
</html>
