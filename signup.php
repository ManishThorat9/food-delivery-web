<?php include_once "./partials-front/menu.php" ?>

<script src="https://kit.fontawesome.com/0777c0d9d6.js" crossorigin="anonymous"></script>

<section class="signup-section">
    <div class="container">
    <form action="./includes/signup.inc.php" class="signup-form" method="post">
                <h1 class="lg-heading text-black">SIGN UP</h1>
                <div class="form-group">
                    <label for="username">Name</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                        <label for="useruid">Username</label>
                        <input type="text" name="useruid" id="useruid" required>
                </div>
                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input type="email" name="useremail" id="useremail" required>
                </div>
                <div class="form-group">
                    <label for="userpwd">Password</label>
                    <input type="password" name="userpwd" id="userpwd" required>
                </div>
                <div class="form-group">
                    <label for="userrepwd">Confirm Password</label>
                    <input type="password" name="userepwd" id="userepwd" required>
                    <p id='signup-error-p' class="error-red">*confirm password does not match</p>
                </div>
                
                <button type="submit" name="submit" class="form-btn">SIGN UP</button>
                <p class="text-grey signup-p">Already have an account? <b><a href="<?php echo SITEURL;?>login.php">login here</a></b>.</p>
            </form>
    </div>
</section>

<?php include_once "./partials-front/footer.php" ?>


<script>

    const signupBtn = document.querySelector('.form-btn');
    const errorP = document.getElementById('signup-error-p');
    var pwd = document.querySelector("#userpwd");
    var repwd = document.querySelector("#userepwd");

    signupBtn.disabled = true;
    signupBtn.classList.add('form-btn-disable');

    repwd.addEventListener('keyup', (e)=>{
        if(repwd.value.length > 0){
            if(repwd.value != pwd.value){
                signupBtn.disabled = true;
                signupBtn.classList.add('form-btn-disable');
                errorP.style.visibility = 'visible';
            }
            else{
                signupBtn.disabled = false;
                signupBtn.classList.remove('form-btn-disable');
                errorP.style.visibility = 'hidden';
            }
        }
        else{
            signupBtn.disabled = true;
            signupBtn.classList.add('form-btn-disable');
            errorP.style.visibility = 'visible';
        }
    })

</script>