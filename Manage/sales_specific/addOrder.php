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

if (!is_numeric ($number)){
    http_response_code(404);
    die("invalid quantity");
}

$locationId = $_SESSION['user']->locationId;
$staffId = $_SESSION['user']->staffId;

$connection->autocommit(FALSE);


//update ordereditem
$query ="INSERT INTO ordereditem (Quantity, ItemId,StaffId) Values(?,?,?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("iii",$number, $id, $staffId);
$stmt->execute();


//echo $number." ".$id." ".$staffId;


//??bugs
//update number of items at location
$query2 = "INSERT INTO location_has_differentitem (Location_id, ItemKind_Id, Quantity) VALUES(?,?,?) 
          ON DUPLICATE KEY UPDATE Location_id=Location_id, ItemKind_Id=ItemKind_Id, Quantity=Quantity+VALUES(Quantity)";

$stmt = $connection->prepare($query2);
$stmt->bind_param("iii",$locationId, $id, $number);
$stmt->execute();




//update available online
$query3 = "UPDATE differentitem 
            SET AvailableOnline = IF((SELECT LocationType FROM location WHERE location.Id=?)='Warehouse', 1, AvailableOnline)
            WHERE differentitem.Id=?";

$stmt = $connection->prepare($query3);
$stmt->bind_param("ii",$locationId, $id);
$stmt->execute();



$connection->commit();

echo $number;