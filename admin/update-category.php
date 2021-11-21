<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>

        <?php
            // check whether id is set or not
            if(isset($_GET['id'])){
                // get id and all other details 
                // echo "get the data";
                $id = $_GET['id'];
                // create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                // execute sql query
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                // check data exist or not
                if($count == 1){
                    // get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    // create session msg to display error
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    // redirect to manage category page
                    header("location:".SITEURL."admin/manage-category.php");
                }

                
                
            }
            else{
                // redirect to manage category page
                header("location:".SITEURL."admin/manage-category.php");
            }

        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <!-- image will be displayed here -->
                        <?php 
                            if($current_image != ''){
                                echo '<img src="'.SITEURL.'images/category/'.$current_image.'" width="100px" alt="image">';
                            }
                            else{
                                echo "<span class='error'>Image not available</span>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes" id="yFeatured"> <label for="yFeatured">Yes</label>
                        &nbsp;
                        <input <?php if($featured=="No"){echo "checked";}?>  type="radio" name="featured" value="No" id="nFeatured"> <label for="nFeatured">No</label>  
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        
                        <input <?php if($active=="Yes"){echo "checked";}?>  type="radio" name="active" value="Yes" id="yActive"> <label for="yActive">Yes</label>
                        &nbsp; 
                        <input <?php if($active=="No"){echo "checked";}?>  type="radio" name="active" value="No" id="nActive"> <label for="nActive">No</label> 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit'])){
                // echo "Submited";
                // get all the values from our form
                $title = $_POST['title'];
                $image = $_POST['image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating new image if selected
                if(isset($_FILES['image']['name'])){
                    // get image name
                    $image_name = $_FILES['image']['name'];

                    // check the image name is available or not
                    if($image_name != ""){
                        // image available

                        // upload the new image
                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div><br>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //STop the Process
                            die();
                        }

                        // remove the current image if available
                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
    
                            // if failed to remove image then display msg and stop the process
                            if($remove == false){
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                // redirect to manage category page
                                header("location:".SITEURL."admin/manage-category.php");
    
                                // end the proccess
                                die();
                            }
                        }

                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                // update row in database
                $sql2 = "UPDATE tbl_category SET title='$title', featured='$featured', active='$active', image_name='$image_name' WHERE id='$id'";

                // execute query
                $res = mysqli_query($conn, $sql2);

                // redirect to manageg category with msg
                // check query executed or not
                if($res==true){
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
                else{
                    $_SESSION['update'] = "<div class='error'>Failed to Update category.</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>