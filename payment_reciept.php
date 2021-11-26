<?php include("./config/constants.php");?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
    <!-- link custom css -->
    <link rel="stylesheet" href="./css/payment-style.css">
    <title>Invoice</title>
  </head>
  <body>

    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="./images/logo.png" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Invoice</p>
                    </div>
                    <div class="position-relative">
                        <p>Invoice No. <span>XXX</span></p>
                    </div>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <div class="col-7">
                            <p>Supplier,</p>
                            <h2>Store Name</h2>
                            <p class="address">676 Antila, <br> Ambani Ilaka 1234,
                            <br>Vestavia Hills AL</p>
                            <div class="txn mt-2">
                                TXN:XXXXXX
                            </div>
                        </div>
                        <div class="col-5">
                            <p>Client,</p>
                            <h2>Aryan Nipane</h2>
                            <p class="address">676 Antila, <br> Ambani Ilaka 1234,
                            <br>Vestavia Hills AL</p>
                            <div class="txn mt-2">
                                TXN:XXXXXX
                            </div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Payment Method:
                                <span>BKash</span>
                            </p>
                            <p>Order Number: &nbsp; <span>#868</span></p>
                        </div>
                        <div class="col-5">
                            <p>Delivar Date: <span>10-04-2021</span></p>
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
                                    <img class="mr-3 img-fluid" src="./images/menu-momo.jpg" alt="Product 01">
                                    <div class="media-body">
                                        <p class="mt-0 title">Media heading</p>
                                        Cras sit amet nibh libero, in gravida nulla.
                                    </div>
                                </div>
                            </td>
                            <td>200$</td>
                            <td>1</td>
                            <td>200$</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <img class="mr-3 img-fluid" src="./images/burger.jpg" alt="Product 01">
                                    <div class="media-body">
                                        <p class="mt-0 title">Media heading</p>
                                        Cras sit amet nibh libero, in gravida nulla.
                                    </div>
                                </div>
                            </td>
                            <td>300$</td>
                            <td>2</td>
                            <td>600$</td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<button id="rzp-button1">Pay</button>
<script>
var options = { 
       "key": "rzp_test_iwQImoVfBMGY7L", // Enter the Key ID generated from the Dashboard    
       "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise    
       "currency": "INR",
       "name": "Wow Food",
       "description": "Test Transaction",
       "image": "https://wilcity.com/wp-content/uploads/2018/12/sample-logo-design-png-3.png",
    //    "order_id": "order_Ef80WJDPBmAeNt", //Pass the `id` obtained in the previous step    
    //    "account_id": "acc_Ef7ArAsdU5t0XL",
       "handler": function (response){
                //    alert(response.razorpay_payment_id);        
                //    alert(response.razorpay_order_id);        
                //    alert(response.razorpay_signature);    
                console.log(response);
        }
};

var rzp1 = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
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
        //     $sql2 = "INSERT INTO tbl_order SET
        //         food='$food',
        //         price='$price',
        //         qty ='$qty',
        //         total='$total',
        //         order_date='$order_date',
        //         status='$status',
        //         customer_name='$customer_name',
        //         customer_contact='$customer_contact',
        //         customer_email='$customer_email',
        //         customer_address='$customer_address'";

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