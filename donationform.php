<?php
include("login.php");

if ($_SESSION['name'] == '') {
    header("location: signin.php");
}

$emailid = $_SESSION['email'];
$db = mysqli_select_db($connection, 'demo');

if (isset($_POST['submit'])) {
    // Check if donations are selected
    if (isset($_POST['donations']) && is_array($_POST['donations'])) {
        $donations = $_POST['donations'];
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $phoneno = mysqli_real_escape_string($connection, $_POST['phoneno']);
        $district = mysqli_real_escape_string($connection, $_POST['district']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);

        foreach ($donations as $donation) {
            // Get quantity for current donation type
            $quantity = mysqli_real_escape_string($connection, $_POST['quantity'][$donation]);

            // Get subcategory data
            $subcategory_type = "";
            $subcategory_size = "";
            $category = "";
            $footwear_category = ""; // Initialize footwear_category variable
            if ($donation === "clothes") {
                $subcategory_type = mysqli_real_escape_string($connection, $_POST['clothes_type']);
                $subcategory_size = mysqli_real_escape_string($connection, $_POST['clothes_size']);
                $category = mysqli_real_escape_string($connection, $_POST['clothes_category']);
            } elseif ($donation === "footwares") {
                // Get footwear category
                $footwear_category = mysqli_real_escape_string($connection, $_POST['footwear_category']);
            }

            // Insert data into the database
            $query = "INSERT INTO donations (email, donation_type, quantity, phoneno, location, address, name, subcategory_type, subcategory_size, category, footwear_category) 
                      VALUES ('$emailid', '$donation', '$quantity', '$phoneno', '$district', '$address', '$name', '$subcategory_type', '$subcategory_size', '$category', '$footwear_category')";
            $query_run = mysqli_query($connection, $query);

            // Handle success or failure of the query
            if ($query_run) {
                echo '<script type="text/javascript">alert("data saved")</script>';
                header("location:delivery.html");
            } else {
                echo '<script type="text/javascript">alert("data not saved")</script>';
            }
        }
    } else {
        // No donations selected
        echo '<script type="text/javascript">alert("Please select at least one donation type")</script>';
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
    <!-- <link rel="stylesheet" href="loginstyle.css"> -->
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="donationform.css">
    

</head>
<body style="background-color: #06C167;">
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
            <li><a href="index.html" class="active">Account Login</a></li>
            <li><a href="about.html" class="active">About</a></li>
            <li><a href="profile.php" class="active">Profile</a></li>

        </ul>
    </nav>
</header>
<div class="container">
    <div class="regformf" >
        <form action="" method="post">
            <h2>Donate Here</h2>
            <div>
                <label for="donation_type">Select Donations:</label>
                <br><br>
               <div class="donation_form">
                <input type="checkbox" id="food" name="donations[]" value="food">
                <label for="food" class="checkbox-label">Food</label>
                <input type="text" id="food_quantity" name="quantity[food]" placeholder="Quantity Per Person" class="quantity-input">
                </div><br><br>
               <div class="donation_form">
                <input type="checkbox" id="clothes" name="donations[]" value="clothes">
                <label for="clothes">Clothes</label>
                <input type="number" id="clothes_quantity" name="quantity[clothes]" placeholder="Quantity in Numbers" class="quantity-input">
                </div>
                 <!-- Clothes type and size dropdowns -->
                <select id="clothes_type" class="" name="clothes_type">
                    <option value="Shirts">Shirts</option>
                    <option value="Pants">Pants</option>
                    <option value="Jackets">Jackets</option>
                    <option value="Shorts">Shorts</option>
                    <!-- Add more options as needed -->
                </select>
                <select id="clothes_size" name="clothes_size">
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="XL">Extra Large</option>
                    <!-- Add more options as needed -->
                </select><br><br>
               <div class="donation_form">
                <input type="checkbox" id="medicines" name="donations[]" value="medicines">
                <label for="medicines">Medicines</label>
                <input type="number" id="medicines_quantity" name="quantity[medicines]" placeholder="Quantity in Numbers" class="quantity-input">
                </div><br><br>
               <div class="donation_form">
                <input type="checkbox" id="footwares" name="donations[]" value="footwares">
                <label for="footwares">Footwares</label>
                <input type="number" id="footwares_quantity" name="quantity[footwares]" placeholder="Quantity in Pairs" class="quantity-input">
                </div>
                  <!-- Footwear category dropdown -->
                <select id="footwear_category" name="footwear_category">
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Kids">Kids</option>
                </select>
                <br><br>
               <div class="donation_form">
                <input type="checkbox" id="toys" name="donations[]" value="toys">
                <label for="toys">Toys</label>
                <input type="number" id="toys_quantity" name="quantity[toys]" placeholder="Quantity in Numbers" class="quantity-input">
                </div><br><br>
               <div class="donation_form">
                <input type="checkbox" id="utensils" name="donations[]" value="utensils">
                <label for="utensils">Utensils</label>
                <input type="number" id="utensils_quantity" name="quantity[utensils]" placeholder="Quantity in Numbers" class="quantity-input">
                </div><br><br>

               <div class="donation_form">
                <input type="checkbox" id="groceries" name="donations[]" value="groceries">
                <label for="groceries">Groceries</label>
                <input type="number" id="groceries_quantity" name="quantity[groceries]" placeholder="Quantity in Kgs" class="quantity-input">
</div>
            </div><br><br><br>
            <div class="contact-details-container">
    <b><p style="text-align: center;">Contact Details</p></b>
    <div class="input">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" required>
    </div>
    <div class="input">
        <label for="phoneno">PhoneNo:</label>
        <input type="text" id="phoneno" name="phoneno" maxlength="10"  pattern="[0-9]{10}"  required>
    </div>
     <div class="input">
        <label for="district">Cities:</label>
        <select id="district" name="district" style="padding: 10px;">
            <option value="Toronto">Toronto</option>
            <option value="Ottawa">Ottawa</option>
            <option value="Kitchener">Kitchener</option>
            <option value="Oshawa">Oshawa</option>
            <option value="St.Catherines">St.Catherines</option>
            <option value="Kingston">Kingston</option>
            <option value="Greater Sudbury">Greater Sudbury</option>
            <option value="Peterburg">Peterburg</option>
            <option value="Hamilton">Hamilton</option>
            <option value="Windsor">Windsor</option>
            <option value="Brantford">Brantford</option>
            <option value="Barrie">Barrie</option>
            <option value="Missisauga">Missisauga</option>
        </select>
        <label for="address" style="padding-left: 10px;">Address:</label>
        <input type="text" id="address" name="address"  value="<?php echo $_SESSION['address'];?>"required>
    </div>
    
    </div>
</div>
            <div class="btn">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('clothes_category').addEventListener('change', function() {
    var category = this.value;
    var clothesTypeDropdown = document.getElementById('clothes_type');
    // Clear previous options
    clothesTypeDropdown.innerHTML = '';
    // Populate options based on selected category
    if (category === 'Men') {
        // Add options for men's clothes
        var menClothes = ['Shirts', 'Pants', 'Jackets', 'Shorts'];
        menClothes.forEach(function(type) {
            var option = document.createElement('option');
            option.value = type;
            option.text = type;
            clothesTypeDropdown.appendChild(option);
        });
    } else if (category === 'Women') {
        // Add options for women's clothes
        var womenClothes = ['Dresses', 'Skirts', 'Blouses', 'Jeans'];
        womenClothes.forEach(function(type) {
            var option = document.createElement('option');
            option.value = type;
            option.text = type;
            clothesTypeDropdown.appendChild(option);
        });
    } else if (category === 'Kids') {
        // Add options for kids' clothes
        var kidsClothes = ['Tops', 'Bottoms', 'Dresses', 'T-shirts'];
        kidsClothes.forEach(function(type) {
            var option = document.createElement('option');
            option.value = type;
            option.text = type;
            clothesTypeDropdown.appendChild(option);
        });
    }
});
</script>
</body>
</html>
