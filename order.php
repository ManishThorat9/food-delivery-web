<?php include("partials-front/menu.php");?>


    <!-- food search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="./images/menu-pizza.jpg" alt="Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h3>Food Title</h3>
                        <p class="food-price">$2.3</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" 
                        min=1 value="1" required>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Delivary Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder ="E.g. Jhon Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder ="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder ="E.g.Jhon@web.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea style="resize: none;" name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="text-center">
                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
    <!-- food search  Section Ends Here -->

<?php include("partials-front/footer.php");?>