<?php

// Include db_connect file
require "db_connect.php";

// Define variables and initialize with empty values
$username = $password = $email = $id = "";
$username_err = $password_err = $email_err = $register_err = $lg_email_err = $lg_password_err = $success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //when user clicks Login button
    if (isset($_POST["login"])) { //user logging in
        require "login.php";
    } //when user clicks SignUp button
    elseif (isset($_POST["register"])) { //user registering
        require "register.php";
    }
}

require "header.php";
?>

<body>
<div class="background-image"></div>
<main class="container">
    <div class="row">

        <div class="dark_background col-xs-6">
            <section class="dark_form" id="dark_form_1">
                <h1>Don’t have an account?</h1>
                <hr>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
                <button id="signup" class="btn btn_blue uppercase">Sign up</button>
            </section>
        </div>

        <div class="dark_background col-xs-6">
            <section class="dark_form" id="dark_form_2">
                <h1>Have an account?</h1>
                <hr>
                <br>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <button id="login" class="btn btn_blue uppercase">Login</button>
            </section>

            <div class="light_background">
                <section class="light_form" id="login_form">
                    <h1>Login</h1>
                    <img src="images/logo.png" alt="Logo" class="logo">
                    <br>
                    <hr>
                    <br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div <?php echo (!empty($lg_email_err)) ? "has-error" : ""; ?>>
                            <label for="email">Email<span>*</span><span class="icon"><img src="images/icon1.png"></span></label>
                            <input type="email" name="email" id="email" value="<?= $email ?>">
                            <span class="help-block"><?= $lg_email_err ?></span>
                        </div>
                        <div <?php echo (!empty($lg_password_err)) ? "has-error" : ""; ?>>
                            <label for="password">Password<span>*</span><span class="icon"><img src="images/icon2.png"></span></label>
                            <input type="password" name="password" id="password"><br>
                            <span class="help-block"><?= $lg_password_err ?></span>
                            <span><?= $register_err ?></span>
                            <span id="success_msg"><?= $success_msg ?></span>
                        </div>
                        <br>
                        <button class="btn uppercase btn_orange" name="login">Login</button>
                        <a href="#" id="forgot">Forgot?</a>
                    </form>
                </section>

                <section class="light_form" id="register_form">
                    <h1>Sign Up</h1>
                    <img src="images/logo.png" alt="Logo" class="logo">
                    <br>
                    <hr>
                    <br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div <?php echo (!empty($username_err)) ? "has-error" : ""; ?>>
                            <label for="username">Name<span>*</span><span class="icon"><img
                                            src="images/icon3.png"></span></label>
                            <input type="text" name="username" id="username" value="<?= $username ?>">
                            <span class="help-block"><?= $username_err ?></span>
                        </div>
                        <div <?php echo (!empty($email_err)) ? "has-error" : ""; ?>>
                            <label for="email">Email<span>*</span><span class="icon"><img src="images/icon1.png"></span></label>
                            <input type="email" name="email" id="email" value="<?= $email ?>">
                            <span class="help-block"><?= $email_err ?></span>
                        </div>

                        <div <?php echo (!empty($password_err)) ? "has-error" : ""; ?>>
                            <label for="password">Password<span>*</span><span class="icon"><img src="images/icon2.png"></span></label>
                            <input type="password" name="password" id="password" value="<?= $password ?>">
                            <span class="help-block"><?= $password_err ?></span>
                        </div>

                        <br>
                        <button class="btn uppercase btn_orange" name="register">Sign Up</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</main>

<?php
require "footer.php";
?>

<script src="animation.js"></script>
</body>
</html>


