<?php
include 'connection.php';

$errors = []; // Initialize array to store validation errors

if(isset($_POST['sign'])) {
    // Validate first name
    $firstName = trim($_POST['firstName']);
    if(empty($firstName)) {
        $errors['firstName'] = "First name is required";
    }

    // Validate last name
    $lastName = trim($_POST['lastName']);
    if(empty($lastName)) {
        $errors['lastName'] = "Last name is required";
    }

    // Validate email
    $email = trim($_POST['email']);
    if(empty($email)) {
        $errors['email'] = "Email is required";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Validate username
    $username = trim($_POST['username']);
    if(empty($username)) {
        $errors['username'] = "Username is required";
    }

    // Validate password
    $password = trim($_POST['password']);
    if(empty($password)) {
        $errors['password'] = "Password is required";
    }

    // Validate number
    $number = trim($_POST['number']);
    if(empty($number)) {
        $errors['number'] = "Number is required";
    } elseif(!ctype_digit($number)) {
        $errors['number'] = "Number must be a valid integer";
    }

    // If there are no validation errors, proceed with inserting data
    if(empty($errors)) {
        // Hash the password
        $pass = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists in database
        $sql = "SELECT * FROM signup WHERE email='$email'";
        $result = mysqli_query($connection, $sql);

        if($result === false) {
            // Handle query error
            echo "Query error: " . mysqli_error($connection);
        } else {
            $num = mysqli_num_rows($result);
            if($num > 0) {
                echo "<script>alert('Account already exists');</script>";
            } else {
                // Insert data into database
                $query = "INSERT INTO signup (firstName, lastName, email, username, password, number) 
                          VALUES ('$firstName', '$lastName', '$email', '$username', '$pass', '$number')";
                $query_run = mysqli_query($connection, $query);

                if($query_run) {
                    echo "<script>alert('Data saved successfully');</script>";
                    header("location: signin.php");
                    exit();
                } else {
                    // Handle query error
                    echo '<script type="text/javascript">alert("Data not saved. ' . mysqli_error($connection) . '")</script>';
                }
            }
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
    <title>Registration</title>
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
            <p class="logo">Sign <b style="color: #06C167;">Up</b></p>
            <p id="heading">Create your account</p>

            <div class="input">
                <label class="textlabel" for="firstName">First Name</label><br>
                <input type="text" id="firstName" name="firstName" value="<?php echo isset($_POST['firstName']) ? $_POST['firstName'] : ''; ?>" required>
                <?php if(isset($errors['firstName'])) { echo "<p>{$errors['firstName']}</p>"; } ?>
            </div>
            <div class="input">
                <label class="textlabel" for="lastName">Last Name</label><br>
                <input type="text" id="lastName" name="lastName" value="<?php echo isset($_POST['lastName']) ? $_POST['lastName'] : ''; ?>" required>
                <?php if(isset($errors['lastName'])) { echo "<p>{$errors['lastName']}</p>"; } ?>
            </div>
            
            <div class="input">
                <label class="textlabel" for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                <?php if(isset($errors['email'])) { echo "<p>{$errors['email']}</p>"; } ?>
            </div>
            <div class="input">
                <label class="textlabel" for="username">Username</label><br>
                <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
                <?php if(isset($errors['username'])) { echo "<p>{$errors['username']}</p>"; } ?>
            </div>
            <label class="textlabel" for="password">Password</label>
            <div class="password">
                <input type="password" name="password" id="password" required>
                <i class="uil uil-eye-slash showHidePw" id="showpassword"></i>
                <?php if(isset($errors['password'])) { echo "<p>{$errors['password']}</p>"; } ?>
            </div>
            <div class="input">
                <label class="textlabel" for="number">Number</label>
                <input type="text" id="number" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] : ''; ?>">
                <?php if(isset($errors['number'])) { echo "<p>{$errors['number']}</p>"; } ?>
            </div>
            <div class="btn">
                <button type="submit" name="sign">Continue</button>
            </div>
            <div class="signin-up">
                <p style="font-size: 20px; text-align: center;">Already have an account? <a href="signin.php">Sign in</a></p>
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
