<?php
include('./config.php');

// Checking if the submit btn clicked

if (isset($_POST['main_signup_btn'])) {

    // Get the form data user entered
    $userName = $_POST['signup_username'];
    $userEmail = $_POST['signup_email'];
    $userPassword = $_POST['signup_password'];

    // Checking that the lenght is appropriate
    if (strlen($userName) != 0 || strlen($userEmail) != 0 || strlen($userPassword) != 0) {

        // Checking the email
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {

            // Checking the lenght of userPassword
            if (strlen($userPassword) >= 8) {

                // Checking if the mail pre-exists in DB

                $query2 = 'SELECT `email` FROM `user_details`';
                $runQuery2 = mysqli_query($conn, $query2);

                while ($result = mysqli_fetch_array($runQuery2)) {
                    if ($result['email'] == $userEmail) {
                        $signup_MainError = 'User already exists please change your mail';
                        header('location:../index.php?signup_MainError=' . $signup_MainError);
                        exit();
                    }
                }

                // Inserting the data into database
                $query = "INSERT INTO `user_details` (`username`, `email`, `password`) VALUES ( '$userName', '$userEmail', '$userPassword');";
                $response = mysqli_query($conn, $query);
                $signup_Success = 'You have signed up successfully';
                header('location:../index.php?signup_Success=' . $signup_Success);
            }
        }

        // Email wrong error message

        else {
            $signup_EmailError = 'Entered wrong email';
            header('location:../index.php?signup_EmailError=' . $signup_EmailError);
        }
    }

    // Returnig if there is any error
    else {
        $signup_DetailsError = 'Please fill the fields';
        header('location:../index.php?signup_DetailsError=' . $signup_DetailsError);
    }
}

// Giving back the user about his error through URL
else {

    $signup_MainError = 'Please make sure you filled data correctly';
    header('location:../index.php?signup_MainError=' . $signup_MainError);
}
