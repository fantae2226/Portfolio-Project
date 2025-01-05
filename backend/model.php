<?php
/**
 * 
 * Summary: This model controls the flow of CRUD functionality, connecting the database to the controller using standard MVC architecture.
 * 
 * @author: Ebenezer Fanta
 * @version: 1.0.0
 * 
 * 
 * 
 * */ 

// all methods will use a base query method


// then methods will be seperated into CRUD

//methods will then call on CRUD to implement specific functionality


/**
 * Dynamically generates a Create query and executes the query into the database
 * 
 * @param string $table : The table in which the data will be inserted into
 * @param string $fields : The fields in which the values provided to the function will be inserted into
 * @param array $params : The values that will be inserted into the query. Must be listed in the same order as the $fields as well as contain the same amount of items
 * 
 * @return array|false returns an associative array with data if succesful, otherwise returns false 
 * 
 */
function Create($table, $fields, $params){
    global $dh;
    include_once "connect.php";
    $tempArr = array_fill(0, count($params), '?');
    $bindedParams = implode(",", $tempArr);
    $insertQuery = "INSERT into $table ($fields) VALUES ($bindedParams)";


    $stmt = $dh->prepare($insertQuery);

    $success = $stmt->execute($params);

    if($success){

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return false;
    }

}



/**
 * Dynamically generates a Read query and executes the query into the database
 * 
 * @param string $table : The table in which the data will be inserted into
 * @param string $columns :  The columns from which the read query will extract data from
 * @param string|null $fields(optional) : The fields in which the values provided to the function will be read from
 * @param array|null $params(optional) : The values that will be inserted into the query. Must be listed in the same order as the $fields as well as contain the same amount of items
 * 
 * @return array|false returns an associative array with data if succesful, otherwise returns false 
 * 
 */
function Read($table, $columns, $fields = null, $params = null){
    //select all functionality needs to be figured out later
    global $dh;
    include_once "connect.php";
    // $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $selectedQuery = "SELECT $columns FROM $table";

    if($params != null && $fields != null){

        $selectedQuery .= " WHERE ";

        $fieldsArr = explode(",", $fields);
    
        for($i = 0; $i < count($params); $i++){
            $selectedQuery .= "$fieldsArr[$i] = ?";
    
            $check = $i + 1;
            if($check !=  count($params)){
                $selectedQuery .= " AND ";
            }
        }
    }




    $stmt = $dh->prepare($selectedQuery);

    $success = $stmt->execute($params);

    if($success){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        
        return [
            "query" => $selectedQuery,
            "error" => $stmt->errorInfo(),
            "params" => $params
        ];
    }


}

/**
 * Dynamically generates an Update query and executes the query into the database
 * 
 * @param string $table : The table in which the data will be inserted into
 * @param string $columns :  The columns from which the read query will extract data from
 * @param array $columnParams : contains the paramaters for the column values to update by
 * @param string|null $fields(optional) : The fields in which the values provided to the function will target for update
 * @param array|null $fieldParams(optional) : The values that will be inserted into the query to specify a record to be updated. Must be listed in the same order as the $fields as well as contain the same amount of items
 * 
 * @return array|false returns an associative array with data if succesful, otherwise returns false 
 * 
 */
function Update($table, $columns, $columnParams, $fields = null, $fieldParams = null){
    global $dh;
    include_once "connect.php";
    // $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $updatedQuery = "UPDATE $table SET ";



    $columnArr = explode(",", $columns);

    for($i = 0; $i < count($columnParams); $i++){
        $updatedQuery .= "$columnArr[$i] = ?";

        $check = $i + 1;
        if($check !=  count($columnParams)){
            $updatedQuery .= ",";
        }
    }

    $params = $columnParams;

    if($fields != null && $fieldParams != null){

        $updatedQuery .= " WHERE ";

        $fieldsArr = explode(",", $fields);
    
        for($i = 0; $i < count($fieldParams); $i++){
            $updatedQuery .= "$fieldsArr[$i] = ?";
    
            $check = $i + 1;
            if($check !=  count($fieldParams)){
                $updatedQuery .= " AND ";
            }
        }

        $params = array_merge($columnParams, $fieldParams);
    }

    // echo $updatedQuery;
    // echo "<br>";



    $stmt = $dh->prepare($updatedQuery);

    $success = $stmt->execute($params);

    if($success){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return false;
    }
}

function Delete($table, $fields, $params){
    global $dh;
    include_once "connect.php";
    $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $deletedQuery = "DELETE FROM $table WHERE ";

    $fieldsArr = explode(",", $fields);

    for($i = 0; $i < count($params); $i++){
        $deletedQuery .= "$fieldsArr[$i] = ?";

        $check = $i + 1;
        if($check !=  count($params)){
            $deletedQuery .= " AND ";
        }
    }



    // $paramatersArray = array_merge($table, $fields, $params);

    // echo $deletedQuery;
    // echo "<br>";


    $stmt = $dh->prepare($deletedQuery);

    $success = $stmt->execute($params);

    if($success){
        echo "Success";
    }
    else{
        echo "Not Success";
    }
}


//




?>
