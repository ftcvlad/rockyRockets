

<?php

include './ensureCustomerAuthenticated.php';


session_start();
//USE ME TO DELETE INDIVIDUAL ITEM OR WHOLE CART

unset($_SESSION['Cart']);

header("Location: shoppingCart.php");
?>