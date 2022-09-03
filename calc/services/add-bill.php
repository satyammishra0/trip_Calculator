<?php

// including neccessary files
include('../../includes/config.php');
include('../../includes/functions.php');


// Checking the user authentication
authorized_user_only('../../admin');

// creating the default inputs
$AMOUNT = 0;
$MEMBERS = [];
$REMARKS = "";
$USER_ID = $_SESSION['id'];
$TIME = time();

// Checking the user inputs

if (!isset($_POST['amount']) || !$_POST['amount'] > 0) {
    throw_response(4001, ' Amount should atleast be greater than 1');
}

if (!isset($_POST['members']) || empty($_POST['members'])) {
    throw_response(4002, 'Please select atlease 1 member to split the bill');
}

if (!isset($_POST['remark']) || empty($_POST['remark'])) {
    $REMARKS = $_POST['remark'];
}

// Santitizing the user input

$AMOUNT = mysqli_escape_string($conn, $_POST['amount']);
$MEMBERS = $_POST['members'];
$REMARKS = mysqli_escape_string($conn, $_POST['remark']);

// Converting member JSON string to array

$MEMBERS = json_decode($MEMBERS, true);


if (!count($MEMBERS) >= 2) {
    throw_response(4002, 'Please select atlease 1 member to split the bill');
}

// Inserting the data into DB
$bill_query = "INSERT INTO `user_bills`(`amount`, `remark`, `created_by`, `status`, `added_on`) VALUES ('$AMOUNT','$REMARKS','$USER_ID','1','$TIME')";
$bill_response = mysqli_query($conn, $bill_query);

if (mysqli_affected_rows($conn) > 0) {

    // Get bill id

    $BILL_ID = mysqli_insert_id($conn);

    // insert query form member in this group
    $member_query_1 = "INSERT INTO `bill_members`( `bill_id`, `user_id`, `added_on`) VALUES ";
    $member_query_2 = " ";

    for ($i = 0; $i < count($MEMBERS); $i++) {
        $member = $MEMBERS[$i];
        if ($i == count($MEMBERS) - 1) {
            $member_query_2 .= "('$BILL_ID','$member','$TIME')";
        } else {
            $member_query_2 .= "('$BILL_ID','$member','$TIME'),";
        }
    }

    $member_query = $member_query_1 . $member_query_2;

    // Run the members query of the group to DB
    $member_query_res = mysqli_query($conn, $member_query);

    if ($member_query_res) {
        throw_response(200, 'Bill entered successfully');
    } else {
        $bill_delete_query = "DELETE FROM `user_bills` WHERE `id`='$BILL_ID'";
        mysqli_query($conn, $bill_delete_query);
        throw_response(4004, 'Some error occurred while creating the bill');
    }
}
