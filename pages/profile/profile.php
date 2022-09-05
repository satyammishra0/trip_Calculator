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
    <link rel="stylesheet" href="<?= get_assets('css/profile.css') ?>">

</head>


<body>
    <!-- ---------------------------------- -->
    <!-- Header of the page -->
    <!-- ---------------------------------- -->
    <?php get_component('header') ?>

    <!-- ---------------------------------- -->
    <!-- Displaying the current user logged in (Profile page)  -->
    <!-- ---------------------------------- -->

    <section class="member-suggestion-container">
        <!-- ---------------------------------- -->
        <!-- suggestion about what purpose is group for  -->
        <!-- ---------------------------------- -->
        <section class="select-type" id="select-type">

            <!-- ---------------------------------- -->
            <!-- Displaying the user's first letter  -->
            <!-- ---------------------------------- -->
            <div class="profile-icon flex grid grid-center">
                <p class="grid-center">
                    <?= substr(_name(), 0, 1) ?>
                </p>
            </div>

            <!-- ---------------------------------- -->
            <!-- Displaying the user's Name -->
            <!-- ---------------------------------- -->
            <?php
            $profile_query = "SELECT * FROM `user_details` WHERE `id`='_id()';";
            $profile_response = mysqli_query($conn, $profile_query);
            $profile_result = mysqli_fetch_assoc($profile_response);
            if ($profile_response) {
                // echo "profile e";
                print_r($profile_result);
            }
            ?>

            <form action="">
                <div class="first-container">
                    <table>
                        <tbody>
                            <tr>
                                <td class="bold uppercase">Username :</td>
                                <td>Growupnext satym</td>
                            </tr>

                            <tr>
                                <td class="bold uppercase">User Email :</td>
                                <td>Email@gmail.com</td>
                            </tr>


                            <tr>
                                <td class="bold uppercase ">User Status :</td>
                                <td>Active</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="submit-btn flex-center">
                    <button class="basic-btn">
                        Save
                    </button><button class="basic-btn">
                        Update
                    </button>
                </div>
            </form>
        </section>
    </section>




    <!-- ---------------------------------- -->
    <!-- including foot for important links -->
    <!-- ---------------------------------- -->
    <?php get_component('script'); ?>

    <!-- ---------------------------------- -->
    <!--JS of the page-->
    <!-- ---------------------------------- -->
    <!-- <script src=" <?= get_assets('js/group_create.page.js') ?>">
    </script> -->

</body>

</html>