<?php


//$connection = mysqli_connect('silva.computing.dundee.ac.uk', '16ac3u13', 'cab231', '16ac3d13');
$connection = mysqli_connect('127.0.0.1', 'root', 'malolg', 'rocky_rockets');

if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
    exit();
}




//mysqli_close($connection);
?>