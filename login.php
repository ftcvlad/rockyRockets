
<?php

include "includes/db.php";

if (isset($_POST["username"])){    $username =  $_POST["username"];}else{exit("something went wrong");}
if (isset($_POST['password'])){    $password =  $_POST['password'];}else{exit("something went wrong");}
if (isset($_POST['type'])){    $loginType = $_POST['type'];}else{exit("something went wrong");}



if ( strcmp($loginType,"customer")===0){

}
else if (strcmp($loginType,"manager")===0 || strcmp($loginType,"seller")===0){




    $stmt = $connection->prepare("SELECT UserName, Password, Position FROM staff WHERE (Position=? AND UserName=?)");
    $stmt->bind_param("ss", $loginType, $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if (!$res){
        //execution failed
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

            $row = $res->fetch_assoc();


            if (strcmp($row['Password'], $password)!==0){
                http_response_code(401);
                echo "Invalid password";
                return;
            }
            else{

                if (strcmp($loginType, "manager")===0){
                    $redirPage = "Manage/mindex.php";
                }
                else if (strcmp($loginType, "seller")===0){
                    $redirPage = "seller.html";
                }
                $userObject = (object) array('username' => $username, 'position' => $loginType);
                session_start();
                $_SESSION['user'] = $userObject;
                echo $redirPage;

            }


        }

    }


}
else{
    http_response_code(404);
    return;
}





mysqli_close($connection);


?>

