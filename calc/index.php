<?php
include('../includes/config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('location:../admin/index.php');
}

$GROUP = null;

$group_user_name = isset($_GET['group']) && $_GET['group'] != null ? $_GET['group'] : "";

if (!empty($group_user_name)) {
    $group_user_name = mysqli_escape_string($conn, $group_user_name);

    $fetch_group_query = "SELECT groups.* , user_details.username as admin FROM `groups` LEFT JOIN user_details ON groups.created_by = user_details.id WHERE `group_name` ='$group_user_name' AND `status` = 1;";
    $fetch_group_response = mysqli_query($conn, $fetch_group_query);

    if (mysqli_num_rows($fetch_group_response) > 0) {
        $GROUP = mysqli_fetch_assoc($fetch_group_response);
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <?php include('../includes/head.php') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" type="text/css" />
    <title>Tip Calculator</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/utility.css">
</head>

<body>

    <!-- ---------------------------------- -->
    <!-- including header for the page -->
    <!-- ---------------------------------- -->
    <?php include '../includes/header.php'; ?>

    <!-- ---------------------------------- -->
    <!-- dividign screen into tow halves -->
    <!-- ---------------------------------- -->
    <div class="main-container grid">

        <!-- ---------------------------------- -->
        <!-- Group description side for groups names -->
        <!-- ---------------------------------- -->
        <div class="groups-desc">

            <!-- ---------------------------------- -->
            <!-- Important actions user may need instantly-->
            <!-- ---------------------------------- -->
            <div class="main-headings">
                <ul>
                    <li><a href="../index.php">
                            <ion-icon name="home-sharp"></ion-icon>Home
                        </a>
                    </li>
                    <li><a href="../groups/create_group.php">
                            <ion-icon name="add-circle-sharp"></ion-icon>Add Group
                        </a>
                    </li>
                    <li><a href="../index.php">
                            <ion-icon name="play-skip-back-circle-sharp"></ion-icon>Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ---------------------------------- -->
            <!-- Group names user is included in -->
            <!-- ---------------------------------- -->

            <div class="enrolled-groups">
                <h3>More Groups </h3>
                <ul>

                    <!-- ---------------------------------- -->
                    <!-- Fetching groups from database -->
                    <!-- ---------------------------------- -->

                    <?php
                    $user_Id = $_SESSION['id'];
                    $fetch_group_query = "SELECT groups.* FROM `group_members` LEFT JOIN `groups` ON groups.id = group_members.group_id WHERE group_members.user_id = '$user_Id' AND groups.status = 1;";
                    $fetch_group_response = mysqli_query($conn, $fetch_group_query);
                    while ($group = mysqli_fetch_assoc($fetch_group_response)) {
                    ?>

                        <!-- ---------------------------------- -->
                        <!-- Printing the groups name user is enrolled in -->
                        <!-- ---------------------------------- -->
                        <li class="flex">
                            <a href="http://localhost/GROWUPNEXT/Trip_Calculator/calc/?group=<?= $group['group_name']  ?>">
                                <ion-icon name="play-skip-forward-circle-sharp"></ion-icon>
                                <?=
                                $group['group_title'];
                                ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>


        <!-- ---------------------------------- -->
        <!-- Calculator side -->
        <!-- ---------------------------------- -->
        <div class="wrapper-container grid">
            <div class="calulator-popup grid-center">

            </div>

            <?php
            if ($GROUP != null) :
            ?>
                <div class="group-info">
                    <h3><?= $GROUP['group_title'] ?></h3>
                    <p style="margin-bottom:2% ;">Created by : <?= $GROUP['admin'] ?></p>
                    <div class="group-info-btn grid-center">
                        <button class="basic-button"><a class="anchor" href="javascript:add_new_bill()">Add bill</a></button>
                    </div>
                    <h4>Members</h4>
                    <ul>
                        <?php
                        $GROUP_MEMBERS = [];
                        $user_Id = $_SESSION['id'];
                        $fetch_member_query = "SELECT user_details.id as userid ,user_details.username FROM `group_members` LEFT JOIN `user_details` ON user_details.id = group_members.user_id WHERE group_members.group_id = " . $GROUP['id'] . ";";
                        $fetch_member_response = mysqli_query($conn, $fetch_member_query);
                        while ($member = mysqli_fetch_assoc($fetch_member_response)) :
                            array_push($GROUP_MEMBERS, $member);
                        ?>
                            <li class="flex">
                                <ion-icon name="person-circle-sharp"></ion-icon><?= $member['username'] ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </div>


    <input type="hidden" id="group_id" value="<?= $GROUP['id'] ?>">
    <input type="hidden" id="group_name" value="<?= $GROUP['group_name'] ?>">
    <input type="hidden" id="group_member_list" value="<?= json_encode($GROUP_MEMBERS) ?>">
    <input type="hidden" id="group_admin_id" value="<?= $GROUP['created_by']; ?>">
    <input type="hidden" id="user_id" value="<?= $user_Id ?>">


    <!-- Dialogs -->

    <dialog id="bill_calculator">
        <div class="wrapper">
            <h2>Split Bill</h2>
            <p>Feels best when it is shared 😂😂</p>
            <div class="container" id="topContainer">
                <div class="title">Spendings</div>
                <div class="inputContainer">
                    <input onkeyup="calculateBill()" type="text" id="billTotalInput" placeholder="0.00" />
                </div>
            </div>

            <div class="container flex-center" id="bottom">
                <div class="title">Members
                </div>
                <div class="totalContainer">
                    <button onclick="select_all_member()">Select all</button>
                    <div>
                        <ul>
                            <?php
                            foreach ($GROUP_MEMBERS as $member) :
                            ?>
                                <li class="flex">
                                    <?php echo  "<ion-icon id='tick_mark_icon' name='checkmark-done-circle-sharp'></ion-icon>" . $member['username'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </dialog>

    <script type="text/javascript" src="./assets/js/script.js"></script>
    <script type="text/javascript" src="./assets/js/bill_add.js"></script>
    <?php include('../includes/foot.php'); ?>
</body>

</html>