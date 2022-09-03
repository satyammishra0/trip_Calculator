<?php
function throw_response($result, $message, $data = null)
{
    $response = [];
    if ($result == 200) {
        $response['result'] = true;
    } else {
        $response['result'] = false;
    }

    $response['code'] = $result;
    $response['message'] = $message;

    if ($data != null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit();
}

function authorized_user_only($url = null)
{

    // Starting the session here
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Checking if the user has logged in or not
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        if ($url != null) {
            header('location:' . $url);
        }
    }
}
