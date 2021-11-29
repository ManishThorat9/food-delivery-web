<?php include("./config/constants.php");?>

<?php 

    // check submit btn is clicked or not 
    if(isset($_POST['submit'])){

        // get value of payment mode
        $payment_mode = $_POST['payment'];
        $id = $_POST['id'];

        echo "<script>alert('$payment_mode');</script>";

        // check payment mode is cod or online
        if($payment_mode == "cod"){
            // insert data and goto print reciept page;
            header('location:'.SITEURL.'payment_reciept.php?id='.$id);
            echo "<script>console.log('COD');</script>";
        }
        else{
            header('location:'.SITEURL.'order.php');
            echo "<script>console.log('Online Payment');</script>";
        }
    }

?>