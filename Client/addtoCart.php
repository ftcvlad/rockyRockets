<?php
session_start();
include '../includes/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Added to cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<?php include 'nav.php';?>

<?php
 
//The program skips this the first time around because there's no array to be pushed into.
if (!empty($_SESSION['Cart'])){ 	 		
array_push($_SESSION['Cart'], $_GET['Id'], $_GET['Description'], $_GET['Brand'], $_GET['Price']);
}

//This is where the array is created after the first run through.
//How the heck do I set every four rows of the array to Item ID, Name of Item, Brand and Price??
else if (empty($_SESSION['Cart'])) {
	$_SESSION['Cart'] = array('Item ID:' => $_GET['Id'], 'Name of item:' => $_GET['Description'], 'Brand' => $_GET['Brand'], 'Price: £' => $_GET['Price']);
}

?>


<p>
	<h2>The item was successfully added to your cart.</h2>
</p>

<form action="shoppingCart.php">
<button class='btn btn-primary'>Shopping Cart</button>
</form>


<form action="rackets.php">
<button class='btn btn-primary'>Shop more</button>
</form>
</body>