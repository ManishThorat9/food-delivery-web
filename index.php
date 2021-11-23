<?php include("partials-front/menu.php");?>


    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="food-search.html" method="post">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

    <!-- categories  Section starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // sql query to get data from category table
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";
                // execute sql query
                $res = mysqli_query($conn, $sql);
                // count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);
                // 
                if($count > 0){
                    // categories available
                    $num = 1;
                    while(($row = mysqli_fetch_assoc($res)) && $num <= 3 ){
                        // get details
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        // only display category that has image 
                        if($image_name != ""){
                        ?>
                        
                        
                            <a href="category-foods.html">
                                <div class="box-3 float-container">
                                    <img src="<?php echo SITEURL.'images/category/'.$image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>

                        <?php
                        $num++;
                        }

                    }
                }
                else{
                    // categories not available
                    echo "<div class='error'>Category not added</div>";
                }

            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories  Section Ends Here -->

    <!-- food menu  Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

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
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="./images/menu-burger.jpg" alt="burger" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="./images/menu-burger.jpg" alt="burger" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Nice Burger</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

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
            </div>

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
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="./images/menu-momo.jpg" alt="momo" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Chiken Steam momo</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- food menu  Section Ends Here -->


<?php include("partials-front/footer.php");?>