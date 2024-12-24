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

function Read($params){}

function Update($params){}

function Delete($table, $fields, $params){
    global $dh;
    include_once "connect.php";
    $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $insertQuery = "DELETE FROM $table WHERE ";

    $fieldsArr = explode(",", $fields);

    for($i = 0; $i < count($params); $i++){
        $insertQuery .= "$fieldsArr[$i] = ?";

        $check = $i + 1;
        if($check !=  count($params)){
            $insertQuery .= " AND ";
        }
    }



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


//




?>
