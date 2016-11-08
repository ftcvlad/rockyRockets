<?php
include "mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Hr")!==0){

    echo "Only HR manager can edit staff";
    die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager area</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="logout.js"></script>
    <script src="managerJs.js"></script>


</head>
<body>

<?php
include "mincludes/header.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Add staff</div>
    <div class="panel-body">

        <div class="input-group input-group-lg">
            <input type="text" class="form-control" placeholder="Name or surname" id="criteria" name="criterion">
        </div>

        <div class="input-group input-group-sm">
            <label for="posSel">Position:</label>
            <select class="form-control" id="posSel" name="positionCriterion">
                <option value="any">Any</option>
                <option value="manager">Manager</option>
                <option value="seller">Seller</option>

            </select>
        </div>

        <button type="button" class="btn btn-primary" onclick="addStaff()">Add</button>

    </div>








</div>


</body>
</html>