<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Sales")!==0){
    http_response_code(401);
    echo "Only Sales manager can be here!";
    die();
}


$category = $_POST["category"];
if (strcmp($category,"general")!==0 && strcmp($category, "racket")!==0 && strcmp($category, "apparel")!==0){
    http_response_code(404);
    echo "bad input";
    return;
}

include  $_SERVER['DOCUMENT_ROOT']."/includes/db.php";

$description =  $_POST["description"];
$brand = $_POST["brand"];

//$to = $_POST["color"];




if (strcmp($category,"general")===0){//GENERAL

    $whereStr = "";

    $hasDescription = !empty($description);
    $hasBrand = !empty($brand);

    if (!$hasDescription){

        if (!$hasBrand){
            $query = "SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' ";
            $stmt = $connection->prepare($query);
        }
        else{
            $query = "SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' AND Brand='?' ";
            $stmt = $connection->prepare($query);

            $stmt->bind_param("s",$brand);
        }

    }
    else{//has description

        str_replace("!","!!",$description);
        str_replace("%","!%",$description);
        str_replace("_","!_",$description);
        str_replace("[","![",$description);

        $escapedDescription = "%".$description."%";


        if (!$hasBrand){
            $query = "SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general' AND Description LIKE ? ESCAPE '!'";
            $stmt = $connection->prepare($query);

            $stmt->bind_param("s",$escapedDescription);
        }
        else{
            $query = "SELECT Id,Price,Brand,Description,ImagePath FROM differentitem WHERE Category='general'".
                                              " AND Brand=? AND Description LIKE ? ESCAPE '!' ";
            $stmt = $connection->prepare($query);

            $stmt->bind_param("ss",$brand, $escapedDescription);



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

}



