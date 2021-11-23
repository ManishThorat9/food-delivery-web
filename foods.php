<?php include("partials-front/menu.php");?>


    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="food-search.html" method="post">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

    <!-- food menu  Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="./images/menu-pizza.jpg" alt="pizza" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- food menu  Section Ends Here -->
    
<?php include("partials-front/footer.php");?>