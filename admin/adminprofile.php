<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "demo"; 

// Create connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Start the session and include the connection file
session_start();
include("connect.php");

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("location: signin.php");
    exit; // Stop further execution
}

// Retrieve admin information from the database
$admin_id = $_SESSION['Aid'];
$sql = "SELECT * FROM admin WHERE Aid = $admin_id";
$result = mysqli_query($connection, $sql);

// Fetch admin data
$admin_data = mysqli_fetch_assoc($result);

// Close the connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<nav>
        <div class="logo-name">
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>

            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Content</span>
                </a></li> -->
                <li><a href="analytics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
                <!-- <li><a href="donate.php">
                    <i class="uil uil-heart"></i>
                    <span class="link-name">Donates</span>
                </a></li>
                <li><a href="feedback.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Feedbacks</span>
                </a></li> -->
                <li><a href="#">
                    <i class="uil uil-user"></i>
                    <span class="link-name">Profile</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Share</span>
                </a></li> -->
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>
    <div class="profile-container">
        <h2>Admin Profile</h2>
        <div class="profile-details">
            <p><strong>Name:</strong> <?php echo $admin_data['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $admin_data['email']; ?></p>
            <p><strong>Location:</strong> <?php echo $admin_data['location']; ?></p>
            <p><strong>Address:</strong> <?php echo $admin_data['address']; ?></p>
            <!-- <p><strong>Date:</strong> <?php echo $admin_data['date']; ?></p> -->
            
        </div>
    </div>
</body>
</html>
