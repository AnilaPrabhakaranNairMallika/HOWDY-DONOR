<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

     
     $to = 'admin@example.com'; 
    $subject = 'New message from contact form';
     $body = "Name: $name\nEmail: $email\n\n$message";

    
    if (mail($to, $subject, $body)) {
        // Email sent successfully
        echo '<script>alert("Your message has been sent successfully!");</script>';
    } else {
        // Email sending failed
        echo '<script>alert("Sorry, there was an error sending your message. Please try again later.");</script>';
    }

    // Redirect back to the contact page
    echo '<script>window.location.href = "contact.html";</script>';
} else {
    // If the form is not submitted, redirect back to the contact page
    header("Location: contact.html");
    exit();
}
?>
