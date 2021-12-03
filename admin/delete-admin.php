<?php 

    //Include constants.php file here
    include('../config/constants.php');

    // 1. get the ID of Admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if($res==true)
    {
        //Query Executed Successully and Admin Deleted
        //echo "Admin Deleted";
        //Create SEssion Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div><br>";
        //Redirect to Manage Admin Page
        // header('location:'.SITEURL.'admin/manage-admin.php');
        echo "<script>location.href = '".SITEURL."admin/manage-admin.php' </script>";
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div><br>";
        // header('location:'.SITEURL.'admin/manage-admin.php');
        echo "<script>location.href = '".SITEURL."admin/manage-admin.php' </script>";
    }

    //3. Redirect to Manage Admin page with message (success/error)

?>