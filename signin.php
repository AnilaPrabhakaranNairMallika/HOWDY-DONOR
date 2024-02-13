<?php

session_start();
include 'connection.php';

$msg = 0;

if (isset($_POST['sign'])) {
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);

  $sql = "SELECT * FROM signup WHERE email='$email'";
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $row['firstName']; 
      
      header("location: donationform.php");
      exit(); 
    } else {
      $msg = 1;
    }
  } else {
    echo "<h1><center>Account does not exist</center></h1>";
    exit(); 
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

</head>

<body>
<header>
        <nav class="nav-bar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html" >Contact</a></li>
               
            </ul>
        </nav>
        <div class="logo">HOWDY <b style="color: #06C167;">DONOR</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
               
                <li><a href="signin.php" >Signin</a></li>
                <li><a href="services.html" >Services</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="regform">
            <form action="" method="post">
                <p class="logo">Sign <b style="color:#06C167;">In</b></p>
                <p id="heading">Welcome back!</p>

                <div class="input">
                    <input type="text" placeholder="email" name="email" value=""  />
                </div>
                <div class="password">
                    <input type="password" placeholder="Password" name="password" id="password"  />
                    <i class="uil uil-eye-slash showHidePw"></i>
                    <?php
                    if($msg==1){
                        echo ' <i class="bx bx-error-circle error-icon"></i>';
                        echo '<p class="error">Username or password incorrect.</p>';
                    }
                    ?>
                </div>

                <div class="btn">
                    <button type="submit" name="sign">Sign in</button>
                </div>
                <div class="signin-up">
                    <p>Don't have an account? <a href="signup.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
    
    <div class="footer-left col-md-4 col-sm-6">
        <p class="about">
            <span>About us</span> 
    </div>
    <div class="footer-center col-md-4 col-sm-6">
        <div class="contact">
            <h3>Contact Us</h3>
            <p><i class="fa fa-map-marker"></i> 123 Street,Brantford City,ON, Canada</p>
            <p><i class="fa fa-phone"></i> +1234567890</p>
            <p><i class="fa fa-envelope"></i> Howdy@donation.com</p>
        </div>
    </div>
    <div class="footer-right col-md-4 col-sm-6">
        <div class="social">
            <h3>Follow Us</h3>
            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
</footer>
</body>

</html>
