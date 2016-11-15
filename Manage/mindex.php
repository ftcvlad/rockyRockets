<?php
    include  "mIncludes/ensureAuthenticated.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager area</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="./searchStaff.js"></script>
    <link rel="stylesheet" href="./manageStyles.css">


</head>
<body>

<?php
    include  "mIncludes/header.php";

?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Search staff</div>
    <div class="panel-body">




        <div class="form-inline">

            <div class="input-group input-group-sm" style="margin-right:20px" >
                <label for="criteria">Name/Surname:</label>
                <input type="text" class="form-control"  id="criteria" name="criterion">
            </div>

            <div class="input-group input-group-sm"  style="margin-right:20px">
                <label for="posSel">Position:</label>
                <select class="form-control" id="posSel" name="positionCriterion">
                    <option value="any">Any</option>
                    <option value="manager">Manager</option>
                    <option value="seller">Seller</option>
                </select>
            </div>

            <div class="input-group input-group-sm"  style="margin-right:20px">
                <label for="order">Order by:</label>
                <select class="form-control" id="order" name="orderby">
                    <option value="Position" selected>Position</option>

                    <?php if (strcmp($_SESSION['user']->department,"Hr")===0){?>
                        <option value="Salary">Salary</option>
                    <?php  } ?>

                    <option value="DepartmentType">Department</option>
                    <option value="LocationType">Location type</option>
                </select>
            </div>
        </div>

        <button type="button" class="btn btn-primary" style="margin-top:20px;" onclick="searchStaff()">Find</button>

    </div>

    <!-- Table -->
    <table class="table table-striped table-hover">
        <thead>

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