<?php
include  "./ensureSellerAuthenticated.php";
include '../includes/db.php';





$staffId = $_SESSION['user'] -> staffId;

$FirstName =  $_POST["FirstName"];
$LastName =  $_POST["LastName"];
$ContactNumber = $_POST["ContactNumber"];
$Email = $_POST["Email"];


if (isset ($_POST["username"])){   $username = $_POST["username"];}else{exit("something went wrong");}
if (isset ($_POST["password"])){   $password = $_POST["password"];}else{exit("something went wrong");}





$query ="UPDATE staff SET FirstName = ?, LastName=?, ContactNumber=?, Email=?, UserName=?, Password=? WHERE Id=?";

$stmt = $connection->prepare($query);


$stmt ->bind_param("ssssssi", $FirstName,$LastName,$ContactNumber,$Email,$username, $password,$staffId);
$stmt ->execute();

if (!$stmt){
    die("Database error");
}


$_SESSION['user']->username = $username;
header("Location: ./editprofile.php?result="."Updated successfully");




?>


