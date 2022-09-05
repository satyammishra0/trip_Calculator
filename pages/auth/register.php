<?php include_once("../../app.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | Register</title>
    <?php get_component('head') ?>

    <link rel="stylesheet" href="<?= get_assets('css/auth.page.css') ?>">
</head>



<body>

    <div class="form-body">

        <h2>Register</h2>

        <form action="<?= url("register") ?>" method="post" onsubmit="return validate_register_form()">

            <!--Taking user name -->
            <div class="input-group">
                <label for="register-name">Name</label>
                <input type="text" id="register-name" name="register-name">
                <span class="error" id="register-name-error"></span>
            </div>

            <div class="input-group">
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="register-email">
                <span class="error" id="register-email-error"></span>
            </div>

            <div class="input-group">
                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="register-password">
                <span class="error" id="register-password-error"></span>
            </div>


            <button type="submit" name="main_signup_btn" id="main_signup_btn">Create Account</button>

            <p class="account-text">Already have an account <a href="<?= url("login") ?>">Sign In</a></p>

        </form>
    </div>

    <?php get_component('script'); ?>
    <script src="<?= get_assets('js/auth.page.js') ?>"></script>


</body>

</html>