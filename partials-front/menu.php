<?php include("config/constants.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="shortcut icon" href="<?php echo SITEURL?>images/icon/logo2.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body oncontextmenu="return false;">
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL?>index.php" title="Logo">
                    <img src="./images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SITEURL?>index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL?>foods.php">Food</a></li>
                    <li><a href="<?php echo SITEURL?>contact.php">Contact</a></li>

                    <?php 

                        if(isset($_SESSION['userid'])){
                            echo '<li><a href="'.SITEURL.'profile.php">Profile</a></li>';
                            echo '<li><a href="'.SITEURL.'includes/logout.inc.php">Logout</a></li>';
                        }
                        else{
                            echo '<li><a href="'.SITEURL.'login.php">Login</a></li>';
                            echo '<li><a href="'.SITEURL.'signup.php">SignUp</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="clear-fix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->