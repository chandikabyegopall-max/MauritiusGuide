<?php
session_start();
include 'includes/db_connect.php';
?>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Password Form</title>
    <link rel="stylesheet" href="formstyle2.css">
</head>
<body>
    <div class="container">
        <form action="processNewPassword.php" method="POST"> 
            <h1>Create New Password</h1>

            <div class="form-input">                 
                <label for="email">Email</label>
                <input type="email" id="email" name="useremail" placeholder="Enter your email address" onkeyup="emailValidity()" required>
                <span id="email-error"></span>  
            </div>

            <div class="form-input">
                <label for="new-password">New Password</label>
                <input type="password" id="password" name="newpassword" placeholder="Enter your new password" onkeyup="passwordValidity()" required>
                <span id="password-error"></span> 
            </div>

            <div class="form-input">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirmpassword" placeholder="Confirm password" onkeyup="isPasswordSame()" required>
                <span id="confirm-password-error"></span>
            </div>

            <button type="submit" class="btn" onclick="return validateForm()">Submit</button>

            <div class="altermethods">
                <p>Don't want to change password? <a href="signInForm.php">Back to login</a></p>
            </div>
        </form>
    </div>
    <script src="form.js"></script>
</body>
</html
