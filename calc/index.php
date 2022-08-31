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

    <!--  -->
    <?php include '../includes/header.php'; ?>
    <div class="wrapper-container">
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

    <script type="text/javascript" src="./assets/js/script.js"></script>
    <?php include('../includes/foot.php'); ?>
</body>

</html>