<?php
 session_start();
//$connection=mysqli_connect("localhost:3307","root","");
 //$db=mysqli_select_db($connection,'demo');
include '../connection.php';
$msg=0;
if(isset($_POST['sign']))
{

    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $location=$_POST['district'];
    $address=$_POST['address'];

    $pass=password_hash($password,PASSWORD_DEFAULT);
    $sql="select * from admin where email='$email'" ;
    $result= mysqli_query($connection, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        // echo "<h1> already account is created </h1>";
        // echo '<script type="text/javascript">alert("already Account is created")</script>';
        echo "<h1><center>Account already exists</center></h1>";
    }
    else{
    
    $query="insert into admin(name,email,password,location,address) values('$username','$email','$pass','$location','$address')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {
        // $_SESSION['email']=$email;
        // $_SESSION['name']=$row['name'];
        // $_SESSION['gender']=$row['gender'];
       
        header("location:signin.php");
        // echo "<h1><center>Account does not exists </center></h1>";
        //  echo '<script type="text/javascript">alert("Account created successfully")</script>'; -->
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
        
    }
}


   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formstyle.css">
    <script src="signin.js" defer></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Register</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form" onsubmit="return validateForm()">
            <span class="title">Register</span>
            <br>
            <br>
            <div class="input-group">
                <label for="username">Name</label>
                <input type="text" id="username" name="username" >
                <div class="error" id="username-error"></div> <!-- Error message container -->
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" >
                <div class="error" id="email-error"></div>
            </div>
            <label class="textlabel" for="password">Password</label> 
             <div class="password">
                <input type="password" name="password" id="password" >
                <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>
                <div class="error" id="password-error"></div>
             </div>
            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" >
                <div class="error" id="address-error"></div>
            </div>
            <div class="input-field">
                <label for="district">Provinces:</label>
                <select id="district" name="district" style="padding:10px;" >
                    <option value="Alberta">Alberta</option>
                    <option value="British Columbia">British Columbia</option>
                        <option value="Manitoba">Manitoba</option>
                        <option value="New Brunswick">New Brunswick</option>
                        <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                        <option value="Nova Scotia">Nova Scotia</option>
                        <option value="Ontario">Ontario</option>
                        <option value="Prince Edward Island">Prince Edward Island</option>
                        <option value="Quebec">Quebec</option>
                        <option value="Saskatchewan">Saskatchewan</option>
                        <option value="Northwest Territories">Northwest Territories</option>
                        <option value="Nunavut">Nunavut</option>
                        <option value="Yukon">Yukon</option>

                </select>  
            </div>
            <button type="submit" name="sign">Register</button>
            <div class="login-signup" >
                <span class="text">Already a member?
                    <a href="signin.php" class="text login-link">Login Now</a>
                </span>
            </div>
        </form>
    </div>
    <br>
    <br>
    <script src="login.js"></script>
    
    <script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var address = document.getElementById('address').value;

            var usernameError = document.getElementById('username-error');
            var emailError = document.getElementById('email-error');
            var passwordError = document.getElementById('password-error');
            var addressError = document.getElementById('address-error');

            // Resetting previous errors
            usernameError.innerHTML = "";
            emailError.innerHTML = "";
            passwordError.innerHTML = "";
            addressError.innerHTML = "";

            
            if (username.trim() === "") {
                usernameError.innerHTML = "Name is required.";
                return false;
            }

            if (email.trim() === "") {
                emailError.innerHTML = "Email is required.";
                return false;
            }

            

            if (password.trim() === "") {
                passwordError.innerHTML = "Password is required.";
                return false;
            }

            if (address.trim() === "") {
                addressError.innerHTML = "Address is required.";
                return false;
            }

            return true; // Form submission allowed if all validations pass
        }
    </script>
</body>
</html>




