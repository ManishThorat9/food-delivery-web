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
            <form action="" class="order" method="POST">
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
                        <p class="food-price">$<?php echo $price;?></p>

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

    <?php
        if(isset($_POST['submit'])){
            // get the details
            $food = $food_title;
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $order_date = date("Y-m-d h:i:s a"); // order date

            $status = "Ordered";  // ordered , on delivery, delivered, canceled

            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // save the order in database
            // create sql to save the data
            $sql2 = "INSERT INTO tbl_order SET
                food='$food',
                price='$price',
                qty ='$qty',
                total='$total',
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // check whether query executed succesfully or not
            if($res2==true){
                $_SESSION['order'] = "<div class='success'>Food Order Succesfully</div><br>";
                header("location:".SITEURL."payment_reciept.php");
            }
            else{
                $_SESSION['order'] = "<div class='error'>Failed to Order</div><br>";
                header("location:".SITEURL);
            }
        }
    ?>

<?php include("partials-front/footer.php");?>