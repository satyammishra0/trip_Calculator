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
