<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

     
     $to = 'anilaprabhakarpm@gmail.com'; 
    $subject = 'New message from contact form';
     $body = "Name: $name\nEmail: $email\n\n$message";

    
    if (mail($to, $subject, $body)) {
        
        echo '<script>alert("Your message has been sent successfully!");</script>';
    } else {
        
        echo '<script>alert("Sorry, there was an error sending your message. Please try again later.");</script>';
    }

    
    echo '<script>window.location.href = "contact.html";</script>';
} else {
    
    header("Location: contact.html");
    exit();
}
?>
