<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>

        <?php 

            //CHeck whether id is set or not
            if(isset($_GET['id'])){
                // get id 
                $id = $_GET['id'];

                // get order detail based on this id
                // sql query to get details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                // execute query
                $res = mysqli_query($conn, $sql);
                // Count rows
                $count = mysqli_num_rows($res);
                if($count == 1){
                    // get details
                    $row = mysqli_fetch_assoc($res);

                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else{
                    // header('location:'.SITEURL."admin/manage-order.php");
                    echo "<script>location.href = '".SITEURL."admin/manage-order.php' </script>";
                }
            }
            else{
                //REdirect to Manage ORder PAge
                // header('location:'.SITEURL.'admin/manage-order.php');
                echo "<script>location.href = '".SITEURL."admin/manage-order.php' </script>";
            }

        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><?php echo $food;?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>$<?php echo $price;?></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty;?>" ></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="full-name" value="<?php echo $customer_name;?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="contact" value="<?php echo $customer_contact;?>"></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="email" name="email" value="<?php echo $customer_email;?>"></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="address" cols="30" rows="5"><?php echo $customer_address;?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Update Order" class="btn-secondary"></td>
                </tr>
            </table>

        </form>

        <?php 

            // CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit'])){
                $qty = $_POST['qty'];
                $total = $price * $qty;

                $status = $_POST['status'];
                
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // update the values
                $sql2 = "UPDATE tbl_order SET 
                    qty='$qty',
                    total='$total',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    WHERE id=$id
                ";

                // execute query
                $res2 = mysqli_query($conn, $sql2);

                // check update or not
                if($res2 == true){
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    // header('location:'.SITEURL.'admin/manage-order.php');
                    echo "<script>location.href = '".SITEURL."admin/manage-order.php' </script>";
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    // header('location:'.SITEURL.'admin/manage-order.php');
                    echo "<script>location.href = '".SITEURL."admin/manage-order.php' </script>";
                }
            }

        ?>

    </div>
</div>




<?php include('partials/footer.php'); ?>