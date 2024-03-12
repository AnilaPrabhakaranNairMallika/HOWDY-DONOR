<?php
include("login.php"); 

if($_SESSION['name'] == ''){
    header("location: signup.php");
}

$email = $_SESSION['email'];
$query = "SELECT * FROM donations WHERE email='$email'";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header>
    <div class="logo">Food <b style="color: #06C167;">Donate</b></div>
    <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <nav class="nav-bar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="profile.php" class="active">Profile</a></li>
        </ul>
    </nav>
</header>

<div class="profile">
    <div class="profilebox">
        <p class="headingline" style="text-align: left; font-size: 30px;">Profile</p>
        <br>
        <div class="info" style="padding-left:10px;">
            <p>Name  : <?php echo $_SESSION['name'] ;?></p><br>
            <p>Email : <?php echo $_SESSION['email'];?></p><br>
            <p>Gender: <?php echo $_SESSION['gender'] ;?></p><br>

            <a href="logout.php" style="float: left; margin-top: 6px; border-radius: 5px; background-color: #06C167; color: white; padding: 5px 10px;">Logout</a>
        </div>
        <hr>
        <br>
        <p class="heading1">Your donations</p>
        <div class="table-container">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Donation Type</th>
                            <th>Quantity</th>
                            <th>Phone Number</th>
                            <th>Location</th>
                            <th>Address</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr><td>".$row['donation_type']."</td><td>".$row['quantity']."</td><td>".$row['phoneno']."</td><td>".$row['location']."</td><td>".$row['address']."</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No donations found</td></tr>";
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
