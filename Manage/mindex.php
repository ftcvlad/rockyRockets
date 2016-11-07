<?php
    include "mIncludes/ensureAuthenticated.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager area</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="logout.js"></script>
    <script src="managerJs.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="manageStyles.css">
</head>
<body>

<?php
    include "../includes/header.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Search staff</div>
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

        <button type="button" class="btn btn-primary" onclick="searchStaff()">Primary</button>

    </div>

    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Phone</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Department</th>
                <th>LocationType</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>


</body>
</html>