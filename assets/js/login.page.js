let signup_btn = document.getElementById("signup_btns");
let login_btn = document.getElementById("login_btns");
let login_form = document.getElementById("login_form");
let signup_form = document.getElementById("signup_form");

let container_heading = document.getElementById("container_heading");
signup_btn.addEventListener("click", () => {
  container_heading.innerText = "Sign Up ";
  login_form.style.display = "none";
  signup_form.style.display = "block";
});

login_btn.addEventListener("click", () => {
  container_heading.innerText = "Log In ";
  login_form.style.display = "block";
  signup_form.style.display = "none";
});

// Login check

function worng_cerdentials(val, statement) {
  val.innerHTML = statement;
  return false;
}

function loginvalidateForm() {
  let login_email = document.getElementById("login_email").value;
  let login_password = document.getElementById("login_password").value;
  let login_error = document.getElementById("login_error");
  let mail_error = document.getElementById("login_mail_error");
  let password_error = document.getElementById("login_password_error");

  //Check if the fields are empty
  if (login_email != 0 && login_password != 0) {
    if (login_email.includes("@")) {
      let password_Length = Number(login_password.length);
      if (password_Length > 8) {
        return true;
      }
    }

    // Checking mail requirments
    else {
      worng_cerdentials(mail_error, "Please check the mail address");
      return false;
    }
  }

  // If the fields are empty return false
  else if (login_email == 0 && login_password == 0) {
    worng_cerdentials(login_error, "Please fill the details");
    return false;
  }

  // If the email fields is empty return false
  else if (login_email == 0) {
    worng_cerdentials(mail_error, "Please enter your mail");
    return false;
  }

  // If the email fields is empty return false
  else if (login_password == 0) {
    worng_cerdentials(password_error, "Please enter your password");
    return false;
  }
}

// // It's here to clear the data of URL after the '?' if there
// setTimeout(() => {
//   window.history.pushState(
//     "",
//     "Page Title",
//     window.location.href.split("?")[0]
//   );

//   // window.location.replace(window.location.href.split("?")[0])
// }, 3000);

// ==========================================

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
