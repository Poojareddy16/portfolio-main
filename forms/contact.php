<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'buttamgaripoojareddy@gmail.com';

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Debugging Step: Check if form data is received
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        die('Error: Missing form fields. Name, Email, Subject, and Message are required.');
    }

    // Debugging Step: Print sanitized inputs
    error_log("Form data received: Name=$name, Email=$email, Subject=$subject, Message=$message");

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_body = "You have received a new message from your website contact form:\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n";
    $email_body .= "Message:\n$message\n";

    // Debugging Step: Test mail() function
    if (mail($to, $subject, $email_body, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        error_log("Error: mail() function failed.");
        echo "Error: Unable to send the email. Please check your server's mail configuration.";
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Error: Invalid request method.";
}
?>
