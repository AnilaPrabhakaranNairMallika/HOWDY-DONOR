
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
if(empty($_SESSION['name'])){
	header("location:signin.php");
}
// Check if the filter form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filter'])) {
    // Get the selected date from the form
    $selected_date = $_POST['selected_date'];
    
    // Modify the SQL query to fetch accepted donations filtered by date
    $sql = "SELECT * FROM donations WHERE donation_submit_status = 1 AND DATE(donation_date) = '$selected_date'";
} else {
    // Default SQL query to fetch all accepted donations
    $sql = "SELECT * FROM donations WHERE donation_submit_status = 1";
}

// Execute the SQL query
$result = mysqli_query($connection, $sql);

// Check if the query execution was successful
if (!$result) {
    // Display an error message if the query failed
    echo "Error: " . mysqli_error($connection);
    exit; // Exit the script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Donation History</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image"></div>
            <span class="logo_name">ADMIN</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php"><i class="uil uil-estate"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="#"><i class="uil uil-chart"></i><span class="link-name">Analytics</span></a></li>
                <!-- <li><a href="donate.php"><i class="uil uil-heart"></i><span class="link-name">Donates</span></a></li> -->
                <!-- <li><a href="feedback.php"><i class="uil uil-comments"></i><span class="link-name">Feedbacks</span></a></li> -->
                <li><a href="adminprofile.php"><i class="uil uil-user"></i><span class="link-name">Profile</span></a></li>
                <li><a href="AcceptedDonation.php"><i class="uil uil-user"></i><span class="link-name">Accepted Donation</span></a></li>
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
    <!-- Dashboard section -->
    <section class="dashboard">
        <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>
                <p class="logo">Howdy<b style="color: #06C167;">Donor</b></p>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="mb-5 mt-5">
                   <h1 class="text-center">All Accepted Donations </h1>
                   <hr>
                </div>
<!-- Form for date filtering -->
<form method="POST" action="" class="d-flex justify-content-end">
    <label for="selected_date" class="w-100 text-right mt-3 mr-3">Select Donation Date:</label>
    <input type="date" class="form-control mr-2" id="selected_date" name="selected_date" value="<?php echo isset($selected_date) ? $selected_date : ''; ?>">
    <input type="submit" name="filter" class="btn btn-success" value="Filter">
</form>


                <!-- HTML table to display accepted donations -->
                <div class="table-container" style="font-size: small;">
                    <div class="table-wrapper">
                        <div class="">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Donation Type</th>
                                        <th>Quantity</th>
                                        <th>Phone Number</th>
                                        <th>Location</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Donation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Loop through the query result to display donations
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['donation_type'] . "</td>";
                                            echo "<td>" . $row['quantity'] . "</td>";
                                            echo "<td>" . $row['phoneno'] . "</td>";
                                            echo "<td>" . $row['location'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['donation_date'] . "</td>";
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
</body>
</html>