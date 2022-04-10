<?php

include_once "../config/constants.php";

if(isset($_POST['submit'])){
    // fetch all data from login page
    $username = $_POST['username'];
    $userpwd = $_POST['userpwd'];

    include_once "./functions.inc.php";

    // verify all input is clear

    // login 
    loginUser($conn, $username, $userpwd);

}
else{
    header("location:".SITEURL."login.php");
    exit();
}