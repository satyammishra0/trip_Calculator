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

// It's here to clear the data of URL after the '?' if there
setTimeout(() => {
  window.history.pushState(
    "",
    "Page Title",
    window.location.href.split("?")[0]
  );

  // window.location.replace(window.location.href.split("?")[0])
}, 3000);
