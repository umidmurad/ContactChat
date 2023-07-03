<?php
header("Access-Control-Allow-Origin: https://umid.dev");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

function sanitizeInput($input)
{
    // Sanitize the input to prevent any malicious content
    $sanitizedInput = trim($input);
    $sanitizedInput = htmlspecialchars($sanitizedInput);
    return $sanitizedInput;
}

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $message = sanitizeInput($_POST["message"]);

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "The email address is invalid.";
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
            $response['message'] = "Your contact information is received successfully.";
        } else {
            $response['message'] = "There was an error attempting to send your information.";
        }
    }
} else {
    $response['message'] = "Invalid request method.";
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
