<?php
ob_start(); 
include("connect.php"); // Include your database connection file

// Check if a session is not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Starting the session
}

if(!isset($_SESSION['name']) || empty($_SESSION['name'])) {
	header("location: deliverylogin.php");
	exit; // Ensure script execution stops after redirecting
}

$name = $_SESSION['name'];
$id = $_SESSION['Did'];
$city = $_SESSION['city'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="delivery.css">
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
            <li><a href="openmap.php" >Map</a></li>
            <li><a href="deliverymyord.php" >My Orders</a></li>
            <li><a href="deliveryprofile.php" >Profile</a></li>
            <li><a href="../logout.php"  >Logout</a></li> 
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
    .itm{
        background-color: white;
        display: grid;
    }
    .itm img{
        width: 400px;
        height: 400px;
        margin-left: auto;
        margin-right: auto;
    }
    p{
        text-align: center; 
        font-size: 30PX;
        color: black; 
        margin-top: 50px;
    }
    a{
        /* text-decoration: underline; */
    }
    @media (max-width: 767px) {
        .itm{
            /* float: left; */
            
        }
        .itm img{
            width: 350px;
            height: 350px;
        }
    }
</style>

<h2><center>Welcome <?php echo"$name";?></center></h2>

<div class="itm">
    <img src="../img/delivery.gif" alt="" width="400" height="400"> 
</div>

<div class="get">
    <?php
    
$sql = "SELECT d.*, 
a.address AS delivery_address
FROM donations d
INNER JOIN admin a ON d.donation_accepted_by = a.Aid
WHERE d.assigned_to IS NULL AND d.location = '$city'";

    // Execute the query
    $result=mysqli_query($connection, $sql);

    // Check for errors
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Fetch the data as an associative array
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // If the delivery person has taken an order, update the assigned_to field in the database
    if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
        $order_id = $_POST['order_id'];
        $delivery_person_id = $_POST['delivery_person_id'];
        $sql = "SELECT * FROM donations WHERE id = $order_id AND delivery_by IS NOT NULL";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Order has already been assigned to someone else
            die("Sorry, this order has already been assigned to someone else.");
        }

        $sql = "UPDATE donations SET delivery_by = $delivery_person_id WHERE id = $order_id";
        $result=mysqli_query($connection, $sql);

        if (!$result) {
            die("Error assigning order: " . mysqli_error($conn));
        }

        // Reload the page to prevent duplicate assignments
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
        ob_end_flush();
    }
    ?>
    <div class="log">
        <a href="deliverymyord.php">My orders</a>
    </div>

    <!-- Display the orders in an HTML table -->
    <div class="table-container">
        <div class="table-wrapper">
        <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Date/Time</th>
            <th>Pickup Address</th>
            <th>Delivery Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $row) { 
    if ($row['donation_submit_status'] == 1) { ?>
        <tr>
            <td data-label="name"><?php echo $row['name']; ?></td>
            <td data-label="phoneno"><?php echo $row['phoneno']; ?></td>
            <td data-label="date"><?php echo $row['donation_date']; ?></td>
            <td data-label="Pickup Address"><?php echo $row['address']; ?></td>
            <!-- <?php
                echo "<pre>";
                print_r($row);
                echo "</pre>";
            ?> -->
           <td data-label="Delivery Address">
    <?php echo isset($row['delivery_address']) ? $row['delivery_address'] : ''; ?>
</td>

            <td data-label="Action" style="margin:auto">
                <?php 
                if ($row['delivery_by'] == null) { ?>
                    <form method="post" action=" ">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delivery_person_id" value="<?= $id ?>">
                        <button type="submit" name="food">Take order</button>
                    </form>
                <?php } else if ($row['delivery_by'] == $id) { ?>
                    Order assigned to you
                <?php } else { ?>
                    Order assigned to another delivery person
                <?php } ?>
            </td>
        </tr>
    <?php } 
} ?>


    </tbody>
</table>

        </div>
    </div>
    <br>
    <br>
</div>

</body>
</html>