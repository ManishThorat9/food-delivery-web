<?php 
    //Include constants.php for SITEURL
    include('../config/constants.php');
    //1. Destory the Session
    // session_destroy(); //Unsets $_SESSION['user']
    unset($_SESSION["user"]);

    //2. REdirect to Login Page
    // header('location:'.SITEURL.'admin/login.php');
    echo "<script>location.href = '".SITEURL."admin/login.php' </script>";

?>