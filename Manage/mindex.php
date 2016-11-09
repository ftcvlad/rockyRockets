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
    <script src="searchStaff.js"></script>


</head>
<body>

<?php
    include "mincludes/header.php";
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

        <button type="button" class="btn btn-primary" onclick="searchStaff()">Find</button>

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


    <!-- Modal -->
    <div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                    <div class="input-group">
                        <input type="number" id="salary" class="form-control" >
                        <span class="input-group-addon" id="basic-addon2">Salary</span>

                    </div><!-- /input-group -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="modalSubmitButton">Submit</button>
                </div>
            </div>

        </div>
    </div>



</div>


</body>
</html>