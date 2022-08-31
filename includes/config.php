<?php


// This is to provide credentials for the database
// Set 1 for local server 
// Set 2 for Global server

$num = 0;
switch ($num) {
    case 0:
        $DB_HOST = "localhost";
        $DB_USER = "root";
        $DB_PASS = "";
        $DB_NAME = "trip_calculator";
        break;
    case 1:
        $DB_HOST = "localhost";
        $DB_USER = "id18787957_satyammishra007";
        $DB_PASS = "dr!DDDaREW-0L?2I";
        $DB_NAME = "id18787957_college_data";
        break;
}

// Making connection to the database 

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Checking if database connected or not 
if ($conn) {
    // echo "succesfully connected";
} else {
    // echo "not connected";
}


