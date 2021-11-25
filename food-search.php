<?php include("partials-front/menu.php");?>


    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                // get the search keyword
                $search = $_POST['search'];
                // prevents sql injection
                // $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Foods on Your Search <a style="text-transform: capitalize;" href="#" class="text-white">"<?php echo $search;?>"</a></h2>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

    <!-- categories  Section starts Here -->
    <!-- <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <a href="#">
                <div class="box-3 float-container">
                    <img src="./images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">
                    <h3 class="float-text text-white">Pizza</h3>
                </div>
            </a>

            <a href="#">
                <div class="box-3 float-container">
                    <img src="./images/burger.jpg" alt="Pizza" class="img-responsive img-curve">
                    <h3 class="float-text text-white">Burger</h3>
                </div>
            </a>

            <a href="#">
                <div class="box-3 float-container">
                    <img src="./images/momo.jpg" alt="Pizza" class="img-responsive img-curve">
                    <h3 class="float-text text-white">Momo</h3>
                </div>
            </a>
            <div class="clearfix"></div>
        </div>
    </section> -->
    <!-- categories  Section Ends Here -->

    <!-- food menu  Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                // get the search keyword
                // $search = $_POST['search'];
                // prevents sql injection
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                
                // sql query to get data which match with keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // execute the query
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){
                    // food available
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        if($image_name != ""){
                            ?><div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="<?php echo SITEURL.'images/food/'.$image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail">
                                    <?php echo $description;?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.html?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
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
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- food menu  Section Ends Here -->

<?php include("partials-front/footer.php");?>