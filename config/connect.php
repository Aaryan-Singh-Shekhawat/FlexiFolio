<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/Exception.php';
require __DIR__ . '/../PHPMailer/PHPMailer.php';
require __DIR__ . '/../PHPMailer/SMTP.php';



// initializing variables
$name = "";
$number = "";
$email = "";
$password = "";
$cpassword = "";
$errors = array();

// connecting to the database
$db = mysqli_connect('localhost', 'root', '', 'login_db');

// Function to send OTP using PHPMailer
function sendOtpEmail($to, $otp) {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'flexifolio.noreply@gmail.com';
        $mail->Password   = 'lcxv yfcf cuxs rgmq'; // app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('flexifolio.noreply@gmail.com', 'FlexiFolio');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'FlexiFolio Email Verification  Your OTP Code';
        $mail->Body    = "
            <p>Hello,</p>
            <p>Thank you for choosing <b>FlexiFolio</b>. To verify your email address and continue the signup process, please use the One-Time Password (OTP) below:</p>
            <p style='font-size:20px; font-weight:bold; color:#2d89ef;'>OTP: $otp</p>
            <p>This OTP is valid for <b>10 minutes</b>. For your security, do not share it with anyone.</p>
            <p>If you did not request this, please ignore this email.</p>
            <br>
            <p>Best regards,<br>Team FlexiFolio</p>
        ";

        $mail->AltBody = "Hello,\n\nThank you for choosing FlexiFolio. To verify your email address and continue the signup process, please use the One-Time Password (OTP) below:\n\n👉 $otp\n\nThis OTP is valid for 10 minutes. For your security, do not share it with anyone.\n\nIf you did not request this, please ignore this email.\n\nBest regards,\nTeam FlexiFolio";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// signup step 1: email only
if (isset($_POST['signup_step1'])) {
    $signup1_email = strtolower(mysqli_real_escape_string($db, $_POST['signup1_email']));

    if (empty($signup1_email)) { 
        array_push($errors, "Email ID is required"); 
    }

    // check if email exists
    $user_check_query = "SELECT * FROM login_info WHERE LOWER(email) = '$signup1_email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { 
        if ($user['email'] === $signup1_email) {
            array_push($errors, "Email ID already exists");
        }
    }

    // store email in session and generate OTP if no errors
    if (count($errors) == 0) {
        $_SESSION['signup_email'] = $signup1_email;

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        $_SESSION['signup_otp'] = $otp;
        $_SESSION['signup_otp_time'] = time(); // store current timestamp

        // Send OTP via PHPMailer
        if (!sendOtpEmail($signup1_email, $otp)) {
            array_push($errors, "Failed to send OTP. Please try again.");
        } else {
            // Redirect to signup_2.php
            header('Location: signup_2.php');
            exit();
        }
    }
}

// signup step 2: verify OTP
if (isset($_POST['signup_step2'])) {
    $entered_otp = mysqli_real_escape_string($db, $_POST['signup2_otp']);

    if (empty($entered_otp)) {
        array_push($errors, "Please enter the OTP.");
    } elseif (!isset($_SESSION['signup_otp']) || !isset($_SESSION['signup_otp_time'])) {
        array_push($errors, "OTP session expired. Please go back and try again.");
    } else {
        // Check if OTP expired (10 minutes = 600 seconds)
        if (time() - $_SESSION['signup_otp_time'] > 600) {
            array_push($errors, "OTP has expired. Please request a new one.");
        } elseif ($entered_otp != $_SESSION['signup_otp']) {
            array_push($errors, "Incorrect OTP. Please try again.");
        } else {
            // ✅ OTP correct → mark email as verified (just keep in session)
            $_SESSION['email_verified'] = true;

            // Redirect to step 3
            header('Location: signup_3.php');
            exit();
        }
    }
}

// Resend OTP
if (isset($_POST['resend_otp'])) {
    if (isset($_SESSION['signup_email'])) {
        $otp = rand(100000, 999999);
        $_SESSION['signup_otp'] = $otp;
        $_SESSION['signup_otp_time'] = time(); // reset timestamp

        if (!sendOtpEmail($_SESSION['signup_email'], $otp)) {
            array_push($errors, "Failed to resend OTP. Please try again.");
        } else {
            array_push($errors, "A new OTP has been sent to your email.");
        }
    } else {
        array_push($errors, "Email session expired. Please start signup again.");
    }
}

// signup final step: all details
if (isset($_POST['signup_user'])) { // ← match the button name in signup_3.php
    $name = mysqli_real_escape_string($db, $_POST['name']);           // ← match input name
    $number = mysqli_real_escape_string($db, $_POST['number']);       // ← match input name
    $email = strtolower(mysqli_real_escape_string($db, $_SESSION['signup_email'])); // from step 1
    $password = mysqli_real_escape_string($db, $_POST['password']);   // ← match input name
    $cpassword = mysqli_real_escape_string($db, $_POST['cpassword']); // ← match input name

    // form validation
    if (empty($name)) { array_push($errors, "Name is required"); }
    if (empty($number)) { array_push($errors, "Number is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $cpassword) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        // Hash password using Argon2id
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);

        $query = "INSERT INTO login_info (name, number, email, password, dt) 
                  VALUES ('$name', '$number', '$email', '$passwordHash', current_timestamp())";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        $_SESSION['success'] = "Signup successful! You are now logged in.";
        $_SESSION['show_signup_alert'] = true; // flag to show alert once
        header('Location: p_portfolio.php');
        exit();
    }
}

// Login User
if (isset($_POST['login_user'])) {
    $email = strtolower(mysqli_real_escape_string($db, $_POST['email']));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) { array_push($errors, "Email ID is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    if (count($errors) == 0) {
        $login_query = "SELECT * FROM login_info WHERE LOWER(email) = '$email' LIMIT 1";
        $results = mysqli_query($db, $login_query);
        $user = mysqli_fetch_assoc($results);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $user['name'];
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['show_login_alert'] = true;
            header('Location: p_portfolio.php');
            exit();
        } else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}

// New function for Forgot Password OTP (Formal Style)
function sendForgotPasswordOtpEmail($to, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'flexifolio.noreply@gmail.com';
        $mail->Password   = 'lcxv yfcf cuxs rgmq'; // app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('flexifolio.noreply@gmail.com', 'FlexiFolio');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'FlexiFolio Password Reset OTP';
        $mail->Body = "
            <p>Hello,</p>
            <p>You have requested to reset your FlexiFolio account password. Please use the One-Time Password (OTP) below to proceed with resetting your password:</p>
            <p style='font-size:20px; font-weight:bold; color:#2d89ef;'>OTP: $otp</p>
            <p>This OTP is valid for 10 minutes. For security reasons, do not share it with anyone. If you did not request this, please ignore this email.</p>
            <br>
            <p>Best regards,<br>Team FlexiFolio</p>
        ";
        $mail->AltBody = "Hello,\n\nYou have requested to reset your FlexiFolio account password. Your OTP is: $otp\n\nThis OTP is valid for 10 minutes. Do not share it with anyone. If you did not request this, ignore this email.\n\nBest regards,\nTeam FlexiFolio";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>

