function signup_wrong_cerdentials(val, signup_statement) {
  val.innerHTML = signup_statement;
  return false;
}

function signupvalidateForm() {
  let signup_username = document.getElementById("signup_username").value;
  let signup_email = document.getElementById("signup_email").value;
  let signup_password = document.getElementById("signup_password").value;
  let signup_error = document.getElementById("signup_error");
  let signup_mail_error = document.getElementById("signup_mail_error");
  let signup_password_error = document.getElementById("signup_password_error");
  let signup_name_error = document.getElementById("signup_name_error");
  if (signup_email != 0 && signup_password != 0 && signup_username != 0) {
    if (signup_email.includes("@")) {
      let password_Length = Number(signup_password.length);
      if (password_Length > 8) {
        console.log("password check");
      }
      // Validate password
      else {
        signup_wrong_cerdentials(
          signup_password_error,
          "Password must be 8 characters long"
        );
        return false;
      }
    }
    // Validating email
    else {
      signup_wrong_cerdentials(
        signup_mail_error,
        "Please enter a valid email id"
      );
      return false;
    }
  }
  // Giving error to user for filling the details
  else if (signup_email == 0 && signup_password == 0 && signup_username == 0) {
    signup_wrong_cerdentials(signup_error, "Please fill the details");
    return false;
  }

  // For username
  else if (signup_username == 0) {
    signup_wrong_cerdentials(signup_name_error, "Please fill your name");
    return false;
  }

  // For username
  else if (signup_email == 0) {
    signup_wrong_cerdentials(signup_mail_error, "Please fill your email");
    return false;
  }

  // For username
  else if (signup_password == 0) {
    signup_wrong_cerdentials(
      signup_password_error,
      "Please fill your password"
    );
    return false;
  }

  // Else part
  else {
    signup_wrong_cerdentials(signup_error, "Some error occured please recheck");
    return false;
  }
}
