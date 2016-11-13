<?php
include  "../mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Sales")!==0){
    http_response_code(401);
    echo "Only Sales manager can be here!";
    die();
}



include "../../includes/db.php";

if (isset($_POST["id"])){    $id =  $_POST["id"];}else{exit("something went wrong");}
if (isset($_POST["number"])){$number =  $_POST["number"];}else{exit("something went wrong");}





$query ="INSERT IGNORE INTO staff (FirstName, LastName,UserName,Password,DepartmentId, Position, Salary)
        Values(?,?,?,?,?,?,?)";

$stmt = $connection->prepare($query);

$stmt->bind_param("sss",$escapedPrepCriterion , $escapedPrepCriterion,$position);