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

if (strcmp($category,"general")===0){//GENERAL

    $whereStr = "";

    $hasDescription = !empty($description);
    $hasBrand = !empty($brand);

    if (!$hasDescription){

        if (!$hasBrand){
            //where executed first ! so, 1) gets all with 'general' 2) gets all with location 3) right joins
//            $query = "SELECT Id,Price,Brand,Description,ImagePath, Quantity FROM DifferentItem
//                    LEFT JOIN Location_has_DifferentItem  ON Location_has_DifferentItem.ItemKind_Id = DifferentItem.Id
//                    WHERE Category='general' AND Location_Id=?";

            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM Location_has_DifferentItem Where Location_Id=(SELECT locationId from staff_department where staff_department.Id= (SELECT DepartmentId FROM staff WHERE staff.Id=?))) as a
                       Right JOIN
                            (SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' ) as b
                       ON a.ItemKind_id = b.Id";


            $stmt = $connection->prepare($query);
            $stmt->bind_param("i",$staffId);

        }
        else{

            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM Location_has_DifferentItem Where Location_Id=(SELECT locationId from staff_department where staff_department.Id= (SELECT DepartmentId FROM staff WHERE staff.Id=?))) as a
                       Right JOIN
                            (SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' AND Brand=?) as b
                       ON a.ItemKind_id = b.Id";


            $stmt = $connection->prepare($query);

            $stmt->bind_param("is",$staffId,$brand);
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
                       FROM (SELECT Quantity, ItemKind_Id FROM Location_has_DifferentItem Where Location_Id=(SELECT locationId from staff_department where staff_department.Id= (SELECT DepartmentId FROM staff WHERE staff.Id=?))) as a
                       Right JOIN
                            (SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' AND Description LIKE ? ESCAPE '!') as b
                       ON a.ItemKind_id = b.Id";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ss",$staffId,$escapedDescription );
        }
        else{
            $query = " SELECT Id as itemId,Price,Brand,Description,ImagePath, Quantity
                       FROM (SELECT Quantity, ItemKind_Id FROM Location_has_DifferentItem Where Location_Id=(SELECT locationId from staff_department where staff_department.Id= (SELECT DepartmentId FROM staff WHERE staff.Id=?))) as a
                       Right JOIN
                            (SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' AND Brand=? AND Description LIKE ? ESCAPE '!') as b
                       ON a.ItemKind_id = b.Id";

            $stmt = $connection->prepare($query);
            $stmt->bind_param("sss",$staffId, $brand, $escapedDescription);
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

    $attributeTableName="";
    $extraSearchCriterionValue="";
    $extraSearchCriterion="";
    $col1 = "";
    $col2 = "";
    $col3 = "";
    if (strcmp($category,"apparel")===0){
        $attributeTableName = "apparelattribute";
        $extraSearchCriterionValue = $_POST["color"];
        $extraSearchCriterion ="Color";
        $col1 ="Size";
        $col2 = "Color";
        $col3 = "ForMen";

    }
    else {
        $attributeTableName = "racketattribute";
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
                       FROM (SELECT Quantity, ItemKind_Id FROM Location_has_DifferentItem Where Location_Id=(SELECT locationId from staff_department where staff_department.Id= (SELECT DepartmentId FROM staff WHERE staff.Id=?))) AS a
                       Right JOIN
                            (SELECT DifferentItem.Id as itemId,Price,Brand,Description,ImagePath, ".$col1.", ".$col2.", ".$col3."
                                FROM DifferentItem 
                                INNER JOIN ".$attributeTableName." 
                                ON DifferentItem.Id=".$attributeTableName.".Id
                                ".$whereStr." ) as b
                       ON a.ItemKind_id = b.itemId";





    // echo $query;

    $stmt = $connection->prepare($query);


    if ($count===0){
        $stmt->bind_param("i",$staffId);
    }
    else if ($count===1){
        $stmt->bind_param("is",$staffId, $criteriaValues[0]);
    }
    else if ($count===2){
        $stmt->bind_param("iss",$staffId, $criteriaValues[0], $criteriaValues[1]);
    }
    else if ($count===3){
        $stmt->bind_param("isss",$staffId, $criteriaValues[0], $criteriaValues[1],$criteriaValues[2]);
    }


    $stmt->execute();
    $res = $stmt->get_result();


    $rows = array();
    while($r = $res->fetch_assoc()) {
        $rows[] = $r;
    }
    print json_encode($rows);




}



