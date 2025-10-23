<?php
session_start();
include 'includes/db_connect.php';
$message_status = '';
if (isset($_POST['submit_contact'])) {
    $name = $conn->real_escape_string($_POST['sender_name']);
    $email = $conn->real_escape_string($_POST['sender_email']);
    $message = $conn->real_escape_string($_POST['message_body']);

    $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $message_status = "<p class='success-message'>Thank you for contacting us! We will be in touch soon.</p>";
    } else {
        $message_status = "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact - Mauritius Guide</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .success-message { color: green; font-weight: bold; }
        .error-message { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <section class="section contact-section">
        <h2>Contact Us</h2>
        <p>We’d love to hear from you! Send us your queries or feedback.</p>

        <?= $message_status ?>

        <form class="contact-form" method="POST" action="contact.php">
            <input type="text" placeholder="Your Name" name="sender_name" required />
            <input type="email" placeholder="Your Email" name="sender_email" required />
            <textarea placeholder="Your Message" rows="5" name="message_body" required></textarea>
            <button type="submit" name="submit_contact">Send Message</button>
        </form>
    </section>
</body>
</html>
