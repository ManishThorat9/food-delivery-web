<?php include("./partials-front/menu.php")?>
<script src="https://kit.fontawesome.com/0777c0d9d6.js" crossorigin="anonymous"></script>
<section class="contact-us">
    <div class="container">

        <div class="contact-wrapper">
            <div class="hotel-address">
                <div class="address-group">
                <i class="fas fa-map-marker-alt fa-3x text-red" aria-hidden="true"></i>
                <h2 class="text-grey md-heading">location</h2>
                <p class="text-grey">#2661 Janakpuri Colony, town name, city name</p>
                </div>
                <div class="address-group">
                    <i class="far fa-envelope fa-3x text-red" aria-hidden="true"></i>
                    <h2 class="text-grey md-heading">EMAIL</h2>
                    <p class="text-grey">nipanearyan@mycompany.com</p>
                </div>
                <div class="address-group">
                    <i class="fas fa-phone-square-alt fa-3x text-red" aria-hidden="true"></i>
                    <h2 class="text-grey md-heading">CALL</h2>
                    <p class="text-grey"><a class="text-grey" href="tel:8657295928">+910101010101</a></p>
                </div>

                <img src="./images/contact-form-image2.jpg" alt="">

            </div>
            <form action="" class="form" method="post">
                <h1 class="lg-heading text-black">Contact Us</h1>
                <p class="text-grey">Let us know your questions. Suggestions and concerns by filling out the contact form below.</p>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="message" class="message-opt">Message</label>
                    <textarea name="message" id="message" required></textarea>
                </div>
                <button type="submit" name="submit" class="form-btn">Submit</button>
            </form>
        </div>
        
    </div>
</section>

<?php

    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $owner_mail = "nipaneeducation@gmail.com";
        $to = $owner_mail;
        $subject = "Customer Question";
        $msg = "Message from $username is \n $message \n details of $username \n phone : $phone \n email : $email";
        $headers = "From : $from";

        // mail($to, $subject, $msg, $headers);


        // sql query to insert data in table
        $sql = "INSERT INTO tbl_contact SET
        username = '$username',
        phone = '$phone',
        email = '$email',
        message = '$message'";

        // execute query
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res == true){
            echo "
            <script>

                alert('Thank You For Connecting With Us...');

                location.href = '".SITEURL."';

            </script>";
        }
        else{
            echo "
            <script>

                alert('Failed to send message Try connecting Later...');

                location.href = '".SITEURL."';

            </script>";
        }


    }

?>

<?php include("./partials-front/footer.php")?>