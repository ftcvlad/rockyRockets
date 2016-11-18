<?php 

session_start();
include '../includes/db.php';

$basketID = $_POST['basketID'];
$basketName = $_POST['basketName'];
$ImagePath = $_POST['ImagePath'];
$Description = $_POST['Description'];
$basketID = $_SESSION['Id'];

//Updating, preparing and binding the editProfile entries into the variables below.
$query ="UPDATE stock where equal to quantity wehre id = id SET FirstName = ?,
LastName = ?,
AddressLine1 = ?,
Street = ?,
City = ?,
PostCode = ?,
UserName = ?,
Password = ?
WHERE Id = '$Id'";

$stmt = $connection->prepare($query);
$stmt ->bind_param("ssssssss", $FirstName, $LastName, $AddressLine1, $Street, $City, $UserName, $PostCode, $Password);

//This updates the session variables so the changes are immediately viewable to the user on other pages.
$_SESSION['FirstName'] = $FirstName;
$_SESSION['LastName'] = $LastName;
$_SESSION['AddressLine1'] = $AddressLine1;
$_SESSION['Street'] = $Street;
$_SESSION['City'] = $City;
$_SESSION['PostCode'] = $PostCode;
$_SESSION['UserName'] = $UserName;
$_SESSION['Password'] = $Password;
$stmt->execute();

header("Location: index.php");

?>