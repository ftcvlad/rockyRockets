<?php
session_start();
include '../includes/db.php';
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
</head>
<body>



<?php include 'nav.php';?>
<h3> Your basket </h3>
<?php

$whereIn = implode(',', $_SESSION['Cart']);

$totalItems = count($_SESSION['Cart']);

echo '<p>You have : ';
echo $totalItems/4;
echo ' product(s) in your basket.';

$i = 0;

//Maybe this for selection every 4th entry in the array?
//
//foreach($_SESSION['Cart'] as $value) {
//    if ($i++ % 4 == 0) {
//        $_SESSION['Cart'][] = $value;
//}}

foreach ($_SESSION['Cart'] as $key => $value) {
	echo "<p>{$key} => {$value}";
}

?>


<form action="deleteBasket.php">
<button input type="submit" class='btn btn-primary'>Clear basket</button><p>
</form>

<form action="purchase.php">
<button input type="submit" class='btn btn-primary'>Purchase</button><p>
</form>

</body>