<?php

// connect to database
global $conn;
$conn =  mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

function query($sql)
{
    global $conn;
    return mysqli_query($conn, $sql);
}

function fetch_all_data($sql, $error = null)
{
    global $conn;
    $res = mysqli_query($conn, $sql);

    if ($res) {

        if (mysqli_num_rows($res) > 0) {

            $data = [];
            while ($a = mysqli_fetch_assoc($res)) {
                array_push($data, $a);
            }
            // return an associative array
            return $data;
        } else {
            if ($error != null) {
                $error('no record found.');
            }
        }
    } else {
        if ($error != null) {
            $error(mysqli_error($conn));
        }
    }
}

function fetch_data($sql, $error = null)
{
    global $conn;
    $res = mysqli_query($conn, $sql);

    if ($res) {

        if (mysqli_num_rows($res) > 0) {

            // return an associative array
            return mysqli_fetch_assoc($res);
        } else {
            if ($error != null) {
                $error('no record found.');
            }
        }
    } else {
        if ($error != null) {
            $error(mysqli_error($conn));
        }
    }
}



function row_exists($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) return true;
    return false;
}
