<?php

include "model.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){

    $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $table = "users";
    $fields = "`username`, `password`";
    $params = [$username, $password];
    
    Create($table, $fields, $params);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $table = "users";
    $fields = "`username`, `password`";
    $params = [$username, $password];
    
    Delete($table, $fields, $params);
}




?>



<h3>Test Login Page!</h3>
<form>
    Username:<input type="text" name="username">
    <br><br>
    Password:<input type="password" name="password">
    <br><br>
    <input type="submit" name="submit" value="Submit!">
</form>



<form method="post">
    <h3>Delete User</h3>
    Username:<input type="text" name="username">
    <br><br>
    Password:<input type="password" name="password">
    <br><br>
    <input type="submit" name="submit" value="Submit!">
</form>