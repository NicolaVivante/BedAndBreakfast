<?php

include_once("constants.php");

$roomNumber = $_POST['roomNumber'];
$singleBedsNumber = $_POST['singleBedsNumber'];
$doubleBedsNumber = $_POST['doubleBedsNumber'];
$price = $_POST['price'];

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$query = "INSERT INTO " . ROOMS_TABLE . " (" . ROOM_NUMBER .
    ", " . ROOM_SINGLE_BEDS . ", " . ROOM_DOUBLE_BEDS . ", " . ROOM_PRICE . ")
    VALUES ('$roomNumber', '$singleBedsNumber', '$doubleBedsNumber', '$price');";
// echo $query;
$connection->query($query);
if ($connection->errno) {
    echo $connection->error;
} else {
    echo "Room number $roomNumber with $singleBedsNumber single beds, $doubleBedsNumber double beds and price $price added successfully";
}
echo "<form action='" . HOME_PAGE . "'>
<button type='submit'>Back to the home page</button>
</form>";
