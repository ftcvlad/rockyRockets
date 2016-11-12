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


$description =  $_POST["description"];
$brand = $_POST["brand"];
$to = $_POST["toPrice"];
$from = $_POST["fromPrice"];



if (strcmp($category,"general")===0){

}



