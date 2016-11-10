<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Sales")!==0){
    http_response_code(401);
    echo "Only Sales manager can add new Items";
    die();
}

var_dump($_POST);
var_dump($_FILES);

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

//http://www.php-mysql-tutorial.com/wikis/mysql-tutorials/uploading-files-to-mysql-database.aspx -- to db
//http://stackoverflow.com/questions/2879266/upload-file-with-php-and-save-path-to-sql -- move uploaded file
//http://www.codingcage.com/2014/12/file-upload-and-view-with-php-and-mysql.html -- to FS
if (empty($_FILES['file'])){
    $image = NULL;
}
else if ( $_FILES['file']['error'] ) {

    http_response_code(404);
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    return;
}
else {
    $image = $_FILES['file'];
}

//$_POST["formData"]

if (strcmp($category, "apparel")===0){
    $size = empty($_POST["size"])?NULL:$_POST["size"];
    $color = empty($_POST["color"])?NULL:$_POST["color"];
    $forMen = empty($_POST["forMen"])?NULL:$_POST["forMen"];//"true" converted to true autcmatically
    //echo $price." ".$description." ".$supplierId." ".$category." ".$brand." ".$itemCode." ".$size." ".$color." ".$forMen;

}
else if (strcmp($category, "racket")===0){
    $sport = empty($_POST["sport"])?NULL:$_POST["sport"];
    $balance = empty($_POST["balance"])?NULL:$_POST["balance"];
    $weight = empty($_POST["weight"])?NULL:$_POST["weight"];

    //echo $price." ".$description." ".$supplierId." ".$category." ".$brand." ".$itemCode." ".$sport." ".$balance." ".$weight;
}



include  $_SERVER['DOCUMENT_ROOT']."/includes/db.php";

//do as a single transaction -- rollback if die() before commit
$connection->autocommit(FALSE);

//INSERTING TO DIFFERENTITEM TABLE
$query ="INSERT INTO differentitem (Price, Description,SupplierId,Category,Brand,SuppliersItemCode, AvailableOnline, Image)
        Values(?,?,?,?,?,?, false,$image)";
$stmt = $connection->prepare($query);
$stmt ->bind_param("isisss",$price,$description,$supplierId,$category,$brand,$itemCode);
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
        return;
    }



}

$connection->commit();

echo "Saved successfully";

