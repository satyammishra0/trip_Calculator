<?php
// Starting the session here
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ---------------------------------- -->
    <!-- including head for important metas -->
    <!-- ---------------------------------- -->
    <?php include('./includes/head.php'); ?>

    <!-- ---------------------------------- -->
    <!-- Title of the page -->
    <!-- ---------------------------------- -->
    <title>Trip Calculator</title>

    <!-- ---------------------------------- -->
    <!-- CSS for the page -->
    <!-- ---------------------------------- -->

    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/utility.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>

<body>
    <!-- ---------------------------------- -->
    <!-- Header of the page -->
    <!-- ---------------------------------- -->

    <!-- ---------------------------------- -->
    <!-- Designing the modal of the page-->
    <!-- ---------------------------------- -->

    <section class="complete-body grid grid-center">
        <div class="box">
            <div class="icon grid grid-center">

                <ion-icon name="flame"></ion-icon>
                <h2>Hello,<?php
                            // Getting the username
                            echo $_SESSION['username'];
                            ?>
                </h2>
                <h2>Thank you for sing in with us</h2>
                <div class="btns flex-center">
                    <button><a href="">Create Group</a></button>
                    <button><a href="">Join Group</a></button>
                </div>
            </div>
        </div>
    </section>


    <!-- ---------------------------------- -->
    <!-- including foot for important links -->
    <!-- ---------------------------------- -->
    <?php include('./includes/foot.php'); ?>

</body>

</html>