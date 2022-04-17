<?php include_once "./partials-front/menu.php" ?>

<script src="https://kit.fontawesome.com/0777c0d9d6.js" crossorigin="anonymous"></script>


<section class="login-section">
    <div class="container">
    <form action="./includes/login.inc.php" class="login-form" method="post">
                <h1 class="lg-heading text-black">LOGIN</h1>
                <div class="form-group">
                    <label for="username">Username / Email</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="userpwd">Password</label>
                    <input type="password" name="userpwd" id="userpwd" required>
                </div>
                
                <button type="submit" name="submit" class="form-btn">LOGIN</button>

                <p class="text-grey login-p">Don't have an account? <a href="<?php echo SITEURL;?>signup.php">Create an account</a>.</p>
            </form>
    </div>
</section>


<?php 
    if(isset($_GET['m'])){
        $m = $_GET['m'];

        if($m == "userNotFound"){
            echo "<script>alert('user not found');</script>";
        }
        elseif($m == "wrongPwd"){
            echo "<script>alert('Wrong Password');</script>";
        }

    }
?>

<?php include_once "./partials-front/footer.php" ?>