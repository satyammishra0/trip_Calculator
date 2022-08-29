<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ---------------------------------- -->
    <!-- including head for important metas -->
    <!-- ---------------------------------- -->
    <?php include('../includes/head.php'); ?>


    <!-- ---------------------------------- -->
    <!-- Title of the page -->
    <!-- ---------------------------------- -->
    <title>Trip Calculator</title>

    <!-- ---------------------------------- -->
    <!-- CSS for the page -->
    <!-- ---------------------------------- -->

    <link rel="stylesheet" type="text/css" href="../assets/css/global.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/utility.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/login_page.css">
</head>

<body>

    <section class="whole-body">

        <!-- ---------------------------------- -->
        <!-- Container for the whole form -->
        <!-- ---------------------------------- -->

        <div class="container">
            <h1 class="main-heading" id="container_heading">Login Form</h1>
            <div class="task_btn">
                <button id="login_btns">Login</button>
                <button id="signup_btns"> Sign Up</button>
            </div>

            <!-- ---------------------------------- -->
            <!-- Login form -->
            <!-- ---------------------------------- -->

            <form action="./authentication/login_check.php" method="post" id="login_form" onsubmit="return loginvalidateForm()">
                <!--Taking user email  -->
                <label for="Email">Email</label>
                <input type="email" name="login_email" required pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" placeholder="Please Enter Email" id="login_email">
                <small>Please Enter Email</small>
                <div class="login-error-logs" id="login_mail_error"></div>

                <!--Taking user password  -->
                <label for="Password">Password</label>
                <input type="password" name="login_passowrd" required placeholder="Please enter your password" id="login_password">
                <small>passowrd must be atleast 8 characters</small>
                <div class="login-error-logs" id="login_password_error"></div>

                <!--Submit btn  -->
                <button type="submit" id="main_login_btn" name="submit_login_btn">Login</button>
                <div class="login-error-logs" id="login_error"></div>

                <!-- Printing the user mistake he made -->
                <?php

                // Function to print error on page
                function errors_from_validation($val)
                {
                    echo '<div class="login-error-logs" id="login_error">';
                    echo $val;
                    echo "</div>";
                }
                // Cehcking the errors if done

                if (isset($_GET['Email_Pattern_Error']) || isset($_GET['CredentialsError']) || isset($_GET['AccessError']) || isset($_GET['signup_Success'])) {
                    errors_from_validation($_GET['AccessError']);
                    errors_from_validation($_GET['Email_Pattern_Error']);
                    errors_from_validation($_GET['signup_Success']);
                    errors_from_validation($_GET['CredentialsError']);
                }
                if (isset($_GET['signup_Success'])) {
                    echo '<div class="login-error-logs" id="login_error" style="color:green !important">';
                    echo $_GET['signup_Success'];
                    echo "</div>";
                }

                ?>
            </form>

            <!-- ---------------------------------- -->
            <!-- sign up form -->
            <!-- ---------------------------------- -->
            <form action="./authentication/signup_check.php" method="post" id="signup_form" onsubmit="return signupvalidateForm()">
                <!-- <form method="post" id="signup_form" onsubmit="return signupvalidateForm()"> -->

                <!--Taking user name -->
                <label for="name">Name</label>
                <input type="text" id="signup_username" name="signup_username" placeholder=" Please Enter Name">
                <small>Please Enter Name</small>
                <div class="login-error-logs" id="signup_name_error"></div>

                <!--Taking user email  -->
                <label for="Email">Email</label>
                <input type="text" id="signup_email" name="signup_email" placeholder="Please Enter Email">
                <small>Please Enter Email</small>
                <div class="login-error-logs" id="signup_mail_error"></div>

                <label for="password">Password</label>
                <input type="text" id="signup_password" name="signup_password" placeholder="Please Enter Password">
                <small>passowrd must be atleast 8 characters</small>
                <div class="login-error-logs" id="signup_password_error"></div>

                <button type="submit" name="main_signup_btn" id="main_signup_btn">Create account</button>
                <div class="login-error-logs" id="signup_error"></div>

                <?php

                // Function to print error on page
                function errors_form_validation($val)
                {
                    echo '<div class="login-error-logs" id="login_error">';
                    echo $val;
                    echo "</div>";
                }
                if (isset($_GET['signup_DetailsError'])) {
                    errors_from_validation($_GET['signup_DetailsError']);
                }
                ?>
            </form>
        </div>
    </section>

    <!-- ---------------------------------- -->
    <!-- Page js -->
    <!-- ---------------------------------- -->
    <script src="./assets/js/login_check.js"></script>
    <script src="./assets/js/signup_check.js"></script>

    <!-- ---------------------------------- -->
    <!-- including head for important metas -->
    <!-- ---------------------------------- -->
    <?php include('../includes/foot.php'); ?>
</body>

</html>