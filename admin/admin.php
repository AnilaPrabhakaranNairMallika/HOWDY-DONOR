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

if(empty($_SESSION['name'])) {
    header("location:signin.php");
    exit; // Stop further execution
}

// After verifying admin credentials
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['donation_id'])) {
    // Fetch admin details
    $adminEmail = $_SESSION['email']; // Assuming email is used to uniquely identify admins
    $sql = "SELECT * FROM admin WHERE email = '$adminEmail'";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Set admin ID in session
        $_SESSION['admin_id'] = $row['Aid'];
    }

    // Handle donation acceptance
    $donationId = $_POST['donation_id'];
    $adminId = $_SESSION['admin_id']; // Retrieve the admin ID from the session
    // Perform database update to set donation_submit_status to 1 for the given donation ID
    $sql = "UPDATE `donations` SET `donation_submit_status` = 1, `donation_accepted_by` = $adminId WHERE `id` = $donationId";
    if (mysqli_query($connection, $sql)) {
        // Success message
        echo "Donation accepted successfully!";
    } else {
        // Error message
        echo "Error accepting donation. Please try again later.";
    }
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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
                    <div class="table-container" style="font-size: small;">
                        <div class="table-wrapper">
                            <div class="">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Donation Type</th>
                                          
                                            <th> Categories</th>
                                            <th>Quantity</th>
                                            <th>Phone Number</th>
                                            <th>Location</th>
                                            <th>Address</th>
                                            <th colspan="">Email</th>
                                            <th>Donation Date</th>
                                            <th colspan="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['donation_type'] . "</td>";

                                            // Concatenate subcategory information into a single column
                                            if ($row['donation_type'] === 'footwares' || $row['donation_type'] === 'clothes') {
                                                // Initialize an array to store subcategory information
                                                $subcategory_info = array();

                                                // Check and add non-empty values to the array
                                                if (!empty($row['subcategory_type'])) {
                                                    $subcategory_info[] = $row['subcategory_type'];
                                                }
                                                if (!empty($row['subcategory_size'])) {
                                                    $subcategory_info[] = $row['subcategory_size'];
                                                }
                                                if (!empty($row['footwear_category'])) {
                                                    $subcategory_info[] = $row['footwear_category'];
                                                }

                                                // Concatenate the array elements with a comma
                                                $subcategory_combined = implode(', ', $subcategory_info);

                                                // Output the concatenated subcategory information
                                                echo "<td>" . $subcategory_combined . "</td>";
                                            } else {
                                                // Output a message if donation type is not 'footware' or 'clothes'
                                                echo "<td>No subcategory    </td>";
                                            }

                                            // Output other columns
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['phoneno'] . "</td>";
                                            echo "<td>" . $row['location'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['donation_date'] . "</td>";
                                            echo "<td>";
                                            if ($row['donation_submit_status'] == 0) {
                                                // If donation_submit_status is 0, show the "Accept Donation" button
                                                echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                                                echo "<input type='hidden' name='donation_id' value='" . $row['id'] . "'>";
                                                // Add hidden field to store admin IDecho "<input type='hidden' name='Aid' value='" . (isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : "") . "'>";

                                                echo "<button type='submit' class='accept-button'>Accept Donation</button>";
                                                echo "</form>";
                                            } else {
                                                // If donation_submit_status is 1, show the "Donation Accepted" text
                                                echo "<button class='btn btn-primary accept-button bg-primary'>Donation Accepted</button>";
                                            }
                                            echo "</td>";
                                            
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
        </div>
        
    </section>
    <script>
        $(document).ready( function () {
            $('.table').DataTable();
        });
    </script>
    <script src="admin.js"></script>
    <script>
        function acceptDonation(donationId) {
            // Redirect to delivery.html with the donation ID as a parameter
            window.location.href = 'delivery.html';
        }
    </script>
</body>
</html>
