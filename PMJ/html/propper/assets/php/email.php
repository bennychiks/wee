<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the email field is set and not empty
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = $_POST["email"];
        
        // Validate the email address using a basic filter
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Add a new line to the text file to store the email
            $file = fopen("subscribed_emails.txt", "a");
            fwrite($file, $email . "\n");
            fclose($file);

            // Send an email to the site owner
            $to = "siteowner@example.com"; // Replace with the site owner's email address
            $subject = "New Subscription";
            $message = "A new email subscription has been made.\nEmail: $email";
            $headers = "From: no-reply@example.com"; // Replace with a suitable 'From' email address
            mail($to, $subject, $message, $headers);

            // Output a success message
            echo "Thank you for subscribing!"; // You can customize this message as needed.
        } else {
            echo "Invalid email address. Please enter a valid email.";
        }
    } else {
        echo "Email field is required.";
    }
}
?>
