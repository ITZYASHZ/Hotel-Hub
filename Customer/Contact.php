<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Replace with your actual email address
  $recipient = 'your_restaurant_email@example.com';

  $body = "From: $name \n";
  $body .= "Email: $email \n";
  $body .= "Subject: $subject \n\n";
  $body .= "$message";

  if (mail($recipient, $subject, $body)) {
    $message = 'Thank you for contacting us! We will get back to you within 24 hours.';
  } else {
    $message = 'There was an error sending your message. Please try again later.';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - [Restaurant Name]</title>
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

  <h1>Contact Us</h1>

  <?php if (isset($message)) : ?>
    <div class="message"><?php echo $message; ?></div>
  <?php endif; ?>

  <form action="contact.php" method="post">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
      <label for="subject">Subject:</label>
      <input type="text" name="subject" id="subject" required>
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea name="message" id="message" rows="5" required></textarea>
    </div>
    <button type="submit">Send Message</button>
  </form>

</body>
</html>
