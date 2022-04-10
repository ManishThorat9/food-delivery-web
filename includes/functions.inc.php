<?php
include_once "../config/constants.php";

function uidExist($conn , $useruid, $useremail){
    $sql = "SELECT * FROM tbl_users WHERE usersuid=? OR usersemail=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header('location:'.SITEURL.'signup.php?m=stmtFailed');
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ss', $useruid, $useremail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

}

function createUser($conn, $name, $useremail, $useruid, $userpwd){
    $sql = 'INSERT INTO tbl_users (usersname, usersemail, usersuid, userspwd) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header('location:'.SITEURL.'signup.php?m=stmtFailed');
        exit();
    }

    $hashedpwd = password_hash($userpwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $useremail, $useruid, $hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('location:'.SITEURL.'signup.php?m=success');
    exit();

}


function loginUser($conn, $username, $userpwd){

    $uidExists = uidExist($conn, $username, $username);

    if($uidExists === false){
        header('location:'.SITEURL.'login.php?m=userNotFound');
        exit();
    }

    $hashedpwd = $uidExists['userspwd'];
    $checkPwd = password_verify($userpwd, $hashedpwd);

    if($checkPwd == false){
        header('location:'.SITEURL.'login.php?m=wrongPwd');
        exit();
    }

    if($checkPwd == true){

        $_SESSION['userid'] = $uidExists['usersid'];
        $_SESSION['useruid'] = $uidExists['usersuid'];


        header('location:'.SITEURL.'index.php');
        exit();
    }


}