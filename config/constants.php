<?php

    // start session
    session_start();

    // create constants to store non-repeating values
    // define('SITEURL', 'https://food-order-web.000webhostapp.com/');
    // define('LOCALHOST', 'localhost');
    // define('USERNAME', 'id18045339_root');
    // define('PASSWORD', 'vM(6xwFpLp5R{j$1');
    // define('DB_NAME', 'id18045339_food_delivary_food');

    define('SITEURL', 'http://localhost/FOOD-DELIVERY-WEB/');
    define('LOCALHOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DB_NAME', 'food-delivary-db');

    $conn = new mysqli(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error($conn)); // database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Selecting database
?>