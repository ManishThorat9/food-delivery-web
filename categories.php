<?php include("partials-front/menu.php");?>

     <!-- CAtegories Section Starts Here -->
     <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                // sql query to get data 
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                // execute the query
                $res = mysqli_query($conn, $sql);

                // count number of rows
                $count = mysqli_num_rows($res);

                if($count > 0){
                    // category available
                    while($row = mysqli_fetch_assoc($res)){

                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        if($image_name != ""){
                            ?>

                            <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <img src="<?php echo SITEURL.'images/category/'.$image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                            </a>

                            <?php

                        }


                    }


                }
                else{
                    // category not available
                    echo "<div class='error text-center'>Category Not Available</div>";
                }


            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include("partials-front/footer.php");?>