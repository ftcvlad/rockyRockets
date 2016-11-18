<?php 
	session_start();
include '../includes/db.php';

$UserName = $_POST['UserName'];
$Password = $_POST['Password'];
$Id = $_POST['Id'];

$sql = "SELECT * FROM customer WHERE UserName = '$UserName' AND Password = '$Password'";
$result = mysqli_query($connection, $sql);

//If the username and password didn't match.
if (!$row = mysqli_fetch_assoc($result)) {
	echo "Your details were not correct! </br>";
	echo "Please go back and try again.";
}
	else 
	{
		$_SESSION['Id'] =  $row['Id'];
		$_SESSION['FirstName'] =  $row['FirstName'];
		$_SESSION['LastName'] =  $row['LastName'];
		$_SESSION['UserName'] =  $row['UserName'];
		$_SESSION['AddressLine1'] = $row['AddressLine1'];
		$_SESSION['Street'] =  $row['Street'];
		$_SESSION['City'] =  $row['City'];
		$_SESSION['PostCode'] =  $row['PostCode'];
		header("Location: Index.php");
	}
?>