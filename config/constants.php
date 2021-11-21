<?php

    // start session
    session_start();

    // create constants to store non-repeating values
    define('SITEURL', 'http://localhost/FOOD-DELIVERY-WEB/');
    define('LOCALHOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'food-delivary-db');

    $conn = new mysqli(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error($conn)); // database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Selecting database

?>