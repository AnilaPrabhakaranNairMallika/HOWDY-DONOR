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
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start(); 
include("connect.php"); 
if($_SESSION['name']==''){
    header("location:signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image"></div>
            <span class="logo_name">ADMIN</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#"><i class="uil uil-estate"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="analytics.php"><i class="uil uil-chart"></i><span class="link-name">Analytics</span></a></li>
                <!-- <li><a href="donate.php"><i class="uil uil-heart"></i><span class="link-name">Donates</span></a></li> -->
                <!-- <li><a href="feedback.php"><i class="uil uil-comments"></i><span class="link-name">Feedbacks</span></a></li> -->
                <li><a href="adminprofile.php"><i class="uil uil-user"></i><span class="link-name">Profile</span></a></li>
            </ul>
            <ul class="logout-mode">
                <li><a href="../logout.php"><i class="uil uil-signout"></i><span class="link-name">Logout</span></a></li>
                <li class="mode">
                    <a href="#"><i class="uil uil-moon"></i><span class="link-name">Dark Mode</span></a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <p class="logo">Howdy <b style="color: #06C167;">Donor</b></p>
        </div>
        <div class="dash-content">
        
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Donations</span>
                </div>
                <div class="get">
                    <?php
                    $loc = $_SESSION['location'];

                    // Define the SQL query to fetch recent donations

                    $sql = "SELECT * FROM donations WHERE location = '$loc' ORDER BY donation_date DESC LIMIT 10";

                    // Execute the query
                    $result = mysqli_query($connection, $sql);
                    ?>

                    <!-- Display the recent donations in an HTML table -->
                    <div class="table-container">
                        <div class="table-wrapper">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Donation Type</th>
                                        <th>Quantity</th>
                                        <th>Phone Number</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                        <th>Name</th>
                                        <th>Donation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['donation_type'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>" . $row['phoneno'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['donation_date'] . "</td>";
                                        echo "<td><button class='accept-button' onclick='acceptDonation(" . $row['id'] . ")'>Accept Donation</button></td>";

                                        // echo "<td><button onclick='acceptDonation(" . $row['id'] . ")'>Accept Donation</button></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <script src="admin.js"></script>
    <script>
        function acceptDonation(donationId) {
            // Redirect to delivery.html with the donation ID as a parameter
            window.location.href = 'delivery.html';
        }
    </script>
</body>
</html>


