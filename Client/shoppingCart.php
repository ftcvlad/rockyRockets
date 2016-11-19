<?php
include './ensureCustomerAuthenticated.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Basket</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/removeFromCart.js"></script>
</head>
<body>



<?php include 'nav.php';?>
<script>  $("#basket").addClass("active");</script>

<h3> Your basket </h3>

    <?php if (sizeof($_SESSION['cart'])>0){?>
        <table class="table">
            <thead>
                <tr>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>

            <?php
                        foreach($_SESSION['cart'] as $item) {
                                   echo "<tr data-id='".$item->Id."'>
                                            <td>".$item -> Quantity."</td>
                                            <td>".$item -> Price."</td>
                                            <td>".$item -> Brand."</td>
                                            <td>".$item -> Description."</td>
                                            <td><button>Remove</button></td>
                                            
                                        </tr>";

                        }
            ?>

            </tbody>


        </table>
    <?php }?>
<?php







?>


<form action="deleteBasket.php">
<button input type="submit" class='btn btn-primary'>Clear basket</button><p>
</form>

<form action="purchase.php">
<button input type="submit" class='btn btn-primary'>Purchase</button><p>
</form>

</body>