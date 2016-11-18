<?php 
session_start();
include '../includes/db.php';

unset($_SESSION['Cart']);

header("Location: shoppingCart.php");
?>