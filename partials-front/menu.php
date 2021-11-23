<?php include("config/constants.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.html" title="Logo">
                    <img src="./images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SITEURL?>index.php">Home</a></li>
                    <li><a href="<?php echo SITEURL?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL?>foods.php">Food</a></li>
                    <li><a href="<?php echo SITEURL?>contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="clear-fix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->