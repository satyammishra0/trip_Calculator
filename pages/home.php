<?php
include('../app.php');

authorized_user_only();


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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | Home</title>
    <?php get_component('head') ?>
    <link rel="stylesheet" href="<?= get_assets('css/home.page.css') ?>">
</head>

<body>

    <!-- ---------------------------------- -->
    <!-- including header for the page -->
    <!-- ---------------------------------- -->
    <?php get_component('header') ?>

    <div class="main-container">

        <!-- left side menu and group list -->

        <div class="menu-container">
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="<?= url() ?>" class="menu-link">
                        <ion-icon name="home-outline"></ion-icon>
                        Home
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?= url('group/create') ?>" class="menu-link">
                        <ion-icon name="person-add-outline"></ion-icon>
                        Create Group
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= url('group/join') ?>" class="menu-link">
                        <ion-icon name="people-circle-outline"></ion-icon>
                        Join Group
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= url('login?action=logout') ?>" class="menu-link">
                        <ion-icon name="log-out-outline"></ion-icon>
                        Logout
                    </a>
                </li>

            </ul>

            <hr>

            <span class="list-heading">Groups</span>
            <div class="group-list-contaner">
                <div class="scroll-y">
                    <div class="group-list">

                        <?php

                        $userId = _id();
                        $groups_query = "SELECT groups.* FROM `group_members` LEFT JOIN `groups` ON groups.id = group_members.group_id WHERE group_members.user_id = '$userId' AND groups.status = 1;";

                        $groups = fetch_all_data($groups_query);
                        if ($groups) :
                            foreach ($groups as $group) :

                        ?>
                                <a href="<?= url('group/' . $group['group_name']) ?>">
                                    <div class="group-item">
                                        <div class="group-icon">
                                            <p><?= substr($group['group_title'], 0, 1) ?></p>
                                        </div>
                                        <h3><?= $group['group_title'] ?></h3>
                                    </div>
                                </a>

                        <?php endforeach;
                        endif; ?>

                    </div>
                </div>
            </div>
        </div>




        <?php
        if ($GROUP != null) :
        ?>
            <!-- main Group Selection -->

            <div class="group-area">
                <div class="group-bill-container" id="bill-container">
                    <div class="bill-list">

                        <?php

                        function biil_member_view($billId)
                        {
                            $q = "SELECT user_details.username as username FROM `bill_members` LEFT JOIN user_details ON user_details.id = bill_members.user_id WHERE bill_members.bill_id = $billId ";

                            $bill_members = fetch_all_data($q);
                            if ($bill_members) :
                                foreach ($bill_members as $item) :
                        ?>
                                    <li>
                                        <div class="group-icon">
                                            <p><?= substr($item['username'], 0, 1) ?></p>
                                        </div>
                                    </li>
                                <?php

                                endforeach;
                            endif;
                        }



                        $q = "SELECT user_bills.*, user_details.username as username FROM `user_bills` LEFT JOIN user_details ON user_details.id = user_bills.created_by  WHERE `group_id` = " . $GROUP['id'] . " ORDER BY `added_on` DESC  LIMIT 15";

                        $BILLS = fetch_all_data($q);

                        if ($BILLS) :
                            $BILLS = array_reverse($BILLS);
                            foreach ($BILLS as $bill) :

                                ?>
                                <div class="bill-item-container">
                                    <div class="bill-item <?= $bill['created_by'] == _id() ? "" : "bill-item-left" ?>">
                                        <h2>
                                            ₹ <?= $bill['amount'] ?>
                                        </h2>

                                        <p><small>Remark:</small> <?= $bill['remark'] ?></p>
                                        <p><small>Create By:</small> <?= $bill['username'] ?></p>
                                        <p><small>Date & Time:</small> <?= date('d-m-Y \\a\\t h:i:s  ', $bill['added_on']) ?></p>

                                        <ul>
                                            <?php biil_member_view($bill['id']) ?>
                                        </ul>

                                    </div>
                                </div>

                        <?php endforeach;
                        endif;




                        ?>


                    </div>
                </div>


                <div class="group-info">
                    <center>
                        <div class="group-logo-icon">
                            <p><?= substr($GROUP['group_title'], 0, 1) ?></p>
                        </div>
                        <h3><?= $GROUP['group_title'] ?></h3>
                        <p style="margin-bottom:2% ;">Created by : <?= $GROUP['admin'] ?></p>
                        <div class="group-info-btn ">
                            <button class="basic-button"><a class="anchor" href="javascript:add_new_bill()">Add bill</a></button>
                            <button class="basic-button"><a class="anchor" href="javascript:open_bill_history()">History</a></button>
                        </div>
                    </center>
                    <hr class="mtb-2">
                    <span class="list-heading" style="color:var(--primary-color); font-weight:600;">Members</span>
                    <ul class="member-list">
                        <?php
                        $GROUP_MEMBERS = [];
                        $user_Id = $_SESSION['id'];
                        $fetch_member_query = "SELECT user_details.id as userid ,user_details.username FROM `group_members` LEFT JOIN `user_details` ON user_details.id = group_members.user_id WHERE group_members.group_id = " . $GROUP['id'] . ";";
                        $fetch_member_response = mysqli_query($conn, $fetch_member_query);
                        while ($member = mysqli_fetch_assoc($fetch_member_response)) :
                            array_push($GROUP_MEMBERS, $member);
                        ?>
                            <li class="flex">
                                <ion-icon name="person-circle-sharp"></ion-icon>
                                <?= $member['username'] ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>






                <dialog id="bill_calculator">

                    <ion-icon onclick="close_dialog()" name="close-sharp" class="dialog-close-btn"></ion-icon>

                    <div class="wrapper">
                        <h2>Split Bill</h2>
                        <p>Feels best when it is shared 😂😂</p>
                        <div class="container" id="topContainer">
                            <div class="inputContainer">
                                <div class="title">Spendings</div>
                                <input onkeyup="splitAmountInput(this)" type="number" id="billInput" placeholder="₹ 0.00" />
                            </div>
                            <br>
                            <div class="inputContainer">
                                <p class="title">Remark</p>
                                <input type="text" id="bill-remark" />
                            </div>
                        </div>

                        <div style="margin-top: 4%;" id="bottom">
                            <div class="title">
                                <div class="select-member flex flex-center">
                                    <p class="text"> Members</p>
                                    <button class="select-btn" onclick="split_with_all_member(this)" id="select_all_btn">Select all</button>
                                </div>
                                <hr>
                                <div class="member-list-container">
                                    <div id="member_list_ui">
                                        <?php
                                        foreach ($GROUP_MEMBERS as $member) :
                                            if ($member['userid'] == $user_Id) continue;
                                        ?>
                                            <div class="member-list-item flex-center">
                                                <div class="flex flex-center">
                                                    <p class="user-logo">
                                                        <?= substr($member['username'], 0, 1) ?>
                                                    </p>
                                                    <p class="text">
                                                        <?= $member['username'] ?>
                                                    </p>
                                                </div>

                                                <button class="select-btn split-bill-member-btn" onclick="split_with_member('<?= $member['userid'] ?>',this)">
                                                    Add
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class=" split-bill-div flex flex-center">

                                    <div>
                                        <p>Per Person:</p>
                                        <p class="sub-heading" id="per_person">₹ 0</p>
                                    </div>
                                    <a class="basic-button" href="javascript:split_bill()">Split</a>

                                </div>
                            </div>


                        </div>
                    </div>
                </dialog>

                <dialog id="group_payment_history">




                    <?php
                    $group_id = $GROUP['id'];
                    $user_id = _id();

                    $GIVE_MEMBER = [];
                    $TAKE_MEMBER = [];
                    $GIVE_AMOUNT = 0;
                    $TAKE_AMOUNT = 0;

                    foreach ($GROUP_MEMBERS as $m) {
                        $GIVE_MEMBER[$m['userid']] = 0;
                    }

                    $TAKE_MEMBER = $GIVE_MEMBER;

                    $TRANSACTIONS = fetch_all_data("SELECT bill_members.*, user_bills.created_by as payby FROM `bill_members` LEFT JOIN user_bills ON user_bills.id = bill_members.bill_id WHERE user_bills.group_id =  '$group_id'");


                    if ($TRANSACTIONS) {

                        foreach ($TRANSACTIONS as $item) {
                            if ($item['payby'] == _id()) {
                                $TAKE_MEMBER[$item['user_id']] = $TAKE_MEMBER[$item['user_id']] + $item['amount'];
                            } else {
                                if ($item['user_id'] == _id()) {
                                    $GIVE_MEMBER[$item['payby']] = $GIVE_MEMBER[$item['payby']] + $item['amount'];
                                }
                            }
                        }
                    }

                    foreach ($GROUP_MEMBERS as $item) {

                        if ($item['userid'] == _id()) continue;
                        if ($GIVE_MEMBER[$item['userid']] > $TAKE_MEMBER[$item['userid']]) {
                            $GIVE_AMOUNT = $GIVE_AMOUNT + $GIVE_MEMBER[$item['userid']] - $TAKE_MEMBER[$item['userid']];
                        }
                        if ($GIVE_MEMBER[$item['userid']] < $TAKE_MEMBER[$item['userid']]) {
                            $TAKE_AMOUNT = $TAKE_AMOUNT + $TAKE_MEMBER[$item['userid']] - $GIVE_MEMBER[$item['userid']];
                        }
                    }

                    ?>
                    <ion-icon onclick="close_bill_history()" style="color:var(--primary-color);" name="close-sharp" class="dialog-close-btn"></ion-icon>

                    <div class="payment_history_head">
                        <span>Payment History</span>

                        <ul class="payment_history_links">
                            <li>
                                <a href="javascript:open_drawer(1,0)" class="drawer-btn active">History</a>
                            </li>
                            <li>
                                <a href="javascript:open_drawer(2,1)" class="drawer-btn">You Give ₹ <?= $GIVE_AMOUNT ?></a>
                            </li>
                            <li>
                                <a href="javascript:open_drawer(3,2)" class="drawer-btn">You Got ₹ <?= $TAKE_AMOUNT ?></a>
                            </li>
                        </ul>
                    </div>

                    <div class="payment_history_container">

                        <div class="payment_history_list" id="payment_history_0">
                            <?php

                            foreach ($GROUP_MEMBERS as $item) :

                                if ($item['userid'] == _id()) continue;


                                $css_class = "";
                                $amount = 0;
                                if ($GIVE_MEMBER[$item['userid']] > $TAKE_MEMBER[$item['userid']]) {
                                    $css_class = "red";
                                    $amount = $GIVE_MEMBER[$item['userid']] - $TAKE_MEMBER[$item['userid']];
                                }
                                if ($GIVE_MEMBER[$item['userid']] < $TAKE_MEMBER[$item['userid']]) {
                                    $css_class = "green";
                                    $amount = $TAKE_MEMBER[$item['userid']] - $GIVE_MEMBER[$item['userid']];
                                }

                                if ($amount == 0) continue;

                            ?>
                                <div class="payment_history_item <?= $css_class ?>">
                                    <div class="flex" style="gap:10px">
                                        <div class="group-icon">
                                            <p><?= substr($item['username'], 0, 1) ?></p>
                                        </div>

                                        <p><?= $item['username'] ?></p>
                                    </div>

                                    <p class="payment">₹ <?= $amount ?></p>
                                </div>

                            <?php endforeach; ?>
                        </div>




                    </div>


                </dialog>




                <input type="hidden" id="group_id" value="<?= $GROUP['id'] ?>">
                <input type="hidden" id="group_name" value="<?= $GROUP['group_name'] ?>">
                <input type="hidden" id="group_member_list" value='<?= json_encode($GROUP_MEMBERS,)  ?>'>
                <input type="hidden" id="group_admin_id" value="<?= $GROUP['created_by']; ?>">
                <input type="hidden" id="user_id" value="<?= $user_Id ?>">

            </div>
        <?php
        endif;
        ?>



    </div>




    <!-- Dialogs -->


    <?php get_component('script');
    if ($GROUP) : ?>
        <script type="text/javascript" src="<?= get_assets('js/home.page.js') ?>"></script>
        <script type="text/javascript" src="<?= get_assets('js/home_bill.page.js') ?>"></script>

    <?php endif; ?>
</body>

</html>