<?php


include "includes/ensureNotAuthenticated.php";

include 'includes/db.php';

$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$AddressLine1 = $_POST['AddressLine1'];
$Street = $_POST['Street'];
$City = $_POST['City'];
$PostCode = $_POST['PostCode'];
$UserName = $_POST['username'];
$Password = $_POST['password'];


if (empty($FirstName) && strlen($FirstName) == 0) {die("Something went wrong!");}
if (empty($LastName) && strlen($LastName) == 0) {die("Something went wrong!");}
if (empty($AddressLine1) && strlen($AddressLine1) == 0) {die("Something went wrong!");}
if (empty($Street) && strlen($Street) == 0) {die("Something went wrong!");}
if (empty($City) && strlen($City) == 0) {die("Something went wrong!");}
if (empty($PostCode) && strlen($PostCode) == 0) {die("Something went wrong!");}
if (empty($UserName) && strlen($UserName) == 0) {die("Something went wrong!");}
if (empty($Password) && strlen($Password) == 0) {die("Something went wrong!");}


$query ="INSERT IGNORE INTO customer (FirstName, LastName,AddressLine1,Street,City, PostCode, UserName, Password)
        Values(?,?,?,?,?,?,?,?)";

$stmt = $connection->prepare($query);
$stmt ->bind_param("ssssssss",$FirstName,$LastName,$AddressLine1,$Street,$City,$PostCode,$UserName,$Password);

$stmt->execute();

$message = "";
if ($stmt===false){//database disconnected or whatever
    $message = "Database error";
}
else if ($connection->affected_rows===0){//duplicate username
    $message = "Username already exists";
}
else{
    $message = "Registered successfully";
}



header("Location: ./registerCustomer.php?result=".$message);


?>