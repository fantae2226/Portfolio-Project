<?php

include "model.php";


switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
        $components = getURIComponents();
   
        $table = $components[0];
        $column = "*";
    

         $fields = $params = null;

        if(count($components) > 1){

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
        $role = isset($input['role']) ? htmlspecialchars($input['role'], ENT_QUOTES, 'UTF-8') : null;

        $fields = implode(",",array_keys($input));
        // $fields = "`username`, `password`, `role`";
        $params = [$username, $password, $role];

        $components = getURIComponents();

        //if array is size 1
        
        $table = "";
        
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

        $role = isset($input['role']) ? htmlspecialchars($input['role'], ENT_QUOTES, 'UTF-8') : null;

        $fields = implode(",",array_keys($input));

        break;
    case "DELETE":
        break;
    default:
        break;
}





function getURIComponents(){
    $prefix = "/Portfolio Project/backend/";

    $path = urldecode($_SERVER['REQUEST_URI']);
    $request = substr($path, strlen(($prefix)));

    $components = explode('/', $request);

    return $components;
}


