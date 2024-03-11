<?php
$host = "localhost"; // or your database host
$username = "root"; // or your database username
$password = ""; // or your database password
$database = "demo"; // replace with your actual database name

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Analytics</title>
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
            <p class="logo">Howdy<b style="color: #06C167;">Donor</b></p>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart"></i>
                    <span class="text">Analytics</span>
                </div>

                <br>
                <br>

                <canvas id="donationChart" style="width:100%;max-width:600px"></canvas>

                <script>
                <?php
                
            

                    $query_male = "SELECT SUM(quantity) as total FROM donations INNER JOIN login ON donations.email = login.email WHERE login.gender='male'";
                    $query_female = "SELECT SUM(quantity) as total FROM donations INNER JOIN login ON donations.email = login.email WHERE login.gender='female'";
                    $query_Others = "SELECT SUM(quantity) as total FROM donations INNER JOIN login ON donations.email = login.email WHERE login.gender='Others'";
                    $result_male = mysqli_query($connection, $query_male);
                    $result_female = mysqli_query($connection, $query_female);
                    $result_Others = mysqli_query($connection, $query_Others);
                    $row_male = mysqli_fetch_assoc($result_male);
                    $row_female = mysqli_fetch_assoc($result_female);
                    $row_Others = mysqli_fetch_assoc($result_Others);
                    
                    // Fetching total donations made by male
                    $male_total = isset($row_male['total']) ? $row_male['total'] : 0;
                    
                    // Fetching total donations made by female
                    $female_total = isset($row_female['total']) ? $row_female['total'] : 0;
                    
                    // Fetching total donations made by other genders
                    $Others_total = isset($row_Others['total']) ? $row_Others['total'] : 0;
                
                ?>
               
                var genderLabels = ["Male", "Female", "Others"];
                var genderData = [<?php echo $male_total; ?>, <?php echo $female_total; ?>, <?php echo $Others_total; ?>];
                var genderColors = ["#06C167", "blue", "red"];
                new Chart("donationChart", {
                    type: "bar",
                    data: {
                        labels: genderLabels,
                        datasets: [{
                            backgroundColor: genderColors,
                            data: genderData
                        }]
                    },
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: "Total Donations Chart"
                        }
                    }
                });
                </script>
            </div>
        </div>
    </section>
</body>
</html>
