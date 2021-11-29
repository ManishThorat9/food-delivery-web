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
    <section class="food-search order-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" class="order" method="POST">
                <div class="box left">
                    <!-- <legend>Selected Food</legend> -->

                    <div class="food-menu-img order-food-img">
                        <?php
                            if($image_name != ""){
                                ?><img src="<?php echo SITEURL.'images/food/'.$image_name;?>" alt="<?php echo $food_title;?>" class="img-responsive img-curve order-image"><?php
                            }
                            else{
                                echo "<div class='error'>Image not available</div>";
                            }

                        ?>
                    </div>

                    <div class="details">
                        <h3><?php echo $food_title;?></h3>
                        <input type="text" hidden name="title" value="<?php echo $food_title;?>">
                        <input type="text" hidden name="id" value="<?php echo $food_id;?>">
                        <input type="text" hidden name="description" value="<?php echo $description;?>">
                        <input type="text" hidden name="image_name" value="<?php echo $image_name;?>">

                        <p class="food-price">Price : ₹<?php echo $price;?></p>
                        <input type="text" name="price" value=<?php echo '$price;'?> hidden>

                        <div class="order-label">Quantity</div>
                        <div class="order-details">
                        <input type="number" name="qty" class="input-responsive" 
                            min=1 max=10 value="1" id='txt-qty' required>

                            <p class="tax-delivery">*Tax : ₹<span id="txt-tax">15</span> &nbsp; *Delivery : ₹<span id="txt-deliver">10</span></p>

                            <span class="payment-mode">Payment Method : </span>

                            <select name="payment" class="option">
                                <option value="cod">COD</option>
                                <option value="online">Online Payment</option>
                            </select>

                            <!-- <input type="radio" name="payment" id=""> Cod &nbsp;
                            <input type="radio" name="payment" id=""> Online Payment -->
                            
                            <p class="total">Total : ₹<span id="txt-total">0</span></p>

                            <div class="text-right">
                                <input type="submit" name="submit" value="Confirm Order" class="confirm-btn btn btn-primary">
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="box right">
                    <!-- <legend>Delivary Details</legend> -->
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder ="E.g. Jhon Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder ="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder ="E.g.Jhon@web.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea style="resize: none;" name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

    <script>
        
        // get total id element
        var total = document.querySelector('#txt-total');
        var qty = document.querySelector('#txt-qty');
        var tax = Number(document.querySelector('#txt-tax').innerText);
        var deliver = Number(document.querySelector('#txt-deliver').innerText);
        var price = <?php echo $price;?>;

        total.innerText = (Number(qty.value) * price) + tax + deliver;

        // adding on input event on qty fieald
        qty.addEventListener('input', changeTotal, true);

        function changeTotal(){
            var cal;
            var qty_val = qty.value; 
            if(qty_val > 0){
                cal = (qty_val * price) + tax + deliver;
            }
            else{
                cal = price + tax + deliver;
            }

            total.innerText = cal;

        }

    </script>

<?php 

        // check submit btn is clicked or not 
        if(isset($_POST['submit'])){

            // get value of payment mode
            $payment_mode = $_POST['payment'];
            $id = $_POST['id'];

            // 
            $food = $_POST['title'];
            $food_id = $_POST['id'];
            $food_price = $_POST['price'];
            $qty = $_POST['qty'];
            // $qty = ($food_id * $qty) + 15 + 10;
            

            // check payment mode is cod or online
            if($payment_mode == "cod"){
                // insert data and goto print reciept page;

                // query to insert data;
                $sql = "INSERT INTO tbl_order SET 
                    food='$food',
                    price='$price',
                    qty='$qty',
                    total='$total',
                    pay_mode='$payment_mode',
                    status='$status',
                    order_date='$date', 
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address',
                    ";

                
                
                echo "<script>location.href = '".SITEURL."payment_reciept.php'</script>";

                header('location:'.SITEURL.'payment_reciept.php?id='.$id);
            }
            else{
                header('location:'.SITEURL.'order.php');
            }
        }

?>

<?php include("partials-front/footer.php");?>