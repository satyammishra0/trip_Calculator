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
                    session_start();
                    $user_Id = $_SESSION['id'];
                    $fetch_group_query = "SELECT DISTINCT(`group_title`) FROM `groups` WHERE `created_by`='$user_Id';";
                    $fetch_group_response = mysqli_query($conn, $fetch_group_query);
                    while ($fetch_group_result = mysqli_fetch_assoc($fetch_group_response)) {
                    ?>

                        <!-- ---------------------------------- -->
                        <!-- Printing the groups name user is enrolled in -->
                        <!-- ---------------------------------- -->
                        <li class="flex">
                            <ion-icon name="play-skip-forward-circle-sharp"></ion-icon>
                            <?php
                            print_r($fetch_group_result['group_title']);
                            ?>
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
        <div class="wrapper-container grid-center">
            <div class="wrapper">
                <h2>Split Bill</h2>
                <p>Feels best when it is shared 😂😂</p>
                <div class="container" id="topContainer">
                    <div class="title">Spendings</div>
                    <div class="inputContainer">
                        <input onkeyup="calculateBill()" type="text" id="billTotalInput" placeholder="0.00" />
                    </div>
                </div>
                <div class="container">
                    <div class="title">Extras (If any)</div>
                    <div class="inputContainer">
                        <input onkeyup="calculateBill()" type="text" id="tipInput" placeholder="10" />
                    </div>
                </div>
                <div class="container flex-center" id="bottom">
                    <div class="splitContainer">
                        <div class="title">People</div>
                        <div class="controls">
                            <span class="buttonContainer">
                                <button class="splitButton" onclick="increasePeople()">
                                    <span class="buttonText">+</span>
                                </button>
                            </span>
                            <span class="splitAmount" id="numberOfPeople">1</span>
                            <span class="buttonContainer">
                                <button class="splitButton" onclick="decreasePeople()">
                                    <span class="buttonText">-</span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="totalContainer">
                        <div class="title">Total per Person</div>
                        <div class="total" id="perPersonTotal">$0.00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./assets/js/script.js"></script>
    <?php include('../includes/foot.php'); ?>
</body>

</html>