var emailError = document.getElementById("email-error");
var passwordError = document.getElementById("password-error");
var usernameError = document.getElementById("username-error");
var passwordConfirmError = document.getElementById("confirm-password-error");

function emailValidity() {
    var email = document.getElementById("email").value;

    if(email.trim() ===""){
        emailError.innerHTML = "Email cannot be empty";
        return false;                   
    }   
    if (!email.includes("@")) { 
        emailError.innerHTML = "Email must contain @ symbol";
        return false; 
    } 

    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,4}$/; 
    if (!email.match(emailPattern)) {
        emailError.innerHTML = "Invalid email format";
        return false; 
    }   
    emailError.innerHTML = "";
       return true;
}

function passwordValidity() {
    var password = document.getElementById("password").value;   

    if(password.trim() ===""){
        passwordError.innerHTML = "Password cannot be empty";
        return false;                   
    }   
    if (password.length < 6) {
        passwordError.innerHTML = "Password must be at least 6 characters long";
        return false; 
    }   
    var passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    if (!password.match(passwordPattern)) {
        passwordError.innerHTML = "Password must contain letters and numbers";
        return false; 
    }     
    passwordError.innerHTML = "";
       return true; 
}

function usernameValidity() {
    var username = document.getElementById("username").value;   

    if(username.trim() ===""){
        usernameError.innerHTML = "Username cannot be empty";
        return false;                   
    }   
    if (username.length < 3) {
        usernameError.innerHTML = "Username must be at least 3 characters long";
        return false; 
    }   
    var usernamePattern = /^[A-Za-z0-9_]+$/;
    if (!username.match(usernamePattern)) {
        usernameError.innerHTML = "Username can only contain letters, numbers, and underscores";
        return false; 
    }      
    usernameError.innerHTML = "";
       return true;
}

function isPasswordSame() {
    var password = document.getElementById("password").value;   
    var confirmPassword = document.getElementById("confirm-password").value;    

    if (password !== confirmPassword) {
        passwordConfirmError.innerHTML = "Passwords do not match";
        return false; 
    }   
    passwordConfirmError.innerHTML = "";
    return true;
}

function validateForm() {
    if (!emailValidity() || !passwordValidity() || !usernameValidity() || !isPasswordSame()) {
        return false; 
    }
    return true;
}
