<?php
include  "./ensureSellerAuthenticated.php";




$category = $_POST["category"];
if (strcmp($category,"general")!==0 && strcmp($category, "racket")!==0 && strcmp($category, "apparel")!==0){
    http_response_code(404);
    echo "bad input";
    return;
}

include "../includes/db.php";

$description =  $_POST["description"];
$brand = $_POST["brand"];



$staffId = $_SESSION['user']->staffId;
$locationId = $_SESSION['user']->locationId;

if (strcmp($category,"general")===0){//GENERAL

    $whereStr = "";

    $hasDescription = !empty($description);
    $hasBrand = !empty($brand);

    if (!$hasDescription){

        if (!$hasBrand){


            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM seller_item_location Where Location_Id=?) as a
                       Right JOIN
                            (SELECT * FROM seller_general ) as b
                       ON a.ItemKind_id = b.Id";


            $stmt = $connection->prepare($query);
            $stmt->bind_param("i",$locationId);

        }
        else{

            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM seller_item_location Where Location_Id=?) as a
                       Right JOIN
                            (SELECT * FROM seller_general WHERE Brand=?) as b
                       ON a.ItemKind_id = b.Id";


            $stmt = $connection->prepare($query);

            $stmt->bind_param("is",$locationId,$brand);
        }

    }
    else{//has description

        str_replace("!","!!",$description);
        str_replace("%","!%",$description);
        str_replace("_","!_",$description);
        str_replace("[","![",$description);

        $escapedDescription = "%".$description."%";

        if (!$hasBrand){
            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM seller_item_location Where Location_Id=?) as a
                       Right JOIN
                            (SELECT * FROM seller_general WHERE Description LIKE ? ESCAPE '!') as b
                       ON a.ItemKind_id = b.Id";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ss",$locationId,$escapedDescription );
        }
        else{
            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM seller_item_location Where Location_Id=?) as a
                       Right JOIN
                            (SELECT * FROM seller_general WHERE Brand=? AND Description LIKE ? ESCAPE '!') as b
                       ON a.ItemKind_id = b.Id";

            $stmt = $connection->prepare($query);
            $stmt->bind_param("sss",$locationId, $brand, $escapedDescription);
        }
    }
    $stmt->execute();
    $res = $stmt->get_result();


    $rows = array();
    while($r = $res->fetch_assoc()) {
        $rows[] = $r;
    }
    print json_encode($rows);


}
else {//APPAREL OR RACKET

    $viewName="";
    $extraSearchCriterionValue="";
    $extraSearchCriterion="";
    $col1 = "";
    $col2 = "";
    $col3 = "";
    if (strcmp($category,"apparel")===0){
        $viewName = "seller_apparel";
        $extraSearchCriterionValue = $_POST["color"];
        $extraSearchCriterion ="Color";
        $col1 ="Size";
        $col2 = "Color";
        $col3 = "ForMen";

    }
    else {
        $viewName = "seller_racket";
        $extraSearchCriterionValue = $_POST["sport"];
        $extraSearchCriterion="Sport";
        $col1 ="Sport";
        $col2 = "Balance";
        $col3 = "Weight";

    }


    $whereStr="";

    $count = 0;
    $criteriaValues = array();
    if (!empty($brand)){
        $whereStr.=" Brand=?";
        $count++;
        $criteriaValues[] = $brand;
    }

    if (!empty($description)){

        if ($count>0){
            $whereStr.= " AND ";
        }
        $whereStr.= " Description LIKE ? ESCAPE '!'";
        $count++;

        str_replace("!","!!",$description);
        str_replace("%","!%",$description);
        str_replace("_","!_",$description);
        str_replace("[","![",$description);

        $escapedDescription = "%".$description."%";


        $criteriaValues[] = $escapedDescription;

    }

    if (!empty($extraSearchCriterionValue)){

        if ($count>0){
            $whereStr.= " AND ";
        }
        $whereStr.= ($extraSearchCriterion."=?");
        $count++;
        $criteriaValues[] = $extraSearchCriterionValue;
    }


    if ($count>0){
        $whereStr= "WHERE ".$whereStr;
    }

    $query = " SELECT itemId,Price,Brand,Description,ImagePath, Quantity, ".$col1.", ".$col2.", ".$col3."
                       FROM (SELECT Quantity, ItemKind_Id FROM seller_item_location Where Location_Id=?) AS a
                       Right JOIN
                            (SELECT itemId,Price,Brand,Description,ImagePath, ".$col1.", ".$col2.", ".$col3."
                                FROM ".$viewName." ".$whereStr." ) as b
                       ON a.ItemKind_id = b.itemId";





     //echo $query;

    $stmt = $connection->prepare($query);


    if ($count===0){
        $stmt->bind_param("i",$locationId);
    }
    else if ($count===1){
        $stmt->bind_param("is",$locationId, $criteriaValues[0]);
    }
    else if ($count===2){
        $stmt->bind_param("iss",$locationId, $criteriaValues[0], $criteriaValues[1]);
    }
    else if ($count===3){
        $stmt->bind_param("isss",$locationId, $criteriaValues[0], $criteriaValues[1],$criteriaValues[2]);
    }


    $stmt->execute();
    $res = $stmt->get_result();


    $rows = array();
    while($r = $res->fetch_assoc()) {
        $rows[] = $r;
    }
    print json_encode($rows);




}



