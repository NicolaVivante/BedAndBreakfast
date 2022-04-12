<?php
include_once("constants.php");

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];

$query = "SELECT * FROM " . USERS_TABLE . " WHERE " . USER_EMAIL . " = '$userEmail'";
$result = $connection->query($query);
if ($result && $result->num_rows != 0) {
    $row = $result->fetch_array();

    if ($row[USER_PASSWORD] == $userPassword) {
        $_SESSION[IS_ADMIN] = $row[IS_ADMIN];
        $_SESSION[USER_EMAIL] = $row[USER_EMAIL];
        $_SESSION[USER_NAME] = $row[USER_NAME];
        header("Location:" . HOME_PAGE);
    } else {
        echo "<h3>Password non corretta</h3>";
        echo "<form action='" . INDEX_PAGE . "'>";
        echo "<button type='submit'>torna alla home page</button>";
        echo "</form>";
    }
} else {
    echo "user not found";
}
