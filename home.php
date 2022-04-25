<?php

include_once("constants.php");

if (!isset($_SESSION[USER_NAME])) {
    header("Location:" . INDEX_PAGE, true);
}

echo "<form action='" . INDEX_PAGE . "'>
<button type='submit'>Logout</button>
</form>";

echo "Welcome " . $_SESSION[USER_NAME] . "<br>";

echo "<form action='" . NEW_BOOKING_PAGE . "'><button type='submit'>Book a room</button></form>";
echo "<form action='" . VIEW_BOOKINGS_PAGE . "'><button type='submit'>View your bookings</button></form>";

if ($_SESSION[IS_ADMIN]) {
    echo "<form action='" . VIEW_ALL_BOOKINGS_PAGE . "'><button type='submit'>View all bookings</button></form>";
    echo "<form action='" . ADD_ROOM_PAGE . "'><button type='submit'>Add room</button></form>";
    // echo "<form action='" . INDEX_PAGE . "'><button type='submit'>Add administrator</button></form>";
    // echo "<form action='" . INDEX_PAGE . "'><button type='submit'>Remove administrator</button></form>";
}

