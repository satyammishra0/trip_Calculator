function validate_login_form() {
  console.log("validating login form");
  let email = document.getElementById("login-email"),
    pass = document.getElementById("login-password");
  email = email ? email.value : "";
  pass = pass ? pass.value : "";

  let email_error = document.getElementById("login-email-error"),
    pass_error = document.getElementById("login-password-error");

  email_error.innerText =
    email == "" ? "Please enter a valid email address" : "";
  pass_error.innerText = pass == "" ? "Please enter your password" : "";

  console.log(email, pass);
  if (email != "" && pass != "") return true;

  return false;
}

// function validate_register_form() {
//   let name = document.getElementById("register-name"),
//     email = document.getElementById("register-email"),
//     pass = document.getElementById("register-password");

//   name = name ? name.value : "";
//   email = email ? email.value : "";
//   pass = pass ? pass.value : "";

//   let email_error = document.getElementById("register-email-error"),
//     pass_error = document.getElementById("register-password-error"),
//     name_error = document.getElementById("register-name-error");

//   let name_check = false,
//     email_check = false,
//     pass_check = false;

//   if (name == "" || name.length < 3) {
//     name_error.innerText = "Please enter a valid minimum 3 letter name";
//   } else {
//     name_check = true;
//   }

//   if (
//     email == "" ||
//     !String(email)
//       .toLowerCase()
//       .match(
//         /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
//       )
//   ) {
//     email_error.innerText = "Please enter a valid email address";
//   } else {
//     email_check = true;
//   }

//   if (pass == "" || pass.length < 5) {
//     pass_error.innerText = "Please enter atleats 5 letter password";
//   } else {
//     pass_check = true;
//   }

//   if (name_check && email_check && pass_check) return true;
//   return false;
// }
