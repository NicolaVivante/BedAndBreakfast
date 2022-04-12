<?php
include_once("constants.php");

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];

$query = "SELECT * FROM " . USERS_TABLE . " WHERE " . USER_EMAIL . " = $userEmail";
$result = $connection->query($query);
if ($result !== false && $result->num_rows == 0) {
    // register the user
    $query = "INSERT INTO " . USERS_TABLE . "(" . USER_NAME . ", " . USER_EMAIL . ", " . USER_PASSWORD . ", " . IS_ADMIN . ") VALUES ('$userName', '$userEmail', '$userPassword', FALSE)";
    $connection->query($query);
} else {
    // user exists, show error message
    echo "<h3>This email is already in use</h3>
        <form action='" . INDEX_PAGE . "'>
            <button type='submit'>Back to the login page</button>
        </form>";
}
