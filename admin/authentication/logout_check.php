<?php
session_start();
if ($_SESSION['username']) {
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    $Session_Logout = "Thank You for visiting Us 😊";
    header('location:index.php?DetailsRequired=' . $Session_Logout);
}
