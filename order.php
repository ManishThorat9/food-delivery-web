<?php include("partials-front/menu.php");?>

    <?php 
    
        // check food id is set or not
        if(isset($_GET['food_id'])){
            // get the food id and details of selected food
            $food_id = $_GET['food_id'];

            // sql query to get data
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            // execute sql query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            // check data is available or not
            if($count == 1){
                $row = mysqli_fetch_assoc($res);
                
                $food_title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else{
                header('location:'.SITEURL);
            }

        }
        else{
            header("location:".SITEURL);
        }

    ?>

    <!-- food search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="<?php echo SITEURL."payment_reciept.php"?>" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php

                            if($image_name != ""){
                                ?><img src="<?php echo SITEURL.'images/food/'.$image_name;?>" alt="<?php echo $food_title;?>" class="img-responsive img-curve"><?php
                            }
                            else{
                                echo "<div class='error'>Image not available</div>";
                            }

                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $food_title;?></h3>
                        <input type="text" hidden name="title" value="<?php echo $food_title;?>">
                        <input type="text" hidden name="id" value="<?php echo $food_id;?>">
                        <input type="text" hidden name="description" value="<?php echo $description;?>">
                        <input type="text" hidden name="image_name" value="<?php echo $image_name;?>">

                        <p class="food-price">$<?php echo $price;?></p>
                        <input type="text" name="price" value="<?php echo $price;?>" hidden>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" 
                        min=1 value="1" required>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Delivary Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder ="E.g. Jhon Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder ="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder ="E.g.Jhon@web.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea style="resize: none;" name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="text-center">
                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
    <!-- food search  Section Ends Here -->


<?php include("partials-front/footer.php");?>