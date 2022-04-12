<?php

include_once("constants.php");

$email = $_SESSION[USER_EMAIL];

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$query = "SELECT " . BOOKINGS_TABLE . ".*, " . ROOM_NUMBER . " FROM " . BOOKINGS_TABLE .
    " JOIN " . BOOKED_ROOMS_TABLE . " USING(" . BOOKING_ID .
    ") WHERE " . BOOKINGS_TABLE . "." . BOOKING_EMAIL . " = '$email';";
//echo $query;
$result = $connection->query($query);

if ($result && $result->num_rows != 0) {
    echo "<table border>";

    // table header
    echo "<tr>";
    echo "<th>booking id</th>";
    echo "<th>start date</th>";
    echo "<th>end date</th>";
    echo "<th>breakfast included</th>";
    echo "<th>room number</th>";
    echo "</tr>";

    while ($row = $result->fetch_array()) {
        $bookingId = $row[BOOKING_ID];
        $startDate = $row[BOOKING_START_DATE];
        $endDate = $row[BOOKING_END_DATE];
        $breakfast = ($row[BOOKING_HAS_BREAKFAST]) ? "yes" : "no";
        $roomNumber = $row[ROOM_NUMBER];

        echo "<tr>";
        echo "<td>$bookingId</td>";
        echo "<td>$startDate</td>";
        echo "<td>$endDate</td>";
        echo "<td>$breakfast</td>";
        echo "<td><form method='POST' action='" . REMOVE_BOOKING_PAGE . "'>
                <button type='submit' name='bookingId' value='$bookingId'>remove</button>
                </form></td>";
        echo "</tr>";
    }
} else {
    echo "No bookings available";
}
