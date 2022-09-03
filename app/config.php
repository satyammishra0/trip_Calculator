<?php


// APP configractions
define('APP_URL', "http://localhost/root/abhaymishra/trip/");
define('APP_NAME', "Trip Calc");
define('APP_MODE', "TEST"); // for production use PRO
define("APP_VERSION", "v0.1.0");


// 
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "trip_calculator";

if (APP_MODE == "PRO") {
    $DB_HOST = "localhost";
    $DB_USER = "id18787957_satyammishra007";
    $DB_PASS = "dr!DDDaREW-0L?2I";
    $DB_NAME = "id18787957_college_data";
}
