
<?php

    include './ensureCustomerAuthenticated.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/viewPastPurchases.css">
</head>
<body>


<?php
include 'nav.php';
?>

<script>  $("#profile").addClass("active");</script>
<?php


include "../includes/db.php";


$customerId = $_SESSION['user']->customerId;

$query = "select purchase.Id as pID, Price,Description, Brand, Quantity, Date
        FROM purchase
        INNER JOIN purchase_has_differentitem ON purchase_has_differentitem.PurchaseId=purchase.Id
        INNER JOIN differentitem on differentitem.id=purchase_has_differentitem.ItemId
        Where purchase.customerID = ".$customerId."
        ORDER BY Date DESC";

$stmt = $connection->prepare($query);
$stmt->execute();
$res = $stmt->get_result();

$previousPurhaseId=-1; 
$pCount=0;
while ($rows = mysqli_fetch_array($res)) {
    if ($rows['pID']!=$previousPurhaseId){
        $previousPurhaseId= $rows['pID'];
        $pCount++;
    }
}
mysqli_data_seek($res, 0);//go back to beginning



?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Past purchases</h2>
    </div>
    <div class="panel-body">

        
        
        <?php if ($res-> num_rows ==0): ?>
            <h3>You have no past purchases </h3>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $previousPurhaseId=-1;
                    while ($rows = mysqli_fetch_array($res)) {
                        
                        $firstColTD = "";
                        $evenPurchaseClass = "";

                        if ($rows["pID"] != $previousPurhaseId){
                            $previousPurhaseId = $rows["pID"];
                            $firstColTD=$pCount; 
                            $pCount--;
                        }

                        if ($pCount%2==0){
                            $evenPurchaseClass = "evenPurchase";
                        }
                        echo "<tr class='".$evenPurchaseClass."'><td>".$firstColTD."</td>
                                <td>".$rows['Price']."</td>
                                <td>".$rows['Description']."</td>
                                <td>".$rows['Brand']."</td>
                                <td>".$rows['Quantity']."</td>
                                <td>".$rows['Date']."</td>
                                </trclas>";
                               
    
                    }
                
                ?>
                
                
                
                
                
                </tbody>
            </table>


        <?php endif; ?>
        
        


    </div>


</div>





</body>
</html>