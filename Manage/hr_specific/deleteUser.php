<?php
include "../mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Hr")!==0){
    http_response_code(401);
    echo "Only HR manager can edit staff";
    die();
}

if (isset($_POST["staffId"])){$staffId =  $_POST["staffId"];}else{
    http_response_code(404);
    exit("something went wrongs");
}

if ($staffId==($_SESSION['user']->staffId)){
    http_response_code(404);
    exit("You cannot delete yourself");
}


include "../../includes/db.php";


$stmt = $connection->prepare("CALL  deleteStaffProcedure(?)");
$stmt->bind_param("i",$staffId);
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
    echo "No rows were deleted";
    return;
}

echo "Deleted successfully";

?>