<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Sales")!==0){

    echo "Only Sales manager can edit staff";
    die();
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager area</title>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../logout.js"></script>

    <script src="orderItem.js"></script>


</head>
<body>

<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/header.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Search item to order</div>
    <div class="panel-body">

    <div id="searchDiv">
        <div class="form-group row">
            <label for="brand" class="col-xs-2 col-form-label">Description</label>
            <div class="col-xs-6">
                <input class="form-control" type="text"  id="description" placeholder="Search by description" >
            </div>

            <label for="category" class="col-xs-2 col-form-label ">Category</label>
            <div class="col-xs-2">
                <select class="form-control" id="category" >

                    <option   value="general" > Other </option>
                    <option   value="rackets" selected > Rackets </option>
                    <option   value="apparel" > Apparel </option>
                </select>
            </div>
        </div>


        <a id="advanced">         Advanced        </a><br/>

        <div id="moreOptions" style="display:none">
            <div class="form-group row">
                <label class="col-xs-2 col-form-label "></label>
                <label for="fromPrice" class="col-xs-2 col-form-label ">Price from</label>
                <div class="col-xs-2">
                    <input class="form-control input-sm" type="number"  id="fromPrice" >
                </div>

                <label for="toPrice" class="col-xs-2 col-form-label ">Price to</label>
                <div class="col-xs-2">
                    <input class="form-control input-sm" type="number"  id="toPrice" >
                </div>

            </div>
            <div class="form-group row">
                <label class="col-xs-2 col-form-label "></label>
                <label for="brand" class="col-xs-2 col-form-label ">Brand</label>
                <div class="col-xs-2">
                    <input class="form-control input-sm" type="text"  id="brand" placeholder="" >
                </div>
            </div>



        </div>
        <button type="button" class="btn btn-primary pull-right" onclick="searchItemsToOrder()">Search</button>

    </div>









    </div>


</body>
</html>