<?php
include  $_SERVER['DOCUMENT_ROOT']."/Manage/mIncludes/ensureAuthenticated.php";

if (strcmp($_SESSION['user']->department, "Hr")!==0){
    http_response_code(401);
    echo "Only HR manager can add staff";
    die();
}



if (isset($_POST["username"])){    $username =  $_POST["username"];}else{exit("something went wrong1");}
if (isset($_POST["password"])){$password =  $_POST["password"];}else{exit("something went wrong2");}
if (isset($_POST["name"])){    $name=  $_POST["name"];}else{exit("something went wrong3");}
if (isset($_POST["surname"])){    $surname =  $_POST["surname"];}else{exit("something went wrong4");}
if (isset($_POST["salary"])){$salary =  $_POST["salary"];}else{exit("something went wrong5");}
if (isset($_POST["position"])){    $position =  $_POST["position"];}else{exit("something went wrong6");}
if (isset($_POST["depId"])){    $depId =  $_POST["depId"];}else{exit("something went wrong7");}


if (strcmp($position,"seller")!==0 && strcmp($position, "manager")!==0){
    http_response_code(404);
    echo "bad input";
    return;
}

include  $_SERVER['DOCUMENT_ROOT']."/includes/db.php";

$query ="INSERT IGNORE INTO staff (FirstName, LastName,UserName,Password,DepartmentId, Position, Salary)
        Values(?,?,?,?,?,?,?)";

$stmt = $connection->prepare($query);
$stmt ->bind_param("ssssisi",$name,$surname,$username,$password,$depId,$position,$salary);
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
if ($connection->affected_rows===0){//duplicate username
    http_response_code(404);
    echo "Username already exists";
    return;
}
else{
    echo "Added successfully";
}


