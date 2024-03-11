<?php
include("login.php"); 
if($_SESSION['name'] == ''){
	header("location: signin.php");
}

$emailid = $_SESSION['email'];
$db = mysqli_select_db($connection,'demo');

if(isset($_POST['submit'])) {
    $clothes_type = mysqli_real_escape_string($connection, $_POST['clothes_type']);
    $clothes_size = mysqli_real_escape_string($connection, $_POST['clothes_size']);
    $clothes_quantity = mysqli_real_escape_string($connection, $_POST['clothes_quantity']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phoneno = mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district = mysqli_real_escape_string($connection, $_POST['district']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

    $query = "INSERT INTO clothes_donations (email, clothes_type, clothes_size, quantity, phoneno, location, address, name) 
              VALUES ('$emailid', '$clothes_type', '$clothes_size', '$clothes_quantity', '$phoneno', '$district', '$address', '$name')";
    
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script type="text/javascript">alert("Data saved")</script>';
        header("location: delivery.html");
    } else {
        echo '<script type="text/javascript">alert("Data not saved")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOWDY DONOR</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="home.css">

</head>
<body style="    background-color: #06C167;">
<header>
        <div class="logo">HOWDY <b style="color: #06C167;">DONOR</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="home.html" class="active">Home</a></li>
                <li><a href="fooddonateform.php" >Foods</a></li>
                <li><a href="clothes_donate.php" >Clothes</a></li>
                <li><a href="footwear_donate.php" >Footwears</a></li>
                <li><a href="grocery_donate.php" >Grocery</a></li>
                <!-- <li ><a href="fooddonate.html"  >Donate</a></li> -->
            </ul>
        </nav>
    </header>
    <div class="container">
    <div class="regformf">
        <form action="" method="post">
            <div class="input">
                <h2>Donate Clothes Here..</h2>
                <label for="clothes_type">Clothes Type:</label>
                <input type="radio" id="men" name="clothes_type" value="Men" required>
                    <label for="men">Men</label><br>
                    <input type="radio" id="women" name="clothes_type" value="Women">
                    <label for="women">Women</label><br>
                    <input type="radio" id="kids" name="clothes_type" value="Kids">
                    <label for="kids">Kids</label><br>
            </div>

            <div class="input">
                <label for="clothes_size">Size:</label>
                <input type="text" id="clothes_size" name="clothes_size" required/>
            </div>

            <div class="input">
                <label for="clothes_quantity">Quantity:</label>
                <input type="text" id="clothes_quantity" name="clothes_quantity" required/>
            </div>

            <b><p style="text-align: center;">Contact Details</p></b>
            <div class="input">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" required/>
                </div>
                <div>
                    <label for="phoneno">PhoneNo:</label>
                    <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
                </div>
            </div>

            <div class="input">
                <label for="district">Provinces:</label>
                <select id="district" name="district" style="padding:10px;">
                    <option value="Alberta">Alberta</option>
                    <!-- Add more options for other provinces -->
                </select> 
                <label for="address" style="padding-left: 10px;">Address:</label>
                <input type="text" id="address" name="address" required/><br>
            </div>

            <div class="btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
