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
    <title>Sign In Form</title>
    <link rel="stylesheet" href="formstyle2.css">
</head>
<body>
    <div class="container">
        <!-- Form now submits to a PHP handler -->
        <form action="processSignIn.php" method="POST"> 
            <h1>Sign in</h1>

            <div class="form-input">                 
                <label for="email">Email</label>
                <input type="email" id="email" name="useremail" placeholder="Enter your email address" onkeyup="emailValidity()" required>
                <span id="email-error"></span>   
            </div>

            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" id="password" name="userpassword" placeholder="Enter your password" onkeyup="passwordValidity()" required>
                <span id="password-error"></span> 
            </div>
            
            <div class="forgot-password">
                <a href="newPasswordForm.php">Forgot Password?</a>    
            </div>        
               
            <button type="submit" class="btn" onclick="return validateForm()">Sign in</button>
            
            <div class="altermethods">
                <p>Don't have an account? <a href="signUpForm.php">Sign Up here</a></p>
            </div>
        </form>
    </div> 
    <script src="form.js"></script>  
</body>
</html>
