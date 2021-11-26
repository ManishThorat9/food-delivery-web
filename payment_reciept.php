<?php include("./config/constants.php");?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <title>Payment Reciept</title>
</head>
<body>
    <h1>Order Reciept</h1>
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



    <button id="rzp-button1">Pay</button>
</body>
</html>


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