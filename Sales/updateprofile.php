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



$stmt = $connection->prepare("CALL  updateProfileStaffProcedure(?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssi",$FirstName, $LastName, $ContactNumber, $Email,$username, $password ,$staffId);
if ($stmt===false){//wrong type (if user modified js)
    http_response_code(404);
    echo "wrong type";
    return;
}
$stmt->execute();


if ($stmt===false){//database disconnected or whatever
    http_response_code(500);
    die("Database error");
}


$_SESSION['user']->username = $username;
header("Location: ./editprofile.php?result="."Updated successfully");




?>


