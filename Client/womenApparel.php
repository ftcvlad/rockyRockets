<!DOCTYPE html>
<html lang="en">
<head>
    <title>Women's Apparel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/addToCart.js"></script>
</head>
<body>


<?php session_start();
include 'nav.php'; ?>


<script>  $("#woman").addClass("active");</script>

<div id="thumbnailHolder">
    <?php

    include '../includes/db.php';

    $query = "SELECT * FROM customer_womenitems";

    $stmt = $connection->prepare($query);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($rows = mysqli_fetch_array($res)) {


        $Id          = $rows['Id'];
        $Description = $rows['Description'];
        $Brand       = $rows['Brand'];
        $Price       = $rows['Price'];
        $ImagePath   = $rows['ImagePath'] == null ? "noImage.png" : $rows['ImagePath'];
        $Size  = $rows['Size'];
        $Color = $rows['Color'];


        echo " 
                
                <div class='col-sm-6 col-md-4 '>
                    <div class='thumbnail' data-desc='$Description' data-id='$Id' data-price='$Price' data-brand='$Brand' data-img='$ImagePath' data-size='$Size' data-color='$Color'>
                        <h3 style='padding: 0px 10px;' >$Description</h3>
                        <h4 style='padding: 0px 10px;'>£$Price</h3>
                        <h4 style='padding: 0px 10px;'>$Brand</h3>
                      
                        <img src=../ItemPictures/$ImagePath width='200' height='200' style='padding: 10px 5px;' />
                        
                        <!-- More info button to see more information about the product, buy it, etc. -->
                        <button type='button' class='btn btn-primary btn-lg' onclick='addModal(this, 2)' >More info</button>
        
                    </div>
                </div>		  
          ";


    }


    ?>
</div>
<div class='modal ' id='addToBasketModal' tabindex='-1' role='dialog' data-id="">
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                            aria-hidden='true'>&times;</span></button>

                <!-- Update basket -->
                <!-- This is the name of the product -->
                <h3 id="modalBrand"></h3>
                <h4 id="modalDescription" class='modal-title'></h4>
            </div>

            <!-- This is the image of the item -->
            <!-- Image variable here -->
            <div class='modal-body' align='center'>
                <img id="modalImg" width='200' height='200' style='padding: 10px 5px;'/>

                <h1 id="modalPrice"></h1>
                ______
                <h3 id="modalSize"></h3>
                <h4 id="modalColor"></h4>
            </div>

            <!-- This is the divider for the buttons in the script -->
            <div class='modal-footer form-inline' style='padding: 20px 5px;'>

                <!-- This part offers a cancel option to close the pop-up -->
                <button type='button' class='btn btn-default' style='float: left;' data-dismiss='modal'>Cancel</button>

                <?php if (isset($_SESSION['user']) && strcmp($_SESSION['user']->position,"customer")===0) :?>
                    <select name='Quantity' class='form-control' id="modalQuantity">
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='5'>5</option>
                        <option value='10'>10</option>
                    </select>
                    <button type='submit' class='btn btn-primary' onclick="addToBasket()"> Add to basket</button>

                <?php else:?>

                <?php endif; ?>



            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>