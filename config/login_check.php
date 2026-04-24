<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Optional: Restrict access if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login_page.php");
    exit();
}

// Check if we need to show login success alert
if (!empty($_SESSION['show_login_alert'])) {
    // Output a JS alert script to show the message once
    echo '<script>alert("You are now logged in");</script>';
    unset($_SESSION['show_login_alert']); // remove so alert shows only once
}
// Check if we need to show signup success alert
if (!empty($_SESSION['show_signup_alert'])) {
    // Output a JS alert script to show the message once
    echo '<script>alert("Signup successful! You are now logged in.");</script>';
    unset($_SESSION['show_signup_alert']); // remove so alert shows only once
}
?>