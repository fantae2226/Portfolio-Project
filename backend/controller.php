<?php

include "model.php";


switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
        $components = getURIComponents();
   
        $table = $components[0];
        $column = "*";
    
        $fields = $params = null;

        if (count($components) > 1) {

            $fields = "username";
            $params = [$components[1]];
        }

        $response = Read($table, $column, $fields, $params);

        // Set the header to return JSON
        header('Content-Type: application/json');

        // Output the response as JSON
        echo json_encode($response);
        break;
    case "POST":
        
        // Decode JSON input
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $username = isset($input['username']) ? htmlspecialchars($input['username'], ENT_QUOTES, 'UTF-8') : null;
        $password = isset($input['password']) ? htmlspecialchars($input['password'], ENT_QUOTES, 'UTF-8') : null;
        $email = isset($input['email']) ? htmlspecialchars($input['email'], ENT_QUOTES, 'UTF-8') : null;

        $fields = implode(",",array_keys($input));
        // $fields = "`username`, `password`, `role`";
        $params = [$username, $password, $email];

        $components = getURIComponents();

        //if array is size 1
        
        $table = null;
        
        //this doesn't make sense, why would i check this when the components will always be set
        if(count($components) == 1){
            $table = $components[0];
        }
        
        $response = Create($table, $fields, $params);

        // Set the header to return JSON
        header('Content-Type: application/json');

        // Output the response as JSON
        echo json_encode($response);

        break;
    case "PUT":
        // Decode JSON input
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        $username = isset($input['username']) ? htmlspecialchars($input['username'], ENT_QUOTES, 'UTF-8') : null;

        $columns = implode(",",array_keys($input));
        $columnParams = [$username];

        $components = getURIComponents();

        $table = $components[0];


        $specifier = $specifierParams = null;


        if (count($components) > 1) {
            //specifier should be the name of the column which you are trying to query by. Ex: Searching in student # col for certain student ids

            $specifier = "email";
            $specifierParams = [$components[1]];

        }

        $response = Update($table, $columns, $columnParams, $specifier, $specifierParams);

        
        // Set the header to return JSON
        header('Content-Type: application/json');

        // Output the response as JSON
        echo json_encode($response);


        break;
    case "DELETE":
        // // Decode JSON input
        // $inputJSON = file_get_contents('php://input');
        // $input = json_decode($inputJSON, true);

        // $username = isset($input['username']) ? htmlspecialchars($input['username'], ENT_QUOTES, 'UTF-8') : null;
        // $password = isset($input['password']) ? htmlspecialchars($input['password'], ENT_QUOTES, 'UTF-8') : null;
        // $role = isset($input['role']) ? htmlspecialchars($input['role'], ENT_QUOTES, 'UTF-8') : null;

        // $fields = implode(",",array_keys($input));
        // // $fields = "`username`, `password`, `role`";
        // $params = [$username, $password, $role];

        // $components = getURIComponents();

        // //if array is size 1
        
        // $table = null;
        
        // //this doesn't make sense, why would i check this when the components will always be set
        // if(count($components) == 1){
        //     $table = $components[0];
        // }
        
        // $response = Deletes($table, $fields, $params);

        // // Set the header to return JSON
        // header('Content-Type: application/json');

        // // Output the response as JSON
        // echo json_encode($response);
        break;
    default:
        break;
}





function getURIComponents(){
    $prefix = "/Portfolio-Project/backend/";

    $path = urldecode($_SERVER['REQUEST_URI']);
    $request = substr($path, strlen(($prefix)));

    $components = explode('/', $request);

    return $components;
}


