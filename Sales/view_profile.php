
<?php

include  "./ensureSellerAuthenticated.php";
include '../includes/db.php';



$staffId = $_SESSION['user']->staffId;


//$sql = "SELECT  FirstName, LastName, DOB, ContactNumber, Email, UserName, Position, Salary FROM staff WHERE Id =".$staffId;

$stmt = $connection->prepare("CALL  viewProfileStaffProcedure(?)");
$stmt->bind_param("i",$staffId);
if ($stmt===false){
    http_response_code(404);
    echo "wrong type";
    return;
}
$stmt->execute();

//http://stackoverflow.com/questions/3966747/how-to-call-a-mysql-stored-procedure-from-within-php-code

//vs

//http://php.net/manual/en/mysqli.quickstart.stored-procedures.php
$res = $stmt->get_result();

$resultArray = mysqli_fetch_array($res);





$FirstName = $resultArray['FirstName'];
$LastName = $resultArray['LastName'];
$DOB = $resultArray['DOB'];
$ContactNumber = $resultArray['ContactNumber'];
$Email = $resultArray['Email'];
$UserName = $resultArray['UserName'];
$Position = $resultArray['Position'];
$Salary = $resultArray['Salary'];

?>

<!DOCTYPE html>
<html>
<head>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="editProfileStyle.css">
</head>
<body>


<?php
    include "./headerSales.php";

?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h2>View profile</h2>
    </div>
    <div class="panel-body">


            <div class="form-group row">
                <label class="control-label col-sm-2" for="First Name">First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="FirstName" disabled placeholder=""
                           value="<?php echo $FirstName; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="Last Name">Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LastName" disabled placeholder=""
                           value="<?php echo $LastName; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="Last Name">Date of birth:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LastName" disabled placeholder=""
                           value="<?php echo $DOB; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="ContactNumber">Contact Number:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ContactNumber" disabled placeholder=""
                           value="<?php echo $ContactNumber; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="Email">Email:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Email" placeholder="" disabled value="<?php echo $Email; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2 " for="username">Username:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control " id="username" name="username"  disabled placeholder=""
                           value="<?php echo $UserName; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-2 " for="position">Position:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control " id="position" name="position" disabled placeholder=""
                           value="<?php echo $Position; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2 " for="salary">Salary:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control " id="salary" name="salary" disabled placeholder=""
                           value="<?php echo $Salary; ?>">
                </div>
            </div>

    </div>


</div>




</body>
</html>
