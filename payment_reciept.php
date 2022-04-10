<?php include("./config/constants.php");?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="./css/payment-style.css">

    <title>Reciept</title>
</head>

<body>

    <?php

        // check if data is passed or not
        if(isset($_GET['id'])){
            $food_id = $_GET['id'];

            // sql query to get last inserted row in table
            $sql = "SELECT * FROM tbl_order WHERE id=(SELECT MAX(id) AS id FROM tbl_order)";
            $res = mysqli_query($conn, $sql);

            $sql2 = "SELECT * FROM tbl_food WHERE id=$food_id";
            $res2 = mysqli_query($conn, $sql2);

            $count = mysqli_num_rows($res);
            $count2 = mysqli_num_rows($res2);

            if($count == 1 && $count2== 1){
                // data avaiable 
                $row = mysqli_fetch_assoc($res);
                $row2 = mysqli_fetch_assoc($res2);

                
                $image_name = $row2['image_name'];
                $food_description = $row2['description'];
                $food_price = $row2['price'];

                $food_title = $row['food'];
                $order_id = $row['id'];
                $qty = $row['qty'];
                $final_amt = $row['total'];
                $pay_mode = $row['pay_mode'];
                $order_date = $row['order_date'];
                // // customer info
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                $tax = 15;
                $delivery_chrg = 10;
                $total_amt = (int)$qty * (int)$food_price;


                // send email in php
                // $owner_mail = "aaryan28102002@gmail.com, tjaiswal889@gmail.com";
                $owner_mail = "aaryan28102002@gmail.com";
                $to = ''.$customer_email.','.$owner_mail;
                $subject = "Food Order";
                $message = "Name : ".$customer_name."\nPhone No : ".$customer_contact."\nOrder Food : ".$food_title."\nQty : ".$qty."\nPrice : ".$food_price."\nTotal Amt : ".$final_amt."(Including Tax)\nPayment Mode : ".$pay_mode."";
                $from = "nipaneeducation@gmail.com";
                $headers = "From : $from";

                // mail($to, $subject, $message, $headers);

                // echo "Mail Sent";

            }
            else{
                // no data send to order page
                // header('location:'.SITEURL);
                echo "<script>location.href = '".SITEURL."' </script>";
            }
        }
        else{
            // header("location:".SITEURL);
            echo "<script>location.href = '".SITEURL."' </script>";
        }

    ?>

    <div id='receipt' class="my-5 page "  size="A4">
        <div class="pt-5 pb-5 pl-4 pr-4">
            <section class="top-content bb d-flex justify-content-between pr-2">
                <div class="logo">
                    <img src="./images/logo.png" alt="" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Invoice</p>
                    </div>
                    <div class="position-relative">
                        <p>Invoice No. <span><?php echo $order_id;?></span></p>
                    </div>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <div class="col-7">
                            <p>Supplier,</p>
                            <h2>Wow Food</h2>
                            <p class="address"> 777 Brockton Avenue, <br> Abington MA 2351, <br>Vestavia Hills AL </p>
                            <div class="txn mt-2">TXN: XXXXXXX</div>
                        </div>
                        <div class="col-5">
                            <p>Client,</p>
                            <h2><?php echo $customer_name;?></h2>
                            <p class="address"> <?php echo $customer_address;?> </p>
                            <div class="txn mt-2">TXN: XXXXXXX</div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Payment Method: <span><?php echo $pay_mode;?></span></p>
                            <p>Order Number: <span><?php echo $order_id;?></span></p>
                        </div>
                        <div class="col-5">
                            <p>Deliver Date: <span><?php echo $order_date;?></span></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="product-area mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Item Description</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="media">
                                    <?php 
                                        if($image_name != ""){
                                            ?><img class="mr-3 img-fluid" src="<?php echo SITEURL."images/food/".$image_name?>" alt="<?php $food_title?>"><?php
                                        }
                                        else{
                                            ?><div class="mr-3 img-fluid"><?php echo $food_title;?></div><?php
                                        }
                                    ?>
                                    <!-- <img class="mr-3 img-fluid" src="<?php ?>" alt="Product 01"> -->
                                    <div class="media-body">
                                        <p class="mt-0 title"><?php echo $food_title;?></p>
                                        <?php echo $food_description;?>
                                    </div>
                                </div>
                            </td>
                            <td>₹<?php echo $food_price;?></td>
                            <td><?php echo $qty;?></td>
                            <td>₹<?php echo $total_amt;?></td>
                        </tr>
                        <!-- <tr>
                            <td>
                                <div class="media">
                                    <img class="mr-3 img-fluid" src="mobile-2.jpg" alt="Product 01">
                                    <div class="media-body">
                                        <p class="mt-0 title">Media heading</p>
                                        Cras sit amet nibh libero, in gravida nulla.
                                    </div>
                                </div>
                            </td>
                            <td>300$</td>
                            <td>2</td>
                            <td>600$</td>
                        </tr> -->
                    </tbody>
                </table>
            </section>

            <section class="balance-info">
                <div class="row">
                    <div class="col-8">
                        <p class="m-0 font-weight-bold"> Note: </p>
                        <p>This reciept is computer generated.</p>
                    </div>
                    <div class="col-4">
                        <table class="table border-0 table-hover">
                            <tr>
                                <td>Sub Total:</td>
                                <td>₹<?php echo $total_amt;?></td>
                            </tr>
                            <tr>
                                <td>Tax:</td>
                                <td>₹<?php echo $tax;?></td>
                            </tr>
                            <tr>
                                <td>Deliver:</td>
                                <td>₹<?php echo $delivery_chrg;?></td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td>Total:</td>
                                    <td>₹<?php echo $final_amt;?></td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Signature -->
                        <div class="col-12">
                            <img src="./images/signature.png" class="img-fluid" alt="">
                            <p class="text-center m-0"> Director Signature </p>
                        </div>
                    </div>
                </div>
            </section>

            <footer>
                <hr>
                <p class="m-0 text-center hidden">
                    <a href="#" id="print" class="btn btn-secondary" onclick="printReceipt()">Print The Invoice</a>
                </p>
                <div class="social pt-3">
                    <span class="pr-2">
                        <i class="fas fa-mobile-alt"></i>
                        <span>0123456789</span>
                    </span>
                    <span class="pr-2">
                        <i class="fas fa-envelope"></i>
                        <span>talk@wowfood.com</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-facebook-f"></i>
                        <span>/WowFood</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-youtube"></i>
                        <span>/WowFood</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-github"></i>
                        <span>/WowFood</span>
                    </span>
                </div>
            </footer>
        </div>
    </div>


</body></html>



<script>

    function printReceipt(){
        // var reciept = document.querySelector('#receipt').innerHTML;
        // var a = window.open('', '', 'height=500, width=500');
        // a.document.write(reciept);
        // a.document.close();
        window.print();
    }

</script>

<?php 
        // check data is passed or not
        // if(isset($_POST['submit'])){

        //     $food = $_POST['title'];
        //     $qty = $_POST['qty'];
        //     $price = $_POST['price'];
        //     $total = $price * $qty;
        //     $order_date = date("Y-m-d h:i:s a"); // order date
        //     $status = "Ordered";  // ordered , on delivery, delivered, canceled

        //     $customer_name = $_POST['full-name'];
        //     $customer_contact = $_POST['contact'];
        //     $customer_email = $_POST['email'];
        //     $customer_address = $_POST['address'];
        //     // save the order in database
        //     // create sql to save the data
            // $sql2 = "INSERT INTO tbl_order SET
            //     food='$food',
            //     price='$price',
            //     qty ='$qty',
            //     total='$total',
            //     order_date='$order_date',
            //     status='$status',
            //     customer_name='$customer_name',
            //     customer_contact='$customer_contact',
            //     customer_email='$customer_email',
            //     customer_address='$customer_address'";

        //     // execute the query
        //     $res2 = mysqli_query($conn, $sql2);

        //     // check whether query executed succesfully or not
        //     if($res2==true){
        //         $_SESSION['order'] = "<div class='success'>Food Order Succesfully</div><br>";
        //         // header("location:".SITEURL."payment_reciept.php");
        //     }
        //     else{
        //         $_SESSION['order'] = "<div class='error'>Failed to Order</div><br>";
        //         header("location:".SITEURL);
        //     }

        // }else{
        //     header("location:".SITEURL);
        // }
    ?>