<?php
ob_start(); 

include '../connection.php';
include("connect.php"); 

if($_SESSION['name']==''){
    header("location:deliverylogin.php");
    exit; // Ensure script execution stops after redirecting
}

$name=$_SESSION['name'];
$id=$_SESSION['Did'];
$city=$_SESSION['city'];

$sql = "SELECT d.*, 
a.address AS delivery_address
FROM donations d
INNER JOIN admin a ON d.donation_accepted_by = a.Aid
WHERE d.assigned_to IS NULL AND d.location = '$city'";

$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Error executing query: " . mysqli_error($connection));
}

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
    $order_id = $_POST['order_id'];
    $delivery_person_id = $_POST['delivery_person_id'];

    $sql = "UPDATE donations SET delivery_by = $delivery_person_id WHERE id = $order_id";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        die("Error assigning order: " . mysqli_error($connection));
    }

    // Reload the page to prevent duplicate assignments
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="delivery.css">
    <link rel="stylesheet" href="../home.css">
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
                <li><a href="delivery.php">Home</a></li>
                <li><a href="openmap.php">Map</a></li>
                <li><a href="deliverymyord.php" class="active">My Orders</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <script>
        hamburger=document.querySelector(".hamburger");
        hamburger.onclick =function(){
            navBar=document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>
    <style>
        .itm {
            background-color: white;
            display: grid;
        }
        .itm img {
            width: 400px;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        p {
            text-align: center; 
            font-size: 28px;
            color: black; 
        }
        a {
            /* text-decoration: underline; */
        }
        @media (max-width: 767px) {
            .itm {
                /* float: left; */
            }
            .itm img {
                width: 350px;
                height: 350px;
            }
        }
    </style>

    <div class="itm">
        <img src="../img/delivery.gif" alt="" width="400" height="400"> 
    </div>

    <div class="get">
        <div class="log">
            <a href="delivery.php">Take orders</a>
            <p>Order assigned to you</p>
        </div>
        
        <!-- Display the orders in an HTML table -->
        <div class="table-container">
            <!-- <p id="heading">donated</p> -->
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Date/Time</th>
                            <th>Pickup Address</th>
                            <th>Delivery Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) { 
                            if ($row['donation_submit_status'] == 1) { ?>
                                <tr>
                                    <td data-label="Name"><?php echo $row['name']; ?></td>
                                    <td data-label="Phone Number"><?php echo $row['phoneno']; ?></td>
                                    <td data-label="Date/Time"><?php echo $row['donation_date']; ?></td>
                                    <td data-label="Pickup Address"><?php echo $row['address']; ?></td>
                                    <td data-label="Delivery Address"><?php echo $row['delivery_address']; ?></td>
                                </tr>
                            <?php } 
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
