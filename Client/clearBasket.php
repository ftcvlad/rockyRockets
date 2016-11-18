<?php
session_start();
include '../includes/db.php';
?>

<?php

function CYA(){
	unset($array);
	
}

header("Location: shoppingBasket.php");
?>