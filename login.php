
<?php

include "db.php";

if (isset($_POST["username"])){    $username =  $_POST["username"];}else{exit("something went wrong");}
if (isset($_POST['password'])){    $password =  $_POST['password'];}else{exit("something went wrong");}
if (isset($_POST['type'])){    $loginType = $_POST['type'];}else{exit("something went wrong");}

//$res  = mysqli_query($connection, "SELECT * FROM staff");
//if (!$res){
//    exit("Selection failed");
//}

//$res->data_seek(0);
//while ($row = $res->fetch_assoc()) {
//    echo $row['FirstName'] . "  ".$row['UserName'] ."\n";
//}

if ( strcmp($loginType,"customer")===0){
    //not my business :)
}
else if (strcmp($loginType,"manager")===0 || strcmp($loginType,"seller")===0){




    $stmt = $connection->prepare("SELECT UserName, Password FROM staff WHERE Position=? AND UserName=?");
    $stmt->bind_param("ss", $loginType, $username);
    $res = $stmt->get_result();

    if (!$res){
        //execution failed
        echo $connection -> error;
        http_response_code(500);
        return;
    }
    else{
        if ($res->num_rows === 0){
            //username does not exist
            http_response_code(401);
            echo "Invalid username";
            return;
        }
        else{
            //check password (not in sql as can store encrypted)
        }
//http://stackoverflow.com/questions/614671/commands-out-of-sync-you-cant-run-this-command-now
        //http://stackoverflow.com/questions/11492285/the-correct-way-to-include-connection-using-mysqli
    }


}



//asdf


mysqli_close($connection);


?>

