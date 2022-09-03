<?php
include_once('../../app.php');
authorized_user_only();

// default vars
$userid = _id();
$username = _name();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>

    <?php get_component('head') ?>
    <link rel="stylesheet" href="<?= get_assets('css/group_create.page.css') ?>">
</head>


<body>
    <!-- ---------------------------------- -->
    <!-- Header of the page -->
    <!-- ---------------------------------- -->
    <?php get_component('header') ?>

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
                <button class="basic-button"><a href="javascript:create_group()">Create Group</a></button>
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
                    <button class="basic-button" onclick="make_group()">Create Group</button>

                    <!-- Error if blank -->
                    <small id="group-member-error"></small>
        </section>
    </section>




    <!-- ---------------------------------- -->
    <!-- including foot for important links -->
    <!-- ---------------------------------- -->
    <?php get_component('script'); ?>

    <!-- ---------------------------------- -->
    <!--JS of the page-->
    <!-- ---------------------------------- -->
    <script src="<?= get_assets('js/group_create.page.js') ?>"></script>

</body>

</html>