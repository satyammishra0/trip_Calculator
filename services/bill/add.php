<?php
include_once '../../app.php';

authorized_user_only(false);

// creating the default inputs
$AMOUNT = 0;
$GROUP_ID = 0;
$MEMBERS = [];
$REMARKS = "";
$USER_ID = $_SESSION['id'];
$TIME = time();

// Checking the user inputs

if (!isset($_POST['group_id']) || empty($_POST['group_id'])) {
    throw_response(4000, 'Something went wrong');
}

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
$GROUP_ID = mysqli_escape_string($conn, $_POST['group_id']);

// Converting member JSON string to array

$MEMBERS = json_decode($MEMBERS, true);


if (!count($MEMBERS) >= 2) {
    throw_response(4002, 'Please select atlease 1 member to split the bill');
}

// Inserting the data into DB
$bill_query = "INSERT INTO `user_bills`(`group_id`,`amount`, `remark`, `created_by`, `status`, `added_on`) VALUES ('$GROUP_ID','$AMOUNT','$REMARKS','$USER_ID','1','$TIME')";
$bill_response = mysqli_query($conn, $bill_query);

if (mysqli_affected_rows($conn) > 0) {

    // Get bill id

    $BILL_ID = mysqli_insert_id($conn);

    // insert query form member in this group
    $member_query_1 = "INSERT INTO `bill_members`( `bill_id`, `user_id`,`amount`, `paid`, `pay_date`, `added_on`) VALUES ";
    $member_query_2 = " ";

    $per_member_amount = $AMOUNT / count($MEMBERS);
    $per_member_amount = round($per_member_amount);
    for ($i = 0; $i < count($MEMBERS); $i++) {
        $member = $MEMBERS[$i];
        if ($i == count($MEMBERS) - 1) {
            $member_query_2 .= "('$BILL_ID','$member','$per_member_amount','0','0','$TIME')";
        } else {
            $member_query_2 .= "('$BILL_ID','$member','$per_member_amount','0','0','$TIME'),";
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
