<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars(trim($_POST['first-name']));
    $lastName = htmlspecialchars(trim($_POST['last-name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?status=invalid_email");
        exit();
    }

    // Additional validation for phone (if required)
    if (!empty($phone) && !preg_match('/^\+?[0-9\s\-]+$/', $phone)) {
        header("Location: contact.html?status=invalid_phone");
        exit();
    }

    $to = "vincentt.dinh03@gmail.com";
    $subject = "Contact Form Submission from $firstName $lastName";
    $body = "Name: $firstName $lastName\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: contact.html?status=success");
    } else {
        header("Location: contact.html?status=error");
    }
} else {
    header("Location: contact.html?status=invalid_request");
}
?>
