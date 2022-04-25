<?php
include_once("constants.php");

$connection = new mysqli(DB_URL, DB_USER, DB_PASSWORD, DB_NAME);
if ($connection->connect_error) {
    die("Database connection error");
}

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$breakfast = isset($_POST['breakfast']);

echo "<form action='" . HOME_PAGE . "'>
<button type='submit'>Back to the home page</button>
</form>";

echo "Rooms available from \"$startDate\" to \"$endDate\"<br>";

$query = "SELECT " . ROOMS_TABLE . ".* FROM " . ROOMS_TABLE . "
WHERE " . ROOMS_TABLE . "." . ROOM_NUMBER . " NOT IN
(SELECT DISTINCT " . ROOMS_TABLE . "." . ROOM_NUMBER . " FROM " . ROOMS_TABLE . "
JOIN " . BOOKED_ROOMS_TABLE . " USING(" . ROOM_NUMBER . ")
JOIN " . BOOKINGS_TABLE . " USING(" . BOOKING_ID . ")
WHERE " . BOOKINGS_TABLE . "." . BOOKING_START_DATE . " <= '$endDate'
AND " . BOOKINGS_TABLE . "." . BOOKING_END_DATE . " >= '$startDate');";

// echo $query;
echo "<br>";

$result = $connection->query($query);


if ($connection->errno) {
    echo $connection->error;
    echo "<br>";
}

if ($result) {
    echo "<table border>";

    // table header
    echo "<tr>";
    echo "<th>Room number</th>";
    echo "<th>price</th>";
    echo "<th>single beds</th>";
    echo "<th>double beds</th>";
    echo "<th>Book now</th>";
    echo "</tr>";

    while ($row = $result->fetch_array()) {
        $roomNumber = $row[ROOM_NUMBER];
        $roomPrice = $row[ROOM_PRICE];
        $roomSingleBeds = $row[ROOM_SINGLE_BEDS];
        $roomDoubleBeds = $row[ROOM_DOUBLE_BEDS];
        echo "<tr>";
        echo "<td>$roomNumber</td>";
        echo "<td>$roomPrice</td>";
        echo "<td>$roomSingleBeds</td>";
        echo "<td>$roomDoubleBeds</td>";
        echo "<td><form method='POST' action='" . ADD_BOOKING_PAGE . "?startDate=$startDate&endDate=$endDate&breakfast=$breakfast'>
            <button type='submit' name='roomNumber' value='$roomNumber'>Book</button>
            </form></td>";
        echo "</tr>";
    }
    echo "</table>";
}
