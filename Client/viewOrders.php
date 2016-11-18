<?php
	session_start();
    include '../includes/db.php';
	?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<!-- Including the nav.php file so the navbar functions -->
<?php
	include 'nav.php';
?>

<h3>Your Orders:</h3>

<!-- If the user is logged in, then do all this -->
<?php 
	if (isset($_SESSION['Id'])) {
		echo 'Hello ';
		echo $_SESSION['FirstName'];
		echo ' ';
		echo $_SESSION['LastName'];
		echo '. Below are your orders:';
		
		//Just showing order list.
		
		echo "Date: 2016-01-05";
		echo "Price: £5 <p>";
		echo "Name: Long Sleeve<p>";
		?>


<!-- Go back to the customer page. -->
<form action="Index.php">
<button class='btn btn-primary'>Return</button>
</form>

<!-- Otherwise, if the user isn't logged in, display a please log in message -->
<?php
	} else {
		echo "You need to log in to access this page.";
	}
?>

	
</body>
</html>