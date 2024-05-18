<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Email configuration
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //Server settings
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                       // SMTP server
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'somalanguages@gmail.com';                 // SMTP username (your Gmail email address)
		$mail->Password   = 'vqua fijk robr warz';                  // SMTP password
		$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption
		$mail->Port       = 587;                                    // TCP port to connect to


        // Recipients
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('somalanguages@gmail.com', 'Tutor');   // Add a recipient
        $mail->addReplyTo($_POST['email'], $_POST['name']);

        // Content
        $mail->isHTML(false);                                       // Set email format to plain text
        $mail->Subject = 'Contact Form Submission';
        $mail->Body    = "Name: {$_POST['name']}\nEmail: {$_POST['email']}\nPhone: {$_POST['phone']}\nComments: {$_POST['comments']}";

        $mail->send();
        echo "<div class='alert alert-success'>";
        echo "<h3>Email Sent Successfully.</h3>";
        echo "<p>Thank you <strong>{$_POST['name']}</strong>, your message has been submitted to us.</p>";
        echo "</div>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If accessed directly, show an error message or redirect
    echo "Access denied.";
}
?>
