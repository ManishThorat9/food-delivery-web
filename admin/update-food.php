<?php include('partials/menu.php'); ?>

<?php

    // check id is set or not
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        // sql query to get data from table
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        // execute query
        $res2 = mysqli_query($conn, $sql2);

        // count number of rows
        $count = mysqli_num_rows($res2);

        // check if data available then continue
        if($count != 1){
            // redirect to manage-food page
            header("location:".SITEURL."admin/manage-food.php");
        }

        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else{
        header("location:".SITEURL."admin/manage-food.php");
    }

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" style="resize: none;"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" value="<?php echo $price;?>" name="price" min="0">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php

                            // check if image name is there or not
                            if($current_image != ""){

                                ?>

                                <img src="<?php echo "../images/food/".$current_image;?>" alt="food_image" width="100px">
                                
                                <?php

                            }
                            else{
                                echo "<span class='error'>Image not set</span>";
                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >
                            <!-- <option value="0">Categories here</option> -->
                            <?php

                                // to get category which are active
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                // execute the query
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                // check whether category available or not
                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        // get the details for category
                                        $category_id = 
                                        $category_title = $row['title'];

                                        ?><option <?php if($current_category == $category_id){echo "selected";}?> value="<?php $category_id;?>"><?php echo $category_title;?></option><?php

                                    }
                                }
                                else{
                                    echo '<option value="0">No categories available</option>';
                                }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=='Yes'){ echo "checked";}?> type="radio" name="featured" value="Yes" id="yFeatured"> <label for="yFeatured">Yes</label> &nbsp;
                        <input <?php if($featured=='No'){ echo "checked";}?> type="radio" name="featured" value="No" id="nFeatured"> <label for="nFeatured">No</label>  
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=='Yes'){ echo "checked";}?> type="radio" name="active" value="Yes" id="yActive"> <label for="yActive">Yes</label>
                        &nbsp; 
                        <input <?php if($active=='No'){ echo "checked";}?> type="radio" name="active" value="No" id="nActive"> <label for="nActive">No</label> 
                    </td>
                </tr>

                <tr>
                    <td colspan="7">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            // check submit btn is cliked or not
            if(isset($_POST['submit']))
            {
                

                //1. Get all the details from the form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                // $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name']; //New Image NAme

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        //REname the Image
                        $ext = end(explode('.', $image_name)); //Gets the extension of the image

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/food/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                            //FAiled to Upload
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //REdirect to Manage Food 
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Stop the Process
                            die();
                        }
                        //3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current Image if Available
                        if($current_image!="")
                        {
                            //Current Image is Available
                            //REmove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Image when Button is not Clicked
                }

                

                //4. Update the Food in Database
                $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    echo "Button Clicked";
                    header('location:'.SITEURL."admin/manage-food.php");
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>