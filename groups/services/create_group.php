<?php
// Starting the session here
session_start();

// Checking if the user has logged in or not
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // header('location:./admin');
}
include('../../includes/config.php');
include('../../includes/functions.php');

$category = "";
$name = "";
$member_list = [];

if (!isset($_POST['category']) && !isset($_POST['name']) && !isset($_POST['member_list'])) {
    throw_response(4001, 'Data fields empty');
}

if (!isset($_POST['category']) || empty($_POST['category'])) {
    throw_response(4002, 'Group category not found');
}

if (!isset($_POST['name']) || empty($_POST['name'])) {
    throw_response(4003, 'Group name can not be empty');
}

if (!isset($_POST['member_list']) || empty($_POST['member_list'])) {
    throw_response(4004, 'No member selected');
}

$member_list = mysqli_escape_string($conn, $_POST['member_list']);

try {
    $member_list = json_decode($_POST['member_list']);
} catch (\Throwable $th) {
    throw_response(4004, 'No member selected' . $th);
}



// Checking if there is atleast one member
if (!is_array($member_list) && count($member_list) == 0) {
    throw_response(4004, 'Select atlease one member');
}
// sanitize user data

$name = mysqli_escape_string($conn, $_POST['name']);
$category = mysqli_escape_string($conn, $_POST['category']);

// Starting to inserting data to DB
$time = time();
$created_by = $_SESSION['id'];
$group_name = $name . rand(1000, 9999);
$group_title = $name;

// Query to insert data of groups in DB
$query = "INSERT INTO `groups`( `group_title`, `group_name`, `group_icon`, `created_by`, `status`, `added_on`)
                       VALUES ('$group_title','$group_name','','$created_by','1','$time')";

$response = mysqli_query($conn, $query);


if (!$response) {
    throw_response(4005, 'Somthing wrong while creating your group');
}

// Get Group ID
$GROUP_ID = mysqli_insert_id($conn);

// insert query form member in this group
$member_query_1 = "INSERT INTO `group_members`(`group_id`, `user_id`, `type`, `status`, `added_on`) VALUES ";
$member_query_2 = "('$GROUP_ID','$created_by','1','1','$time')";

for ($i = 0; $i < count($member_list); $i++) {
    $member = $member_list[$i];
    $member_query_2 .= ",('$GROUP_ID','$member','0','1','$time')";
}

$member_query = $member_query_1 . $member_query_2;

$member_query_result = mysqli_query($conn, $member_query);
if ($member_query_result) {
    throw_response(200, 'Group created successfully', ["group_id" => $group_name]);
} else {
    throw_response(4005, 'Somthing went wrong');
    $group_delete_query = "DELETE FROM `groups` WHERE `id`='$GROUP_ID'";
    mysqli_query($conn, $group_delete_query);
}
