<?php

include "model.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){


    $prefix = "/Portfolio Project/backend/";

    $path = urldecode($_SERVER['REQUEST_URI']);
    $request = substr($path, strlen(($prefix)));

    $components = explode('/', $request);

   // Prepare the data as an associative array
   $response = [
    "path" => $path,
    "request" => $request,
    "components" => $components
    ];

    // Set the header to return JSON
    header('Content-Type: application/json');

    // Output the response as JSON
    echo json_encode($response);


    // $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    // $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    // $table = "users";
    // $fields = "`username`, `password`";
    // $params = [$username, $password];
    
    // Create($table, $fields, $params);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    // $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    // $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
    


    // Decode JSON input
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, true);

    $username = isset($input['username']) ? htmlspecialchars($input['username'], ENT_QUOTES, 'UTF-8') : null;
    $password = isset($input['password']) ? htmlspecialchars($input['password'], ENT_QUOTES, 'UTF-8') : null;
    $role = isset($input['role']) ? htmlspecialchars($input['role'], ENT_QUOTES, 'UTF-8') : null;



    //$table = "users";
    $fields = "`username`, `password`, `role`";
    $params = [$username, $password, $role];


    $prefix = "/Portfolio Project/backend/";

    $path = urldecode($_SERVER['REQUEST_URI']);
    $request = substr($path, strlen(($prefix)));

    $components = explode('/', $request);

    
    
    //if array is size 1
    
    $table = "";
    
    if(count($components) == 1){
        $table = $components[0];
    }
    
    // Prepare the data as an associative array

    // $response = [
    //     "path" => $path,
    //     "request" => $request,
    //     "components" => $components,
    //     "table" => $table,
    //     "fields" => $fields,
    //     "params" => $params
    // ];

    $response = Create($table, $fields, $params);

    // Set the header to return JSON
    header('Content-Type: application/json');

    // Output the response as JSON
    echo json_encode($response);

    // echo $table;
    // echo "<br>";
    // echo $fields;
    // echo "<br>";
    // echo $params;
    // echo "<br>"
    
    // Create($table, $fields, $params);
}







