<?php
// Starting the session here
include_once('../app.php');
authorized_user_only();

$userId = _id();
$q = "SELECT groups.* FROM `group_members` LEFT JOIN `groups` ON groups.id = group_members.group_id WHERE group_members.user_id = '$userId' AND groups.status = 1;";

if (row_exists($q)) rediract(url());


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To <?= APP_NAME ?></title>

    <?php get_component('head') ?>

    <link rel="stylesheet" href="<?= get_assets("css/style.css") ?>">
</head>

<body>
    <!-- ---------------------------------- -->
    <!-- Designing the modal of the page-->
    <!-- ---------------------------------- -->

    <section class="complete-body grid grid-center">
        <div class="box">
            <div class="icon grid grid-center">
                <!-- <ion-icon name="contacts"></ion-icon> -->
                <ion-icon name="people"></ion-icon>
                <!-- <ion-icon name="flame"></ion-icon> -->
                <h2>Hello,<?php
                            // Getting the username
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            }
                            ?>
                </h2>
                <h2>Thank you for sing in with us</h2>
                <div class="btns flex-center">
                    <button><a href="./groups/create_group.php">Create Group</a></button>
                    <button><a href="">Join Group</a></button>
                </div>
            </div>
        </div>
    </section>


    <!-- ---------------------------------- -->
    <!-- including foot for important links -->
    <!-- ---------------------------------- -->
    <?php get_component('script'); ?>



</body>

</html>