// script.js

function togglePasswordVisibility() {
    var passwordField = document.getElementById("password-field");
    var passwordToggle = document.querySelector(".password-toggle");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passwordToggle.classList.add("visible");
    } else {
        passwordField.type = "password";
        passwordToggle.classList.remove("visible");
    }
}
