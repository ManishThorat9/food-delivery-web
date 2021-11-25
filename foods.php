<?php include("partials-front/menu.php");?>


    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php" method="post">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

    <!-- food menu  Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                // sql query to get data from tbl_food
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                // execute sql query
                $res = mysqli_query($conn, $sql);
                // count number of rows
                $count = mysqli_num_rows($res);

                // if number of rows is greater than 0 than data exist
                if($count > 0){
                    // get details
                    
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        if($image_name != ""){

                            ?><div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="<?php echo SITEURL.'images/food/'.$image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL.'order.php'?>?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div><?php
                        }


                    }
                }
                else{
                    echo "<div class='error'>Food Not Found</div>";
                }

            ?>
<!-- 
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="./images/menu-pizza.jpg" alt="pizza" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- food menu  Section Ends Here -->
    
<?php include("partials-front/footer.php");?>