<?php
// Starting the session here
session_start();

// Checking if the user has logged in or not
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userid = $_SESSION['id'];
} else {
    // header('location:./admin');
}
include('../includes/config.php');
?>

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

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/utility.css">
    <link rel="stylesheet" href="./assets/css/create_group.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <!-- ---------------------------------- -->
    <!-- Header of the page -->
    <!-- ---------------------------------- -->
    <?php include('../includes/header.php') ?>

    <!-- ---------------------------------- -->
    <!-- Collecting information for the group  -->
    <!-- ---------------------------------- -->

    <section class="member-suggestion-container">
        <!-- ---------------------------------- -->
        <!-- suggestion about what purpose is group for  -->
        <!-- ---------------------------------- -->
        <section class="select-type" id="select-type">
            <h2>Create a group</h2>

            <p>Your group is where you and your friends can track your trip.</p>

            <!-- Category Restaurant -->
            <div class="trip-options-box flex-center">
                <div class="trip-name flex">
                    <ion-icon name="restaurant-sharp"></ion-icon>
                    <a href="">Restaurant</a>
                </div>
                <div class="trip-name-add-btn">
                    <button onclick="customize_group('restaurant')">+</button>
                </div>
            </div>

            <!-- Category Trip -->
            <div class="trip-options-box flex-center">
                <div class="trip-name flex">
                    <ion-icon name="train-sharp"></ion-icon>
                    <a href="">Trip</a>
                </div>
                <div class="trip-name-add-btn">
                    <button onclick="customize_group('trip')">+</button>
                </div>
            </div>

            <!-- College Spending -->
            <div class="trip-options-box flex-center">
                <div class="trip-name flex">
                    <ion-icon name="school-sharp"></ion-icon>
                    <a href="">College Expenses</a>
                </div>
                <div class="trip-name-add-btn">
                    <button onclick="customize_group('college_expenses')">+</button>
                </div>
            </div>

            <!-- Error if blank -->
            <small id="group-category-error"></small>
        </section>

        <!-- ---------------------------------- -->
        <!-- Customizing the group   -->
        <!-- ---------------------------------- -->

        <section class="customize-group" id="customize-group">
            <div class="group-icon" id="group-icon flex-center">
                <div class="group-icon-name" id="group-icon-name">S</div>
            </div>
            <h2>Customize your Group</h2>

            <p>Give your group a personality with a name. You can always change it later.</p>

            <div class="group-name">
                <label for="Group name">Group name</label>

                <br><input type="text" name="group-name" placeholder="Please Enter Group Name" id="group-name">
                <small id="name-error"></small>
            </div>
            <div class="final-add-btn">
                <button><a href="javascript:create_group()">Create Group</a></button>
            </div>
        </section>


        <!-- ---------------------------------- -->
        <!-- Adding persons in the group   -->
        <!-- ---------------------------------- -->

        <section class="customize-group customize-group-member" id="customize-group-member">
            <h2>Create group by adding you know<h2>
                    <?php
                    $query = "SELECT * FROM `user_details` WHERE `id` NOT IN ('$userid');";
                    $response = mysqli_query($conn, $query);
                    while ($result = mysqli_fetch_assoc($response)) {
                    ?>
                        <!-- User Details -->
                        <div class="member-box flex flex-center">
                            <div class="user flex">

                                <!-- User Symbol -->
                                <!-- <div class="usersymbol flex-center"><?php echo substr($result['username'], 0, 1); ?></div> -->
                                <ion-icon name="person-circle-sharp"></ion-icon>
                                <!-- User Name -->
                                <div class="username"><?= ($result['username']); ?></div>
                            </div>
                            <div class="add-btn flex-center">
                                <button id="add-btn"><a onclick="add_user('<?= $result['id'] ?>',this)">Add</a></button>
                            </div>
                        </div>
                    <?php } ?>
                    <button onclick="make_group()">Create Group</button>

                    <!-- Error if blank -->
                    <small id="group-member-error"></small>

        </section>
    </section>




    <!-- ---------------------------------- -->
    <!-- including foot for important links -->
    <!-- ---------------------------------- -->
    <?php include('../includes/foot.php'); ?>

    <!-- ---------------------------------- -->
    <!--JS of the page-->
    <!-- ---------------------------------- -->
    <script src="./assets/js/create_group.js"></script>

</body>

</html>