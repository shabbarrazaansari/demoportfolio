<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['comment'];

    // Recipient email (your email address)
    $to = "shabbaransari98@gmail.com";

    // Additional headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Email body
    $email_body = "
    <html>
    <head>
        <title>New Contact Form Submission</title>
    </head>
    <body>
        <h2>Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    </body>
    </html>
    ";

    // Send email
    $mail_sent = mail($to, $subject, $email_body, $headers);

    // Send response back
    header('Content-Type: application/json');
    if ($mail_sent) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you for your message. We will contact you soon!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error sending your message.']);
    }
    exit;
}