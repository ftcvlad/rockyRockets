
<?php
    include  "mIncludes/ensureAuthenticated.php";



    if (isset($_POST["criterion"])){    $criterion =  $_POST["criterion"];}else{exit("something went wrong");}
    if (isset($_POST["position"])){$position =  $_POST["position"];}else{exit("something went wrong");}
    if (isset($_POST["position"])){$order =  $_POST["order"];}else{exit("something went wrong");}


    include  "../includes/db.php";
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


    $userDepartment = $_SESSION['user']->department;


    if ($positionCondition && $searchCondition){

        if (strcmp($userDepartment,"Hr")===0){
            $query = "SELECT Id,FirstName,date(DOB) as Date, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position , Salary ,LocationType
                FROM man_hr_staff_info
                WHERE ((FirstName LIKE ? ESCAPE '!'|| LastName LIKE ? ESCAPE '!')  AND (Position=?))
                 ORDER BY ".$order." ASC";
        }
        else if (strcmp($userDepartment,"Sales")===0){
            $query = "SELECT FirstName, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position,DepartmentPhoneNumber ,LocationType
                FROM man_sales_staff_info
                WHERE ((FirstName LIKE ? ESCAPE '!'|| LastName LIKE ? ESCAPE '!')  AND (Position=?))
                ORDER BY ".$order." ASC";
        }

        $stmt = $connection->prepare($query);

        $stmt->bind_param("sss",$escapedPrepCriterion , $escapedPrepCriterion,$position);
    }
    else if ($positionCondition){

        if (strcmp($userDepartment,"Hr")===0){
            $query = "SELECT Id,FirstName,date(DOB) as Date, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position , Salary ,LocationType
                FROM man_hr_staff_info
                WHERE Position=?
                ORDER BY ".$order." ASC";
        }
        else if (strcmp($userDepartment,"Sales")===0){
            $query = "SELECT FirstName, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position,DepartmentPhoneNumber ,LocationType
                FROM man_sales_staff_info
                WHERE Position=?
                ORDER BY ".$order." ASC";
        }

        $stmt = $connection->prepare($query);
        $stmt->bind_param("s",$position);
    }
    else if ($searchCondition){

        if (strcmp($userDepartment,"Hr")===0){
            $query = "SELECT Id,FirstName,date(DOB) as Date, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position , Salary ,LocationType
                FROM man_hr_staff_info
                WHERE (FirstName LIKE ? ESCAPE '!'|| LastName LIKE ? ESCAPE '!')
                ORDER BY ".$order." ASC";
        }
        else if (strcmp($userDepartment,"Sales")===0){
            $query = "SELECT FirstName, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position,DepartmentPhoneNumber ,LocationType
                FROM man_sales_staff_info
                WHERE (FirstName LIKE ? ESCAPE '!'|| LastName LIKE ? ESCAPE '!')
               ORDER BY ".$order." ASC";
        }


        $stmt = $connection->prepare($query);
        $stmt->bind_param("ss",$escapedPrepCriterion , $escapedPrepCriterion);

    }
    else{
        if (strcmp($userDepartment,"Hr")===0){
            $query = "SELECT Id,FirstName,date(DOB) as Date, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position , Salary ,LocationType
                FROM man_hr_staff_info
                ORDER BY ".$order." ASC";
        }
        else if (strcmp($userDepartment,"Sales")===0){
            $query = "SELECT FirstName, LastName, ContactNumber, CONCAT_WS('-', position, DepartmentType) AS Position,DepartmentPhoneNumber ,LocationType
                FROM man_sales_staff_info
                ORDER BY ".$order." ASC";
        }


        $stmt = $connection->prepare($query);

    }

    //bad error reporting upstairs :(

    $stmt->execute();
    $res = $stmt->get_result();


    $rows = array();
    while($r = $res->fetch_assoc()) {
        $rows[] = $r;
    }
   // print json_encode($rows);


$response = array('rowsArray' => $rows, 'managerDep' => $_SESSION['user']-> department );
print json_encode($response);



?>