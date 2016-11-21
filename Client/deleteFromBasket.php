

<?php

include './ensureCustomerAuthenticated.php';

var_dump($_POST);

if (isset ($_POST["deleteType"])){   $deleteType = $_POST["deleteType"];}else{exit("something went wrong");}




if (strcmp($deleteType, "all")===0){

    $_SESSION['cart'] = array();

}
else if (strcmp($deleteType,"single")===0){

    if (isset ($_POST["id"])){   $id = $_POST["id"];}else{exit("something went wrong");}

    $ind = 0;
    foreach ($_SESSION['cart'] as $item){
        if ( $item->Id == $id){
            array_splice($_SESSION['cart'], $ind, 1);
            break;
        }
        $ind++;
    }


}





?>