<?php 
include_once "../config/constants.php";


if(isset($_POST['submit'])){
    // get all data from signup page
    $name = $_POST['username'];
    $useruid = $_POST['useruid'];
    $useremail = $_POST['useremail'];
    $userpwd = $_POST['userpwd'];
    $userepwd = $_POST['userepwd'];


    include_once "../config/constants.php";
    include_once "./functions.inc.php";

    // do all verifications steps 

    // checks user exist already or not
    if(uidExist($conn, $useruid, $useremail) !== false){
        header("location:".SITEURL."signup.php?m=usernameTaken");
        exit();
    }

    createUser($conn, $name, $useremail, $useruid, $userpwd);

}
else{
    header('location:../signup.php');
    exit();
}