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
        }?>
    
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
                        <input type="text" name="price" value=<?php echo $price;?> hidden>

                        <div class="order-label">Quantity</div>
                        <div class="order-details">
                        <input type="number" name="qty" class="input-responsive" 
                            min=1 max=10 value="1" id='txt-qty' required>

                            <p class="tax-delivery">*Tax : ₹<span id="txt-tax">15</span> &nbsp; *Delivery : ₹<span id="txt-deliver">10</span></p>

                            <span class="payment-mode">Payment Method : </span>

                            <select name="payment" id="pay_mode" class="option">
                                <option value="cod">COD</option>
                                <option value="online">Online Payment</option>
                            </select>

                            <!-- <input type="radio" name="payment" id=""> Cod &nbsp;
                            <input type="radio" name="payment" id=""> Online Payment -->
                            
                            <p class="total">Total : ₹<span id="txt-total">0</span></p>

                            <div class="text-right">
                                <input type="submit" name="submit" value="Confirm Order" id="rzp-button1" class="confirm-btn btn btn-primary">
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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


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
        var cal;
        
        function changeTotal(){
            var qty_val = Number(qty.value); 
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
            
            // 
            $food_id = $_POST['id'];
            $food = $_POST['title'];
            $food_price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = ($food_price * $qty) + 10 + 15;   // 10 for deliver and 15 for tax
            $payment_mode = $_POST['payment'];
            $order_date = date("Y-m-d h:i:s a"); // order date
            $status = "Ordered";  // ordered , on delivery, delivered, canceled
            // getting customer details
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
            
            // insert data and goto print reciept page;

                // query to insert data;
                $sql2 = "INSERT INTO tbl_order SET 
                    food='$food',
                    price='$food_price',
                    qty='$qty',
                    total='$total',
                    pay_mode='$payment_mode',
                    order_date='$order_date', 
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    ";

                // execute query
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == false){
                    echo "<script>location.href = '".SITEURL."order.php?food_id=$food_id'</script>";
                    die();
                }

            // check payment mode is cod or online
            if($payment_mode == "cod"){

                echo "<script>location.href = '".SITEURL."payment_reciept.php?id=$food_id'</script>";

            }
            else{
                
                // online payment gateway code here
                // $total = $total * 100;
                echo "<script>location.href = '".SITEURL."confirm.php?price=$total&id=$food_id'</script>";
                
            }
        }

?>

<?php include("partials-front/footer.php");?>