<?php

include_once("constants.php");

$roomNumber = $_POST['roomNumber'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$breakfast = $_GET['breakfast'];
$email = $_SESSION[USER_EMAIL];

if ($breakfast) {
    $breakfast = TRUE;
} else {
    $breakfast = FALSE;
}

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$query = "INSERT INTO " . BOOKINGS_TABLE . " (" . BOOKING_START_DATE .
    ", " . BOOKING_END_DATE . ", " . BOOKING_HAS_BREAKFAST . ", " . BOOKING_EMAIL . ") VALUES ('$startDate', '$endDate', '$breakfast', '$email');";
// echo $query;
$result = $connection->query($query);

$query = "SELECT MAX(" . BOOKING_ID . ") AS " . BOOKING_ID . " FROM " . BOOKINGS_TABLE . ";";
$result = $connection->query($query);
$bookingId;
while ($row = $result->fetch_array()) {
    $bookingId = $row[BOOKING_ID];
}

$query = "INSERT INTO " . BOOKED_ROOMS_TABLE . " (" . BOOKED_ROOM_ID . ", " . BOOKED_ROOM_NUMBER . ") VALUES 
('$bookingId', '$roomNumber');";
$result = $connection->query($query);

if ($connection->errno) {
    echo $connection->error;
} else {
    $breakfastText = ($breakfast) ? "with" : "without";
    echo "Room number $roomNumber booked successfully from \"$startDate\" to \"$endDate\" $breakfastText breakfast";
}

echo "<form action='" . HOME_PAGE . "'>
<button type='submit'>Back to the home page</button>
</form>";
