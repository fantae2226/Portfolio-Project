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

// if($_SERVER["REQUEST_METHOD"] == "POST"){

//     $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
//     $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
//     $table = "users";
//     $fields = "`username`, `password`";
//     $params = [$username, $password];
    
//     Delete($table, $fields, $params);
// }







