<?php


// all methods will use a base query method


// then methods will be seperated into CRUD

//methods will then call on CRUD to implement specific functionality


function Create($table, $fields, $params){
    global $dh;
    include_once "connect.php";
    $tempArr = array_fill(0, count($params), '?');
    $bindedParams = implode(",", $tempArr);
    $insertQuery = "INSERT into $table ($fields) VALUES ($bindedParams)";


    // $paramatersArray = array_merge($table, $fields, $params);

    echo $insertQuery;
    echo "<br>";


    $stmt = $dh->prepare($insertQuery);

    $success = $stmt->execute($params);

    if($success){
        echo "Success";
    }
    else{
        echo "Not Success";
    }

}



/**
 * Need to test functionality on this
 */
function Read($table, $columns, $fields, $params){
    //select all functionality needs to be figured out later
    global $dh;
    include_once "connect.php";
    // $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $selectedQuery = "SELECT $columns FROM $table WHERE ";

    $fieldsArr = explode(",", $fields);

    for($i = 0; $i < count($params); $i++){
        $selectedQuery .= "$fieldsArr[$i] = ?";

        $check = $i + 1;
        if($check !=  count($params)){
            $selectedQuery .= " AND ";
        }
    }

    echo $selectedQuery;
    echo "<br>";


    $stmt = $dh->prepare($selectedQuery);

    $success = $stmt->execute($params);

    if($success){
        echo "Success";
    }
    else{
        echo "Not Success";
    }


}


/**
 * Need to test functionality on this
 */
function Update($table, $columns, $fields, $columnParams, $fieldParams){
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

    $fieldsArr = explode(",", $fields);

    for($i = 0; $i < count($fieldParams); $i++){
        $updatedQuery .= "$fieldsArr[$i] = ?";

        $check = $i + 1;
        if($check !=  count($fieldParams)){
            $updatedQuery .= " AND ";
        }
    }

    echo $updatedQuery;
    echo "<br>";

    $params = array_merge($columnParams, $fieldParams);


    $stmt = $dh->prepare($updatedQuery);

    $success = $stmt->execute($params);

    if($success){
        echo "Success";
    }
    else{
        echo "Not Success";
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

    echo $deletedQuery;
    echo "<br>";


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
