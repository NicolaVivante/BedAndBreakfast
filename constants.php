<?php

// DB
define("DB_URL", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "bed_and_breakfast_5ci");

// users table 
define("USERS_TABLE", "utenti");
define("USER_NAME", "nome_utente");
define("USER_EMAIL", "email_utente");
define("USER_PASSWORD", "password_utente");
define("IS_ADMIN", "admin");

// rooms table
define("ROOMS_TABLE", "camere");
define("ROOM_NUMBER", "numero_camera");
define("ROOM_SINGLE_BEDS", "numero_letti_singoli");
define("ROOM_DOUBLE_BEDS", "numero_letti_matrimoniali");
define("ROOM_PRICE", "prezzo");

// booked rooms table
define("BOOKED_ROOMS_TABLE", "camere_prenotate");
define("BOOKED_ROOM_ID", "id_prenotazione");
define("BOOKED_ROOM_NUMBER", "numero_camera");

// bookings table
define("BOOKINGS_TABLE", "prenotazioni");
define("BOOKING_ID", "id_prenotazione");
define("BOOKING_START_DATE", "data_inizio");
define("BOOKING_END_DATE", "data_fine");
define("BOOKING_HAS_BREAKFAST", "colazione");
define("BOOKING_EMAIL", "email_utente");

// pages
define("HOME_PAGE", "home.php");
define("INDEX_PAGE", "index.html");
define("LOGIN_PAGE", "login.php");
define("REGISTER_PAGE", "register.php");
define("NEW_BOOKING_PAGE", "newBooking.html");
define("ADD_BOOKING_PAGE", "addBooking.php");
define("REMOVE_BOOKING_PAGE", "removeBooking.php");
define("VIEW_BOOKINGS_PAGE", "viewBookings.php");
define("VIEW_ALL_BOOKINGS_PAGE", "viewAllBookings.php");
define("ADD_ROOM_PAGE", "newRoom.html");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
