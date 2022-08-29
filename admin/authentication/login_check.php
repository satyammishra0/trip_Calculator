<?php
include('./config.php');

// Checking if the submit btn clicked
if (isset($_POST['submit_login_btn'])) {
    $Email = $_POST['login_email'];
    $Password = $_POST['login_passowrd'];

    // checkin user input field

    // if (strlen($Email) > 0 && strlen($Password) > 0) {

    // Checking the email is email address only...
    if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($Password > 8)) {

            // Fetching data from database
            $query = "SELECT * FROM user_details";
            $response = mysqli_query($conn, $query);

            // $result = mysqli_fetch_array($response);
            while ($result = mysqli_fetch_assoc($response)) {

                //    untill you are getting the result the loop runs
                if ($Email == $result['email'] && $Password == $result['password']) {
                    header('location:../../index.php');
                }
                // Giving back the user about his error through URL
                else {
                    $AccessError = 'Access Denied !! Make Sure you have correct access rights !!';
                    header('location:../index.php?AccessError=' . $AccessError);
                }
            }
        }
        // Giving back the user about his error through URL

    } else {
        $CredentialsError = "Password too short || Invalid mail used !! ";
        header('location:../index.php?CredentialsError' . $CredentialsError);
    }
}


    // Giving back the user about his error through URL
    // else {
    //     $Email_Pattern_Error = "Email is not valid";
    //     header("Location:index.php?Email_Pattern_Error" . $Email_Pattern_Error);
    // }
// }
