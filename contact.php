<?php
function sanitizeInput($input)
{
    // Sanitize the input to prevent any malicious content
    $sanitizedInput = trim($input);
    $sanitizedInput = htmlspecialchars($sanitizedInput);
    return $sanitizedInput;
}

if ($_POST) {
    // Retrieve and sanitize form inputs
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $message = sanitizeInput($_POST["message"]);

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "The email address is invalid.";
    } else {
        $toEmail = "umid.murad@hotmail.com"; // Replace with the recipient email address
        $fromEmail = $email;
        $fromName = $name;
        $subject = "Contact Form Submission"; // Subject for the email

        // Set email headers
        $headers = "From: $fromName <$fromEmail>" . "\r\n";
        $headers .= "Reply-To: $fromEmail" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

        // Build the email body
        $emailBody = "Name: $name<br>";
        $emailBody .= "Email: $email<br>";
        $emailBody .= "Message: $message<br>";

        // Send the email
        if (mail($toEmail, $subject, $emailBody, $headers)) {
            echo '<script>alert("Your contact information is received successfully.")</script>';
        } else {
            echo '<script>alert("There was an error attempting to send your information")</script>';
        }
    }
}

?>
