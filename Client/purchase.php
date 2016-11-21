<?php
include  "./ensureCustomerAuthenticated.php";
include '../includes/db.php';


if ( sizeof($_SESSION['cart'])==0){
    die ("something went wrong!");
}

$idsToBuy = "";
$quantitiesToBuy="";
foreach ($_SESSION['cart'] as $item){
    $idsToBuy = $idsToBuy.$item->Id.",";
    $quantitiesToBuy = $quantitiesToBuy.$item->Quantity.",";
}


$procStr = 'CALL  updateProfileStaffProcedure("'.$idsToBuy.'","'.$quantitiesToBuy.'",'.$_SESSION['user']->customerId.')';


$stmt = $connection->prepare($procStr);
$stmt->execute();

if ($stmt===false){//database disconnected or whatever
    http_response_code(500);
    die("Database error");
}

$_SESSION['cart'] = array();

echo "purchased successfully!";





?>