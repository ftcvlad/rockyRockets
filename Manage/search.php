
<?php
    include "mIncludes/ensureAuthenticated.php";



    if (isset($_POST["criterion"])){    $criterion =  $_POST["criterion"];}else{exit("something went wrong");}
    if (isset($_POST["position"])){$position =  $_POST["position"];}else{exit("something went wrong");}



    include "../includes/db.php";
    $positionCondition = false;
    $searchCondition = false;
    //if position set

    if (strcmp($position,"manager")===0 || strcmp($position,"seller")===0){
        $positionCondition = true;
    }

    //http://stackoverflow.com/questions/8247970/using-like-wildcard-in-prepared-statement
    if (strcmp($criterion, "")!==0){
        $searchCondition = true;

        str_replace("!","!!",$criterion);
        str_replace("%","!%",$criterion);
        str_replace("_","!_",$criterion);
        str_replace("[","![",$criterion);

        $escapedPrepCriterion = "%".$criterion."%";
    }


    if ($positionCondition && $searchCondition){
        $query = "SELECT FirstName, LastName, ContactNumber, Position, Salary, DepartmentType,LocationType
                FROM staff_info
                WHERE ((FirstName LIKE ? ESCAPE '!'|| LastName LIKE ? ESCAPE '!')  AND (Position=?))";

        $stmt = $connection->prepare($query);

        $stmt->bind_param("sss",$escapedPrepCriterion , $escapedPrepCriterion,$position);
    }
    else if ($positionCondition){
        $query = "SELECT FirstName, LastName, ContactNumber, Position, Salary, DepartmentType,LocationType
                FROM staff_info
                WHERE Position=?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s",$position);
    }
    else if ($searchCondition){
        $query = "SELECT FirstName, LastName, ContactNumber, Position, Salary, DepartmentType,LocationType
                FROM staff_info
                WHERE (FirstName LIKE ? ESCAPE '!'|| LastName LIKE ? ESCAPE '!')";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss",$escapedPrepCriterion , $escapedPrepCriterion);

    }
    else{
        $query = "SELECT FirstName, LastName, ContactNumber, Position, Salary, DepartmentType,LocationType
                FROM staff_info";
        $stmt = $connection->prepare($query);
    }

    $stmt->execute();
    $res = $stmt->get_result();


    $rows = array();
    while($r = $res->fetch_assoc()) {
        $rows[] = $r;
    }
    print json_encode($rows);



?>