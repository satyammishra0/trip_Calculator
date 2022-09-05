<?php include_once("../../app.php");

// Starting the session here
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = "";
$pass = "";
$email_error = "";
$pass_error = "";

if (isset($_POST['login-email']) && isset($_POST['login-password'])) {

    // get value from submited form
    $email = $_POST['login-email'];
    $pass  = $_POST['login-password'];

    // check empty values
    $email_error = $email == "" ? "Please enter your email address" : "";
    $pass_error = $pass == "" ? "Please enter your password" : "";

    // snitize value with mysql
    $email = mysqli_escape_string($conn, $email);
    $pass = mysqli_escape_string($conn, $pass);

    if (!empty($email) && !empty($pass)) {
        // get user from database
        $q = "SELECT * FROM `user_details` WHERE `email` = '$email'";
        $user = fetch_data($q);

        if ($user) {
            if ($user['status'] == 1) {
                if (password_verify($pass, $user['password'])) {

                    $_SESSION['userid'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['useremail'] = $user['useremail'];

                    rediract(url());
                } else {
                    $pass_error  = "You entered wrong password";
                }
            } else {
                $email_error = "Your account has been blocked or deleted";
            }
        } else {
            $email_error = "Your entered email address is not registered";
        }
    }
}


// Logout 

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == "logout") {

        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['useremail']);

        rediract(url('login'));
    }
}

if (isset($_SESSION['username'])) rediract(url());






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | Sign In</title>
    <?php get_component('head') ?>

    <link rel="stylesheet" href="<?= get_assets('css/auth.page.css') ?>">
</head>



<body>

    <div class="form-body">

        <h2>Sign In</h2>

        <form action="<?= url("login") ?>" method="post" onsubmit="return validate_login_form()">


            <div class="input-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="login-email" value="<?= $email ?>">
                <span class="error" id="login-email-error"><?= $email_error ?></span>
            </div>

            <div class="input-group">
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="login-password" value="<?= $pass ?>">
                <span class="error" id="login-password-error"><?= $pass_error ?></span>
            </div>

            <a class="right-text" href="<?= url('forget-password') ?>">Forget Password</a>
            <br><br>
            <button type="submit">Login Account</button>

            <p class="account-text">Don't hava an Account <a href="<?= url("register") ?>">Register</a></p>

        </form>
    </div>

    <?php get_component('script'); ?>

    <script src="<?= get_assets('js/auth.page.js') ?>"></script>

</body>

</html>