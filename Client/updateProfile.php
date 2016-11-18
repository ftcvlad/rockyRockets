<?php
include  "./ensureCustomerAuthenticated.php";
include '../includes/db.php';


if (isset ($_POST["FirstName"])){   $FirstName = $_POST["FirstName"];}else{exit("something went wrong");}
if (isset ($_POST["LastName"])){   $LastName = $_POST["LastName"];}else{exit("something went wrong");}
if (isset ($_POST["AddressLine1"])){   $AddressLine1 = $_POST["AddressLine1"];}else{exit("something went wrong");}
if (isset ($_POST["Street"])){   $Street = $_POST["Street"];}else{exit("something went wrong");}
if (isset ($_POST["City"])){   $City = $_POST["City"];}else{exit("something went wrong");}
if (isset ($_POST["PostCode"])){   $PostCode = $_POST["PostCode"];}else{exit("something went wrong");}
if (isset ($_POST["Username"])){   $Username = $_POST["Username"];}else{exit("something went wrong");}
if (isset ($_POST["Password"])){   $Password = $_POST["Password"];}else{exit("something went wrong");}

$customerId = $_SESSION['user']->customerId;


$query ="UPDATE customer SET FirstName = ?,
                            LastName = ?,
                            AddressLine1 = ?,
                            Street = ?,
                            City = ?,
                            PostCode = ?,
                            UserName = ?,
                            Password = ?
          WHERE Id =".$customerId;


$stmt = $connection->prepare($query);
$stmt->bind_param("ssssssss",$FirstName, $LastName, $AddressLine1, $Street,$City, $PostCode ,$Username, $Password);


$stmt->execute();

$message = "";
if ($stmt===false){//database disconnected or whatever
    $message = "database error";
}
else{
    $message = "Updated successfully";
    $_SESSION['user']->username = $Username;
    header("Location: ./editProfile.php?result=".$message);
}



?>



