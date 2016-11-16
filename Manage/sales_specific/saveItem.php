<?php
include  "../mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Sales")!==0){
    http_response_code(401);
    echo "Only Sales manager can add new Items";
    die();
}



if (!empty($_POST["price"])){    $price =  $_POST["price"];}else{exit("bad input1");}
if (!empty($_POST["description"])){$description =  $_POST["description"];}else{exit("bad input2");}
if (!empty($_POST["supplierId"])){    $supplierId=  $_POST["supplierId"];}else{exit("bad input3");}
if (!empty($_POST["category"])){    $category =  $_POST["category"];}else{exit("bad input4");}
if (strcmp($category,"general")!==0 && strcmp($category, "racket")!==0 && strcmp($category, "apparel")!==0){
    http_response_code(404);
    echo "bad input";
    return;
}



$brand = empty($_POST["brand"])?NULL:$_POST["brand"];
$itemCode = empty($_POST["itemCode"])?NULL:$_POST["itemCode"];

if (strcmp($category, "apparel")===0){
    $size = empty($_POST["size"])?NULL:$_POST["size"];
    $color = empty($_POST["color"])?NULL:$_POST["color"];
    $forMen = empty($_POST["forMen"])?NULL:$_POST["forMen"];//"true" converted to true autcmatically
    if (strcmp($_POST["forMen"],"0")===0){
        $forMen=0;
    }
    //echo $price." ".$description." ".$supplierId." ".$category." ".$brand." ".$itemCode." ".$size." ".$color." ".$forMen;

}
else if (strcmp($category, "racket")===0){
    $sport = empty($_POST["sport"])?NULL:$_POST["sport"];
    $balance = empty($_POST["balance"])?NULL:$_POST["balance"];
    $weight = empty($_POST["weight"])?NULL:$_POST["weight"];

    //echo $price." ".$description." ".$supplierId." ".$category." ".$brand." ".$itemCode." ".$sport." ".$balance." ".$weight;
}

//STORE FILE ON FS AND REFERENCE IN DB
$filename = NULL;
if (empty($_FILES['file'])){
    //do nothing :)
}
else if ( $_FILES['file']['error'] ) {

    http_response_code(404);
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    return;
}
else {

    $target_dir = "../../ItemPictures/";

    //check if file is an image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check === false) {
        http_response_code(404);
        echo "File is not an image ";
        die();
    }

    // Allow certain file formats
    $extension = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);

    if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
        http_response_code(404);
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        die();
    }

    //create filename

    while (true) {
        $filename = uniqid(rand(), true) . ".".$extension;
        if (!file_exists($target_dir . $filename)) break;
    }

   //save file after saved to db successfully.

}


include  "../../includes/db.php";

//do as a single transaction -- rollback if die() before commit
$connection->autocommit(FALSE);

//INSERTING TO DIFFERENTITEM TABLE
$query ="INSERT INTO differentitem (Price, Description,SupplierId,Category,Brand,SuppliersItemCode, AvailableOnline, ImagePath)
        Values(?,?,?,?,?,?, 0, ?)";
$stmt = $connection->prepare($query);




$stmt ->bind_param("isissss",$price,$description,$supplierId,$category,$brand,$itemCode, $filename);
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

//INSERTING TO SPECIFIC ATTRIBUTE TABLES
if (strcmp($category,"general")!==0){


    $diffItemId =  $connection->insert_id;

    if (strcmp($category,"racket")===0){
        $query ="INSERT INTO racketattribute (Id, Sport,Balance,Weight) Values($diffItemId,?,?,?)";
        $stmt = $connection->prepare($query);
        $stmt ->bind_param("sss",$sport,$balance,$weight);

    }
    else if(strcmp($category,"apparel")===0){
        $query ="INSERT INTO apparelattribute (Id, Size,Color,ForMen) Values($diffItemId,?,?,?)";
        $stmt = $connection->prepare($query);
        $stmt ->bind_param("ssi",$size,$color,$forMen);
    }


    if ($stmt===false){//wrong type (if user modified js)
        http_response_code(404);
        echo "wrong type";
        return;
    }
    $stmt->execute();
    if ($stmt===false){//database disconnected or whatever
        http_response_code(500);
        echo "Database error while executing query";
        return;
    }



}

//file save before commit. If fileSave fails, queries are reverted
if ($filename!==NULL){

    if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$filename)) {
        http_response_code(500);
        echo "Error while uploading file";
        die();
    }
}


$connection->commit();




echo "Saved successfully";

