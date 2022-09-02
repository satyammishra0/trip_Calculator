<?php include('config.php'); ?>

<header class="header flex flex-center">
    <h1>Trip Calculator</h1>
    <nav>
        <ul class="nav flex">
            <li><a href="#">Create group</a></li>
            <li><a href="">Join Group</a></li>
            <li class="grid-center">
                <p>
                    <?=
                    // session_start();
                    (isset($_SESSION['username'])) ? substr($_SESSION['username'], 0, 1) : "S";

                    ?>
                </p>
            </li>
        </ul>
    </nav>
</header>