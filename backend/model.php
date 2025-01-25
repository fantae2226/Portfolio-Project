<?php
/**
 * 
 * Summary: This model controls the flow of CRUD functionality, connecting the database to the controller using standard MVC architecture.
 * 
 * @author: Ebenezer Fanta the goat. baaa
 * @author: Dragana Acamovic <dragana_2528@hotmail.com>
 * @version: 1.0.69
 * 
 * 
 * 
 * */ 

// all methods will use a base query method


// then methods will be seperated into CRUD

//methods will then call on CRUD to implement specific functionality
include "connect.php";
session_start();


/**
 * Dynamically generates a Create query and executes the query into the database
 * 
 * @param string $table : The table in which the data will be inserted into
 * @param string $fields : The fields in which the values provided to the function will be inserted into
 * @param array $params : The values that will be inserted into the query. Must be listed in the same order as the $fields as well as contain the same amount of items
 * 
 * @return array returns an associative array with data if succesful, otherwise returns error array 
 * 
 */
function Create($table, $fields, $params){
    global $dh;
    $tempArr = array_fill(0, count($params), '?');
    $bindedParams = implode(",", $tempArr);
    $insertQuery = "INSERT into $table ($fields) VALUES ($bindedParams)";


    $stmt = $dh->prepare($insertQuery);

    $success = $stmt->execute($params);

    $response = [];

    if($success){
        $response = [
            "result" => $stmt->fetchAll(PDO::FETCH_ASSOC),
            "status" => true
        ];
    }
    else{
        $response = [
            "result" =>$stmt->errorInfo(),
            "status" => false
        ];
    }

    return $response;
}



/**
 * Dynamically generates a Read query and executes the query into the database
 * 
 * @param string $table : The table in which the data will be inserted into
 * @param string $columns :  The columns from which the read query will extract data from
 * @param string|null $fields(optional) : The fields in which the values provided to the function will be read from
 * @param array|null $params(optional) : The values that will be inserted into the query. Must be listed in the same order as the $fields as well as contain the same amount of items
 * 
 * @return array returns an associative array with data if succesful, otherwise returns error array 
 * 
 */
function Read($table, $columns, $fields = null, $params = null){
    //select all functionality needs to be figured out later
    global $dh;
    // $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $selectedQuery = "SELECT $columns FROM $table";

    if ($params != null && $fields != null) {

        $selectedQuery .= " WHERE ";

        $fieldsArr = explode(",", $fields);
    
        for ($i = 0; $i < count($params); $i++) {
            $selectedQuery .= "$fieldsArr[$i] = ?";
    
            $check = $i + 1;
            if ($check !=  count($params)) {
                $selectedQuery .= " AND ";
            }
        }
    }




    $stmt = $dh->prepare($selectedQuery);

    $success = $stmt->execute($params);

    $response = [];

    if($success){
        $response = [
            "result" => $stmt->fetchAll(PDO::FETCH_ASSOC),
            "status" => true
        ];
    }
    else{
        $response = [
            "result" =>$stmt->errorInfo(),
            "status" => false
        ];
    }

    return $response;

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
 * @return array returns an associative array with data if succesful, otherwise returns error array 
 * 
 */
function Update($table, $columns, $columnParams, $fields = null, $fieldParams = null) {
    global $dh;
    // $tempArr = array_fill(0, count($params), '?');
    // $bindedParams = implode(",", $tempArr);
    $updatedQuery = "UPDATE $table SET ";



    $columnArr = explode(",", $columns);

    for($i = 0; $i < count($columnParams); $i++){
        $updatedQuery .= "$columnArr[$i] = ?";

        $check = $i + 1;
        if ($check !=  count($columnParams)) {
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
            if ($check !=  count($fieldParams)) {
                $updatedQuery .= " AND ";
            }
        }

        $params = array_merge($columnParams, $fieldParams);
    }

    // echo $updatedQuery;
    // echo "<br>";



    $stmt = $dh->prepare($updatedQuery);

    $success = $stmt->execute($params);

    $response = [];

    if($success){
        $response = [
            "result" => $stmt->fetchAll(PDO::FETCH_ASSOC),
            "status" => true
        ];
    }
    else{
        $response = [
            "result" =>$stmt->errorInfo(),
            "status" => false
        ];
    }

    return $response;}


    /**
 * Dynamically generates an delete query and executes the query into the database
 * 
 * @param string $table : The table in which the data will be inserted into
 * @param string $fields : The fields in which the values provided to the function will target for deletion
 * @param array $params : The values that will be inserted into the query to specify a record to be updated. Must be listed in the same order as the $fields as well as contain the same amount of items
 * 
 * @return array returns an associative array with data if succesful, otherwise returns error array 
 * 
 */
function Deletes ($table, $fields, $params) {
    global $dh;
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

    $response = [];

    if($success){
        $response = [
            "result" => $stmt->fetchAll(PDO::FETCH_ASSOC),
            "status" => true
        ];
    }
    else{
        $response = [
            "result" =>$stmt->errorInfo(),
            "status" => false
        ];
    }

    return $response;}


/**
 * Registers a new user by inserting their data into the database.
 * 
 * @param string $username : The username.
 * @param string $email : The user's email address.
 * @param string $password : The user's password (will be hashed before storing).
 * 
 * @return array : returns success or error message
 */
function Register($username, $email, $password){
    global $dh;

    $existingUser = Read('users', '*', 'username, email', [$username, $email]);
    
    // This if statement is supposed to check if username or email exists in db already, it does not work correctly atm 
    // if (is_array($existingUser) && count($existingUser[0]) > 0) {
    //     return ["error" => "Username or email already exists"];
    // }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user using Create function
    $success = Create('users', 'username, email, password', [$username, $email, $hashedPassword]);

    return $success["status"] ? ["success" => "User registered successfully"] : ["error" => "Registration failed"];
}

/**
 * 
 * Unregisters a user by deleting their data from the database.
 *
 * @param string $username : The username.
 * @param string $email : The user's email address.
 * @return array : returns success or error message
 */

function Unregister($username, $email){
    
    if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
        return ["error" => "Invalid email format"]; 
    }

    $existingUser = Read('users', 'user_id', 'username,email', [$username, $email]);
    
    //check if the user exists
    if (is_array($existingUser) && count($existingUser) > 0) {
        
        //delete the user from the db
        $deleted = Deletes('users', 'username, email', [$username, $email]); 

        if($deleted["status"]){
            return ["success" => "User has been unregistered successfully"];
        }else{
            return ["error" => "Error occured. Failed to unregister!"];

        }

    }else{
        return ["error" => "User not found!"];
    }
}


/**
 * Logs the user in
 * 
 * @param string $username : The username.
 * @param string $password : The user's password (will be hashed before storing).
 * 
 * @return array : returns success or error message
 */
function login($username, $password){
    global $dh;

    $user = Read('users', 'user_id, password', 'username', [$username]);

    if(is_array($user) && count($user) > 0){
        $user = $user[0];
        
        if(password_verify($password, $user['password'])){
			$_SESSION["user_id"] = $user["user_id"];
			$_SESSION["valid"] = true;
            return ["success" => "loging successfull"];
        }else{
            return ["error" => "Log-in Unsuccessfull, invalid username or password"];
        }

    } else{
        return ["error" => "wrong username or password"]; 
    }
}


/**
 * Logs the user in
 * 
 * @return array : returns success or error message
 */
 function logout (){
    session_unset();
    return ["successs" => "logout successfull"]; 
 }


?>
