<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Sales")!==0){

    echo "Only Sales manager can edit staff";
    die();
}


include  $_SERVER['DOCUMENT_ROOT']."/includes/db.php";


$query = "SELECT Organization, PostCode, Id
            FROM Supplier
            ORDER BY Organization";

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

    <script src="createItem.js"></script>


</head>
<body>

<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/header.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Add new item. Make sure the item has never been traded before</div>
    <div class="panel-body">


        <div class="form-group row">
            <label for="description" class="col-xs-2 col-form-label mandatoryItem">Description</label>
            <div class="col-xs-10">
                <textarea rows="2" class="form-control"  id="description" ></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="brand" class="col-xs-2 col-form-label">Brand</label>
            <div class="col-xs-4">
                <input class="form-control" type="text"  id="brand" >
            </div>

            <label for="price" class="col-xs-2 col-form-label mandatoryItem">Price</label>
            <div class="col-xs-2">
                <input class="form-control mandatoryItem" type="number" min="0" id="price">
            </div>
        </div>




        <div class="form-group row">
            <label class="col-xs-2 col-form-label mandatoryItem" for="supplier">Supplier</label>
            <div class="col-xs-4">
                <select class="form-control" id="supplier" >
                    <option  selected value="-1" > -- select  -- </option>
                    <?php
                    while($r = $res->fetch_assoc()) {
                        $text =$r['Organization'].", ".$r['PostCode'];
                        echo "<option value=\"".$r['Id']."\">".$text."</option>";
                    }
                    ?>
                </select>
            </div>

            <label for="itemCode" class="col-xs-2 col-form-label">Item code</label>
            <div class="col-xs-2">
                <input class="form-control " type="text"  id="itemCode">
            </div>

        </div>

        <div class="form-group row">

            <label class="col-xs-2 col-form-label mandatoryItem" for="category">Category</label>
            <div class="col-xs-2">
                <select class="form-control" id="category" >
                    <option selected value="general" > General </option>
                    <option value="racket">Racket</option>
                    <option value="apparel">Apparel</option>
                </select>
            </div>

            <label class="col-xs-2 col-form-label"></label>

            <label class="col-xs-2 col-form-label" for="image">Image</label>
            <div class="col-xs-2">
                <input type="file" id="image">
            </div>
        </div>


        <div class="row" >

            <button  type="button" class="btn btn-primary col-xs-2" onclick="saveItem()">Create</button>
            <div class="col-xs-10">
                <div  class="greyDiv form-inline" id="racketFields">
                    <label class=" col-form-label" for="model">Sport</label>
                    <select class="form-control" id="sport" >
                        <option selected disabled value=""> -- select -- </option>
                        <option value="tennis" > Tennis </option>
                        <option value="badminton">Badminton</option>
                        <option value="squash">Squash</option>
                    </select>




                    <label class=" col-form-label" for="balance">Balance</label>
                    <input class="form-control" type="text" id="balance">

                    <label class=" col-form-label" for="weight">Weight</label>
                    <input class="form-control" type="text" id="weight">
                </div>


                <div class="greyDiv form-inline" id="apparelFields">
                    <label class=" col-form-label" for="size">Size</label>
                    <input class="form-control" type="text" id="size">


                    <label class="col-form-label" for="color">Color</label>
                    <input class="form-control" type="text" id="color">


                    <label class="col-form-label" >Gender</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="1" >M</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="0" >F</label>

                </div>



            </div>



        </div>








    <div id="canvasDiv"></div>







    </div>


</body>
</html>