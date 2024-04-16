<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Set recipient email address
    $to = "anilaprabhakarpm@gmail.com";

    // Set email subject
    $subject = "Contact Form Submission from $name";

    // Compose email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n\n";
    $email_message .= "Message:\n$message";

    // Send email
    $headers = "From: $email";
    if (mail($to, $subject, $email_message, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email. Please try again later.";
    }
}
?>
