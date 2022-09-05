<?php

function url($str = "")
{
    return APP_URL . $str;
}

function rediract($url)
{
    return header("location:" . $url);
}
function get_component($component, $once = true)
{
    if ($once) {
        include_once APPPATH . "/components/" . $component . ".php";
    } else {
        include APPPATH . "/components/" . $component . ".php";
    }
}


function get_components_assets($file)
{
    return APP_URL . 'components/assets/' . $file;
}
function get_assets($file)
{
    return APP_URL . 'assets/' . $file;
}


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

function authorized_user_only($rediract = true)
{
    // Starting the session here
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Checking if the user has logged in or not
    if (!isset($_SESSION['username'])) {
        if ($rediract) {
            header('location:' . url("login"));
        } else {
            throw_response(400, "Unauthrised User");
        }
    }
}


// get user details from sestion 
function _id()
{
    return $_SESSION['userid'];
}
function _name()
{
    return $_SESSION['username'];
}
