<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header("location: deliverylogin.php");
    exit;
}

include '../connection.php'; 

// Fetch delivery person's information from the session
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$city = $_SESSION['city'];
$Did = $_SESSION['Did'];

// Fetch additional details from the database if needed
// $sql = "SELECT * FROM delivery_persons WHERE email = '$email'";
// $result = mysqli_query($connection, $sql);
// $row = mysqli_fetch_assoc($result);
// $name = $row['name'];
// $city = $row['city'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Person Profile</title>
    <link rel="stylesheet" href="deliverycss.css">
    <link rel="stylesheet" href="delivery.css">
    <link rel="stylesheet" href="../home.css">

</head>
<body>
<header>
        <div class="logo">Howdy <b style="color: #06C167;">Donor</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="openmap.php" >map</a></li>
                <li><a href="deliverymyord.php" >myorders</a></li>
                <li><a href="deliveryprofile.php" >Profile</a></li>

                <!-- <li><a href="home.html" ><i class="fa fa-home" aria-hidden="true"></i></a></li> -->
                 <li ><a href="../logout.php"  >Logout</a></li> 
            </ul>
        </nav>
    </header>


    <div class="center">
        <h1>Delivery Profile</h1>
        <div class="profile_info">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>City:</strong> <?php echo $city; ?></p>
        </div> 
        <!-- <div class="logout_link">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
