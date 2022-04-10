<?php 

include("../config/constants.php");

// session_start();
// session_unset();
// session_destroy();

unset($_SESSION["userid"]);
unset($_SESSION["username"]);

header('location:'.SITEURL.'index.php?m=loggedout');