<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Hr")!==0){

    echo "Only HR manager can edit staff";
    die();
}


include  $_SERVER['DOCUMENT_ROOT']."/includes/db.php";


$query = "SELECT staff_department.Id, DepartmentType, LocationType, AddressLine1, Street, City, PostCode
            FROM staff_department
            LEFT JOIN location
            ON location.Id= staff_department.LocationId
            ORDER BY LocationType ASC, PostCode ASC;";

$stmt = $connection->prepare($query);
$stmt->execute();
$res = $stmt->get_result();

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager area</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../logout.js"></script>

    <script src="mAddStaffJs.js"></script>


</head>
<body>

<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/header.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Add staff</div>
    <div class="panel-body">


        <div class="form-group row">
            <label for="addNameInput" class="col-xs-2 col-form-label mandatoryItem">Name</label>
            <div class="col-xs-10">
                <input class="form-control validatableInput" type="text"  id="addNameInput" maxlength="20" placeholder="20 max" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="addSurnameInput" class="col-xs-2 col-form-label mandatoryItem">Surname</label>
            <div class="col-xs-10">
                <input class="form-control validatableInput" type="text"  id="addSurnameInput" maxlength="20" placeholder="20 max" name="surname">
            </div>
        </div>
        <div class="form-group row">
            <label for="addSalaryInput" class="col-xs-2 col-form-label mandatoryItem">Salary</label>
            <div class="col-xs-10">
                <input class="form-control validatableInput" type="number"  id="addSalaryInput" name="salary">
            </div>
        </div>

        <div class="form-group row">
            <label for="addUsernameInput" class="col-xs-2 col-form-label mandatoryItem">Username</label>
            <div class="col-xs-10">
                <input class="form-control validatableInput" type="text"  id="addUsernameInput" maxlength="16" placeholder="16 max" name="username">
            </div>
        </div>
        <div class="form-group row">
            <label for="addPasswordInput" class="col-xs-2 col-form-label mandatoryItem">Temp password</label>
            <div class="col-xs-10">
                <input class="form-control validatableInput" type="text"  id="addPasswordInput" maxlength="16" placeholder="16 max" name="password">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label mandatoryItem" id="posLabel">Employee type</label>
            <div class="col-xs-10">
                <label class="radio-inline"><input type="radio" name="position" value="manager">Manager</label>
                <label class="radio-inline"><input type="radio" name="position" value="seller" >Seller</label>
            </div>

        </div>

        <div class="form-group row">
            <label class="col-xs-2 col-form-label mandatoryItem" id="depLabel">Department</label>
            <div class="col-xs-10">
                <select class="form-control" id="dapartmentSelect" name="positionCriterion">
                    <option disabled selected value="-1" > -- select  -- </option>


                    <?php
                        while($r = $res->fetch_assoc()) {
                            $addrstr = $r['PostCode']." ".$r['AddressLine1']." ".$r['Street']." ".$r['City'];
                            $locType = $r['LocationType'];
                            $depType = $r['DepartmentType'];

                            $text = $locType.", ".$depType.", ".$addrstr;
                            echo "<option value=\"".$r['Id']."\">".$text."</option>";


                        }





                    ?>



                </select>
            </div>

        </div>



        <button type="button" class="btn btn-primary" onclick="addStaff()">Add</button>










</div>


</body>
</html>