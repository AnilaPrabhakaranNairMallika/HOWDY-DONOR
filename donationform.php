
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
<header>
        <nav class="nav-bar">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html" >Contact</a></li>
               
            </ul>
        </nav>
        <div class="logo">HOWDY <b style="color: #06C167;">DONOR</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
               
                <li><a href="signin.php" >Signin</a></li>
                <li><a href="services.html" >Services</a></li>
            </ul>
        </nav>
    </header>
    

    <div class="container">
        <div class="donation-form">
            <form action="delivery.html" method="post">
                <h2>Donation Form</h2>

                <div class="input">
                    <label for="firstname">Your Name:</label>
                    <input type="text" id="name" name="name" required />
                </div>

                <div class="input">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required />
                </div>

                <div class="input">
                
                <label for="province">Cities:</label>
                
                    <select id="province" name="province">
                    <option value="Toronto">Toronto</option>
                    <option value="Ottawa">Ottawa</option>
                    <option value="Mississauga">Mississauga</option>
                    <option value="Hamilton">Hamilton</option>
                    <option value="Brampton">Brampton</option>
                    <option value="London">London</option>
                    <option value="Markham">Markham</option>
                    <option value="Vaughan">Vaughan</option>
                    <option value="Kitchener">Kitchener</option>
                    <option value="Windsor">Windsor</option>
                    <option value="Oshawa">Oshawa</option>
                    <option value="Barrie">Barrie</option>
                    <option value="Richmond Hill">Richmond Hill</option>
                    <option value="Thunder Bay">Thunder Bay</option>
                    <option value="Kingston">Kingston</option>
                    <option value="Waterloo">Waterloo</option>  
                    <option value="Brantford">Brantford</option>
                </select>
                </div>

                <div class="input">
                <label for="organization">Select Organization:</label>
                 <select id="organization" name="organization">
                     <option value="Canadian Red Cross">Canadian Red Cross</option>
                     <option value="United Way Greater Toronto ">United Way Greater Toronto</option>
                     <option value="Daily Bread Food Bank ">Daily Bread Food Bank</option>
                     <option value="Habitat for Humanity GTA">Habitat for Humanity GTA</option>
                     <option value="Ontario SPCA and Humane Society">Ontario SPCA and Humane Society</option>
                     <option value="Canadian Cancer Society (Ontario Division)">Canadian Cancer Society (Ontario Division)</option>
                     <option value="Heart & Stroke Foundation (Ontario) ">Heart & Stroke Foundation (Ontario) </option>
                     <option value="Ontario Association of Food Banks">Ontario Association of Food Banks</option>
                     <option value="SickKids Foundation ">SickKids Foundation </option>
                     <option value="Canadian Cancer Society (Ontario Division">Canadian Cancer Society (Ontario Division</option>
               </select>
              </div>


                <div class="input">
                    <label for="item">Item:</label>
                    <input type="text" id="item" name="item" required />
                </div>

                <div class="input">
                    <label for="quantity">Quantity:</label>
                    <input type="text" id="quantity" name="quantity" required />
                </div>

                <div class="btn">
                    <button type="submit" name="submit">Donate</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer">
    
    <div class="footer-left col-md-4 col-sm-6">
        <p class="about">
            <span>About us</span> 
    </div>
    <div class="footer-center col-md-4 col-sm-6">
        <div class="contact">
            <h3>Contact Us</h3>
            <p><i class="fa fa-map-marker"></i> 123 Street,Brantford City,ON, Canada</p>
            <p><i class="fa fa-phone"></i> +1234567890</p>
            <p><i class="fa fa-envelope"></i> Howdy@donation.com</p>
        </div>
    </div>
    <div class="footer-right col-md-4 col-sm-6">
        <div class="social">
            <h3>Follow Us</h3>
            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
</footer>
</body>
</html>




