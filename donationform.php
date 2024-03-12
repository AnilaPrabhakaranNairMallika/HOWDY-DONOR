<?php
include("login.php"); 

if($_SESSION['name'] == ''){
    header("location: signin.php");
}

$emailid = $_SESSION['email'];
$db = mysqli_select_db($connection, 'demo');

if(isset($_POST['submit'])) {
    $donations = $_POST['donations'];
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phoneno = mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district = mysqli_real_escape_string($connection, $_POST['district']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);

//     foreach($donations as $donation) {
//         $quantity = mysqli_real_escape_string($connection, $_POST['quantity'][$donation]); // Get quantity for current donation type
        
//         $query = "INSERT INTO donations (email, donation_type, quantity, phoneno, location, address, name) 
//                   VALUES ('$emailid', '$donation', '$quantity', '$phoneno', '$district', '$address', '$name')";
//         $query_run = mysqli_query($connection, $query);

//         if($query_run)
//     {

//         echo '<script type="text/javascript">alert("data saved")</script>';
//         header("location:delivery.html");
//     }
//     else{
//         echo '<script type="text/javascript">alert("data not saved")</script>';
//     }
// }
foreach($donations as $donation) {
    // Get quantity for current donation type
    $quantity = mysqli_real_escape_string($connection, $_POST['quantity'][$donation]);
    
    // Get subcategory data
    $subcategory_type = "";
    $subcategory_size = "";
    $category = "";
    if ($donation === "clothes") {
        $subcategory_type = mysqli_real_escape_string($connection, $_POST['clothes_type']);
        $subcategory_size = mysqli_real_escape_string($connection, $_POST['clothes_size']);
        $category = mysqli_real_escape_string($connection, $_POST['clothes_category']);
    }

    // Insert data into the database
    $query = "INSERT INTO donations (email, donation_type, quantity, phoneno, location, address, name, subcategory_type, subcategory_size, category) 
              VALUES ('$emailid', '$donation', '$quantity', '$phoneno', '$district', '$address', '$name', '$subcategory_type', '$subcategory_size', '$category')";
    $query_run = mysqli_query($connection, $query);

    // Handle success or failure of the query
    if($query_run) {
        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    } else {
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
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
                </div><br><br>
               <div class="donation_form">
                <input type="checkbox" id="medicines" name="donations[]" value="medicines">
                <label for="medicines">Medicines</label>
                <input type="number" id="medicines_quantity" name="quantity[medicines]" placeholder="Quantity in Numbers" class="quantity-input">
                </div><br><br>
               <div class="donation_form">
                <input type="checkbox" id="footwares" name="donations[]" value="footwares">
                <label for="footwares">Footwares</label>
                <input type="number" id="footwares_quantity" name="quantity[footwares]" placeholder="Quantity in Pairs" class="quantity-input">
                </div><br><br>
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
        <label for="district">Provinces:</label>
        <select id="district" name="district" style="padding: 10px;">
            <option value="Alberta">Alberta</option>
            <option value="British Columbia">British Columbia</option>
            <option value="Manitoba">Manitoba</option>
            <option value="New Brunswick">New Brunswick</option>
            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
            <option value="Nova Scotia">Nova Scotia</option>
            <option value="Ontario">Ontario</option>
            <option value="Prince Edward Island">Prince Edward Island</option>
            <option value="Quebec">Quebec</option>
            <option value="Saskatchewan">Saskatchewan</option>
            <option value="Northwest Territories">Northwest Territories</option>
            <option value="Nunavut">Nunavut</option>
            <option value="Yukon">Yukon</option>
        </select>
        <label for="address" style="padding-left: 10px;">Address:</label>
        <input type="text" id="address" name="address"  value="<?php echo $_SESSION['address'];?>"required>
    </div>
    
    </div>
</div>

            <!-- Add more fields for other types of donations if needed -->
            
            <!-- <b><p style="text-align: center;">Contact Details</p></b>
            <div class="input">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" required>
            </div>
            <div class="input">
                <label for="phoneno">PhoneNo:</label>
                <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required>
            </div>
            <div class="input">
                <label for="district">Provinces:</label>
                <select id="district" name="district" style="padding: 10px;">
                    <option value="Alberta">Alberta</option>
                    <option value="British Columbia">British Columbia</option>
                        <option value="Manitoba">Manitoba</option>
                        <option value="New Brunswick">New Brunswick</option>
                        <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                        <option value="Nova Scotia">Nova Scotia</option>
                        <option value="Ontario">Ontario</option>
                        <option value="Prince Edward Island">Prince Edward Island</option>
                        <option value="Quebec">Quebec</option>
                        <option value="Saskatchewan">Saskatchewan</option>
                        <option value="Northwest Territories">Northwest Territories</option>
                        <option value="Nunavut">Nunavut</option>
                        <option value="Yukon">Yukon</option>

                </select>
                <label for="address" style="padding-left: 10px;">Address:</label>
                <input type="text" id="address" name="address" required>
            </div> -->
            
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
