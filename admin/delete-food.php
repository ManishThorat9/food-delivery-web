<?php

    include("../config/constants.php");
    
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        // deletion code 
        // get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        echo "hello";

        // remove image if available
        if($image_name != ""){
            // remove image code
            // get the image path
            $path = "../images/food/".$image_name;

            // remove image file from folder
            $remove = unlink($path);

            // check image is removed or not
            if($remove == false){

                $_SESSION['delete'] = "<div class='error'>Failed to remove image</div><br>";
                // header("location:".SITEURL."admin/manage-food.php");
                echo "<script>location.href = '".SITEURL."admin/manage-food.php' </script>";

                // end prosess
                die();

            }
        }

        // sql query to remov data from table
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        // execute sql query
        $res = mysqli_query($conn, $sql);

        // check if query executed or not
        if($res == true){
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div><br>";
            // header("location:".SITEURL."admin/manage-food.php");
            echo "<script>location.href = '".SITEURL."admin/manage-food.php' </script>";
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food</div><br>";
            // header("location:".SITEURL."admin/manage-food.php");
            echo "<script>location.href = '".SITEURL."admin/manage-food.php' </script>";
        }

    }
    else{
        // redirect to manage food page
        $_SESSION['delete'] = "<div class='error'>Unauthorized access</div>";
        // header("location:".SITEURL."admin/manage-food.php");
        echo "<script>location.href = '".SITEURL."admin/manage-food.php' </script>";
    }

?>