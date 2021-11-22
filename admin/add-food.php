<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>

        <?php
            // if image is not uploaded
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Enter title here" required></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea style="resize: none;" name="description" cols="30" rows="5" placeholder="Description of the food" noresize></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" min="0" required></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                // display categories from the database
                                // create sql to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";

                                // execute query
                                $res = mysqli_query($conn, $sql);
                                // count num of rows
                                $count = mysqli_num_rows($res);

                                if($count > 0){
                                    // get data row by row
                                    while($row = mysqli_fetch_assoc($res)){
                                        // get the details of category
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                            <option value="<?php echo $id; ?>">
                                                <?php echo $title; ?>
                                            </option> 

                                        <?php

                                    }
                                }
                                else{
                                    echo "<option value='0'>no categories found</option>";
                                }

                            ?>

                            <!-- <option value="1">food</option>
                            <option value="2">drink</option> -->
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" id="yFeatured"> <label for="yFeatured">Yes</label> &nbsp;
                        <input type="radio" name="featured" value="No" id="nFeatured"> <label for="nFeatured">No</label>  
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" id="yActive"> <label for="yActive">Yes</label>
                        &nbsp; 
                        <input type="radio" name="active" value="No" id="nActive"> <label for="nActive">No</label> 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            // check if submit btn is clicked or not
            if(isset($_POST['submit'])){
                // add the food in database

                // get data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check the radio btn for featured and active are checked or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = 'No'; // setting the default value
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = 'No'; // setting the default value
                }

                // check if image is selected  or not
                if(isset($_FILES['image']['name'])){
                    // get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // check the image is selected or not and upload the image if selected
                    if($image_name != ""){
                        // image is selected
                        // rename the image
                        // get extension of selected image
                        $ext = end(explode('.', $image_name));

                        // create new name for image
                        $image_name = "Food-Name-".rand(0000, 9999).".".$ext;

                        // get the source path and destination path

                        $src = $_FILES['image']['tmp_name'];

                        // destination path
                        $dst = "../images/food/".$image_name;

                        // move image from src to destination
                        $upload = move_uploaded_file($src, $dst);

                        // check the image is uploaded or not
                        if($upload==false){
                            // failed to upload the image 
                            // redirect to add food page with error msg

                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div><br>";
                            header("location:".SITEURL."admin/add-food.php");

                            // stop the process
                            die();
                        }

                    }

                }
                else{
                    $image_name = "";
                }

                // insert data in database 
                // sql query to insert data in database
                $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description', price='$price', image_name='$image_name', category_id='$category', featured='$featured', active='$active'";

                // execute sql query
                $res = mysqli_query($conn, $sql2);

                // check query is executed successfully or not
                if($res == true){
                    // data inserted succesfully msg and redirect to manage food page
                    $_SESSION['add'] = "<div class='success'>Food Added Succesfully</div><br>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
                else{
                    // failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food...</div><br>";
                    header("location:".SITEURL."admin/manage-food.php");
                }

                
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>