<?php
include  "./ensureSellerAuthenticated.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller area</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="./search.js"></script>
    <link rel="stylesheet" href="./checkStockStyle.css">

</head>
<body>

<?php
include  "./headerSales.php";
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Check stock for ...</div>
    <div class="panel-body">

        <div id="searchDiv">
            <div class="form-group row">
                <label for="brand" class="col-xs-2 col-form-label">Description</label>
                <div class="col-xs-6">
                    <input class="form-control" type="text" id="description" placeholder="Search by description">
                </div>

                <label for="category" class="col-xs-2 col-form-label ">Category</label>
                <div class="col-xs-2">
                    <select class="form-control" id="category">

                        <option value="general"> Other</option>
                        <option value="racket" selected> Rackets</option>
                        <option value="apparel"> Apparel</option>
                    </select>
                </div>
            </div>


            <a id="advanced"> Advanced </a><br/>

            <div id="moreOptions" style="display:none">
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label "></label>
                    <label for="brand" class="col-xs-2 col-form-label ">Brand</label>
                    <div class="col-xs-3">
                        <input class="form-control input-sm" type="text" id="brand" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-2 col-form-label "></label>
                    <div id="sportInputDiv">
                        <label for="sport" class="col-xs-2 col-form-label ">Sport</label>


                        <div class="col-xs-3">
                            <select class="form-control input-sm" id="sport">
                                <option value="" selected> -- select --</option>
                                <option value="badminton"> Badminton</option>
                                <option value="tennis" > Tennis</option>
                                <option value="squash"> Squash</option>
                            </select>
                        </div>


                    </div>

                    <div style="display:none" id="apparelInputDiv">
                        <label for="color" class="col-xs-2 col-form-label ">Color</label>
                        <div class="col-xs-3">
                            <input class="form-control input-sm" type="text" id="color">
                        </div>
                    </div>


                </div>


            </div>
            <button type="button" class="btn btn-primary pull-right" onclick="searchItemsToOrder()">Search</button>

        </div>


    </div>

</div>

<div id="resultHolder" class="panel">



<!--                <div class="rowDiv ">-->
<!--                    <div class="dataDiv col-xs-10" >-->
<!--                        <img src="/ItemPictures/noImage.png">-->
<!--                        <ul>-->
<!--                            <li><p class="inlineParagraph">Brand:</p> Nike</li>-->
<!--                            <li><p >Description:</p>sdsfdfg sdfdgdfgfgf my name is vladisdfsdfdfffffffffffffffffffff ddddddddddddddddddd dddddddd ddddddddd dddddddddddddddddddd ddddddd</li>-->
<!--                            <li><p class="inlineParagraph">Price:</p>123</li>-->
<!--                            <li>-->
<!--                                <p class="inlineParagraph extraInfo">Sport:</p>badminton-->
<!--                                <p class="inlineParagraph extraInfo">Weight:</p>10grams-->
<!--                                <p class="inlineParagraph extraInfo">Balance:</p>average-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="actionDiv col-xs-2" ">-->
<!--                        <div> Check stock </div>-->
<!--                        <div id="currentQuantity">-->
<!--                            Quantity at your location: <span style="font-weight:bold">32</span>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <button onclick="checkStock();">View stock</button>-->
<!---->
<!--                    </div>-->
<!--                </div>-->









</div>


<!-- display results modal -->

<div id="stockResultModal" class="modal" role="dialog">


    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Stock at locations</h4>
            </div>
            <div class="modal-body" id="stockResultModalBody">

                <table class="table">

                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Location Type</th>
                        <th>Address Line 1</th>
                        <th>Stheet</th>
                        <th>City</th>
                        <th>Post code</th>
                            
                    </tr>
                    

                    </thead>

                    <tbody>

                    </tbody>

                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="modalSubmitButton">Submit</button>
            </div>
        </div>

    </div>
</div>



</body>
</html>