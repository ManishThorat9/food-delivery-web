<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php 
    include("./config/constants.php");

    if($_GET['price'] && $_GET['id']){
        $total_price = $_GET['price'] * 100;
        $food_id = $_GET['id'];

        echo '<script>
        options = { 
                        "key": "rzp_test_iwQImoVfBMGY7L", // Enter the Key ID generated from the Dashboard    
                        "amount": '.$total_price.', // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise    
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
                            location.href = "'.SITEURL.'payment_reciept.php?id='.$food_id.'";
                            // location.href = "'.SITEURL.'confirm.php";
                        }
                    };
        
                    var rzp1 = new Razorpay(options);
                    // document.getElementById("rzp-button1").onclick = function(e){rzp1.open();e.preventDefault();}
                    rzp1.open();
        </script>';
    }
    else{
        die();
    }

?>