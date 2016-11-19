<?php
include './ensureCustomerAuthenticated.php';

//var_dump($_POST);
//exit();

if (isset ($_POST["Id"])){   $id = $_POST["Id"];}else{exit("something went wrong");}
if (isset ($_POST["Quantity"])){   $quantity = $_POST["Quantity"];}else{exit("something went wrong");}
if (isset ($_POST["Brand"])){   $brand = $_POST["Brand"];}else{exit("something went wrong");}
if (isset ($_POST["Price"])){   $price = $_POST["Price"];}else{exit("something went wrong");}
if (isset ($_POST["Description"])){   $description = $_POST["Description"];}else{exit("something went wrong");}


//if item already in cart
$found = false;
foreach ($_SESSION['cart'] as $item){
    if ( $item->Id == $id){
        $item->Quantity = ($item-> Quantity)+ $quantity;
        $found= true;
        break;
    }
}

//if a new item
if (!$found){
    $item = (object) array('Id' => $id, 'Quantity' => $quantity,'Brand'=>$brand, 'Price'=> $price, 'Description'=>$description);
    array_push($_SESSION['cart'], $item);
}










