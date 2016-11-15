<?php
include "../mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Hr")!==0){
    http_response_code(401);
    echo "Only HR manager can edit staff";
    die();
}

if (isset($_POST["newSalary"])){    $newSalary =  $_POST["newSalary"];}else{exit("something went wrong");}
if (isset($_POST["staffId"])){$staffId =  $_POST["staffId"];}else{exit("something went wrong");}



include "../../includes/db.php";


$query = "UPDATE man_hr_staff_info SET Salary=? WHERE Id=?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ii",$newSalary , $staffId);
if ($stmt===false){//wrong type (if user modified js)
    http_response_code(404);
    echo "wrong type";
    return;
}

$stmt->execute();
if ($stmt===false){//database disconnected or whatever
    http_response_code(500);
    return;
}

if ($connection->affected_rows===0){//wrong index (if same value as before or user modified js)
    http_response_code(404);
    echo "No rows were updated";
    return;
}

echo $newSalary;



?>