<?php

include_once("constants.php");

$bookingId = $_POST['bookingId'];

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$query = "DELETE FROM " . BOOKED_ROOMS_TABLE . " WHERE " . BOOKED_ROOMS_TABLE . "." . BOOKING_ID . " = $bookingId";
// echo $query;
$result = $connection->query($query);

$query = "DELETE FROM " . BOOKINGS_TABLE . " WHERE " . BOOKINGS_TABLE . "." . BOOKING_ID . " = $bookingId";
// echo $query;
$result = $connection->query($query);

if ($connection->errno) {
    echo $connection->error;
} else {
    echo "Booking with id $bookingId removed successfully";
}

echo "<form action='" . HOME_PAGE . "'>
<button type='submit'>Back to the home page</button>
</form>";
