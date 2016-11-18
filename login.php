
<?php

include "includes/db.php";


if (isset($_POST["username"])){    $username =  $_POST["username"];}else{exit("something went wrong");}
if (isset($_POST['password'])){    $password =  $_POST['password'];}else{exit("something went wrong");}
if (isset($_POST['type'])){    $loginType = $_POST['type'];}else{exit("something went wrong");}



if ( strcmp($loginType,"customer")===0){//CUSTOMER

    $query = "SELECT Password, Id FROM customer WHERE (UserName=?)";

    $stmt = $connection->prepare($query);

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if (!$res){
        http_response_code(500);
        return;
    }
    else{
        if ($res->num_rows === 0){
            http_response_code(401);
            die("Invalid username");
        }
        else{

            $row = $res->fetch_assoc();
            if (strcmp($row['Password'], $password)!==0){
                http_response_code(401);
                die ("Invalid password");
            }
            else{
                $redirPage = "Client/Index.php";
                $userObject = (object) array('username' => $username, 'position' => $loginType,'customerId'=>$row['Id']);
                session_start();
                $_SESSION['user'] = $userObject;
                echo $redirPage;
            }
        }

    }
}
else if (strcmp($loginType,"manager")===0 || strcmp($loginType,"seller")===0){//STAFF

    $query = "SELECT * 
              FROM all_login
              WHERE (Position=? AND UserName=?)";


    //$stmt = $connection->prepare("SELECT UserName, Password, Position FROM staff WHERE (Position=? AND UserName=?)");
    $stmt = $connection->prepare($query);



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
                    $userObject = (object) array('username' => $username, 'position' => $loginType, 'department'=>$row['DepartmentType'],
                        'locationId'=>$row['LocationId'], 'staffId'=>$row['Id']);
                }
                else if (strcmp($loginType, "seller")===0){
                    $redirPage = "Sales/home.php";

                    $userObject = (object) array('username' => $username, 'position' => $loginType,'staffId'=>$row['Id'], 'locationId'=>$row['LocationId']);
                }

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

