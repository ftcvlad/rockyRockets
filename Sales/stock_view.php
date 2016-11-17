<?php
include  "./ensureSellerAuthenticated.php";




$idToCheck = $_POST["id"];
if (empty($idToCheck)){
    http_response_code(404);
    die("bad input");
}

include "../includes/db.php";



$query = "SELECT *
            FROM seller_item_location
            WHERE ItemKind_id=?";




$stmt = $connection -> prepare($query);
$stmt -> bind_param("i",$idToCheck);
$stmt -> execute();


$res = $stmt->get_result();
$rows = array();
while($r = $res->fetch_assoc()) {
    $rows[] = $r;
}
print json_encode($rows);