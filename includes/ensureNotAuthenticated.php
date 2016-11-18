<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//
//echo isset($_SESSION['user']);
//session_start();
//debug_to_console(isset($_SESSION['user']));
//
//error_log("dfghj",0);
//function debug_to_console( $data ) {
//
//    $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
//    echo $output;
//}

    session_start();
    if (isset($_SESSION['user'])){


        $userType = $_SESSION['user']->position;
        if (strcmp($userType, "manager")===0){
            header('Location: Manage/mindex.php', true, 302);
            exit();

        }
        else if (strcmp($userType, "seller")===0){
            header('Location: /2016-ac32006/team13/rockyRockets/Sales/home.php', true, 302);
            exit();

        }
        else if (strcmp($userType, "customer")===0){
            header('Location: /2016-ac32006/team13/rockyRockets/Client/Index.php', true, 302);
            exit();
        }



    }
    else{
        //not logged in
    }


?>