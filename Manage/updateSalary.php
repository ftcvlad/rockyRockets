<?php
include "mIncludes/ensureAuthenticated.php";

if (isset($_POST["newSalary"])){    $newSalary =  $_POST["newSalary"];}else{exit("something went wrong");}
if (isset($_POST["staffId"])){$staffId =  $_POST["staffId"];}else{exit("something went wrong");}



include "../includes/db.php";


$query = "UPDATE staff SET Salary=? WHERE Id=?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii",$newSalary , $staffId);
if ($stmt===false){//wrong type
    http_response_code(404);
    return;
}

$stmt->execute();
if ($stmt===false){//database disconnected or whatever
    http_response_code(500);
    return;
}

if ($connection->affected_rows===0){//wrong index
    http_response_code(404);
    return;
}

echo $newSalary;



?>