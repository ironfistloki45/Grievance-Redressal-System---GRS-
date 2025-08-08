<?php
$to = "sidduakumalla123@gmail.com";
$subject = "Test Email";
$message = "This is a test email.";
$headers = "From: siddu.maltech@gmail.com";

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
?>
