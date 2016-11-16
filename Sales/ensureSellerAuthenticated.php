<?php
session_start();
if (!isset($_SESSION['user']) || strcmp($_SESSION['user']->position, "seller")!==0 ){

    header("Location: /loginPage.php");
    die();
}

?>