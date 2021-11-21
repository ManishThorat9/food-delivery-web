<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>

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

    </div>
</div>

<?php include('partials/footer.php'); ?>