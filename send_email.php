<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration (Using Brevo / Sendinblue)
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';  // Brevo SMTP Server
        $mail->SMTPAuth = true;
        $mail->Username = 'aryanst800@gmail.com'; // Your Brevo Email
        $mail->Password = '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';  // Your Brevo SMTP API Key
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email Details
        $mail->setFrom($email, $name);
        $mail->addAddress('aryanst800@gmail.com'); // Destination Email
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Send Email
        if ($mail->send()) {
            echo "Success";
        } else {
            echo "Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>
