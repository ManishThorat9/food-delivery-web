<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
        <style>

            body{
                background: #bcc8f5;
            }

            .box{
                border:none;
                border-radius: 50px;
                background: #bcc8f5;
                box-shadow:  9px 9px 18px #9aa4c9,
                            -9px -9px 18px #deecff;
            }

            .box input[type="text"], .box input[type="password"]{
                background: transparent;
                border: 1px solid black;
                padding: 2%; 
                text-align: center;
                border-radius: 50px;
                display: inline-block;
                margin: 1% auto; 
            }

            .box input[type="submit"]{
                
                border-radius: 50px;
                background: linear-gradient(145deg, #c9d6ff, #a9b4dd);
                box-shadow:  9px 9px 18px #9aa4c9,
                            -9px -9px 18px #deecff;
                padding: 10px;
                border: none;
                width: 50%;
                display: inline-block;
                margin: 10px auto;
                cursor: pointer;
                color: black;
            }

            
            .box input[type="submit"]:hover{
                border-radius: 50px;
                background: linear-gradient(145deg, #a9b4dd, #c9d6ff);
                box-shadow:  9px 9px 18px #9aa4c9,
                            -9px -9px 18px #deecff;
               
            }

            .box input[type="submit"]:active{
                border-radius: 50px;
                background: #bcc8f5;
                box-shadow: inset 9px 9px 18px #9aa4c9,
                            inset -9px -9px 18px #deecff;
               
            }

            .msg{
                display: inline-block;
                width: 100%;
                margin: 20px auto;
            }

        </style>
    </head>

    <body>
        
        <div class="login box">
            <h1 class="text-center">LOGIN</h1>
            <br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo "<span class='msg'>".$_SESSION['login']."</span>";
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo "<span class='msg'>".$_SESSION['no-login-message']."</span>";
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
            <input type="text" name="username" placeholder="Enter Username" required><br><br>
            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->

            <p class="text-center">Created By - <a href="#">Advance Learner</a></p>
        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        // $username = $_POST['username'];
        // $password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div><br>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            // header('location:'.SITEURL.'admin/');
            echo "<script>location.href = '".SITEURL."admin/' </script>";
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div><br>";
            //REdirect to HOme Page/Dashboard
            // header('location:'.SITEURL.'admin/login.php');
            echo "<script>location.href = '".SITEURL."admin/login.php' </script>";
        }


    }

?>