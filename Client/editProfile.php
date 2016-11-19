<?php

    include './ensureCustomerAuthenticated.php';
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/editCustomer.css">
</head>
<body>


    <?php
    include 'nav.php';
    ?>

    <script>  $("#profile").addClass("active");</script>
    <?php

    include 'nav.php';
    include "../includes/db.php";


    $customerId = $_SESSION['user']->customerId;

    $sql = "SELECT  FirstName, LastName, AddressLine1, Street, City, PostCode, UserName,Password 
            FROM customer WHERE Id =".$customerId;

    $result = $connection->query($sql);
    $resultArray = $result->fetch_assoc();

    $FirstName = $resultArray['FirstName'];
    $LastName = $resultArray['LastName'];
    $AddressLine1 = $resultArray['AddressLine1'];
    $Street = $resultArray['Street'];
    $City = $resultArray['City'];
    $PostCode = $resultArray['PostCode'];
    $UserName = $resultArray['UserName'];
    $Password = $resultArray['Password'];


    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Edit Customer Profile</h2>
        </div>
        <div class="panel-body">

            <form action="./updateProfile.php" method="post" id="editProfileForm" >
                <div class="form-group row">
                    <label class="control-label col-sm-2" >First Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="FirstName"  placeholder="" required
                               value="<?php echo $FirstName; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" >Last Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="LastName" placeholder="" required
                               value="<?php echo $LastName; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" >AddressLine1</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="AddressLine1" placeholder="" required
                               value="<?php echo $AddressLine1; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2 mandatory" >Street:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control "  name="Street" placeholder="" required
                               value="<?php echo $Street; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" >City:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="City" placeholder="" required value="<?php echo $City; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2 mandatory" >PostCode:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control "  name="PostCode" placeholder="" required
                               value="<?php echo $PostCode; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2 mandatory">Username:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control "  name="Username" placeholder="" required
                               value="<?php echo $UserName; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2 mandatory" >Password:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control "  name="Password" placeholder="" required
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




                    <?php if ($_GET && $_GET['result']): ?>
                        <p id="errorPar"><?php echo $_GET['result']?></p>
                    <?php else: ?>
                        <p id="errorPar"></p>
                    <?php endif; ?>



                </div>
            </form>

        </div>


    </div>




	
</body>
</html>