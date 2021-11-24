<?php include("partials-front/menu.php");?>

<?php 
    // check category id is passed or not
    if(isset($_GET['category_id'])){
        // category id is set and get the id
        $category_id = $_GET['category_id'];
        // get the category title based on category id
        $sql = "SELECT * FROM tbl_category WHERE id=$category_id";
        // execute the query
        $res = mysqli_query($conn, $sql);
        // get the value from database
        $row = mysqli_fetch_assoc($res);
        // get the title
        $category_title = $row['title'];

    }
    else{
        // redirect to home page
        header('location:'.SITEURL);
    }
?>

    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <h2>Foods on <a style="text-transform: capitalize;" href="#" class="text-white">"<?php echo $category_title?>"</a></h2>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

    <!-- categories  Section starts Here -->
    <section class="categories">
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
    </section>
    <!-- categories  Section Ends Here -->

    <!-- food menu  Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                // sql query to get food based on category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // count rows
                $count = mysqli_num_rows($res2);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res2)){
                        
                        // get data 
                        $id = $row['id'];
                        $title = $row['title'];
                        $description= $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        if($image_name != ""){

                            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="<?php echo SITEURL.'images/food/'.$image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail">
                                    <?php echo $description;?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL.'order.php'?>?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div><?php

                        }

                    }
                }
                else{
                    echo "<div class='error'>Food Not Found </div>";
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