<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("connect.php");  // Database connection
include("errors.php");   // Error handling

// Include PHPMailer classes if not already included in connect.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize errors array if not set
if (!isset($errors)) { $errors = array(); }

// Function for sending forgot password OTP (formal format)
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
        $mail->AltBody = "Hello,\n\nYou have requested to reset your FlexiFolio account password. Please use the OTP below to proceed:\n\nOTP: $otp\n\nThis OTP is valid for 10 minutes. For security reasons, do not share it with anyone. If you did not request this, please ignore this email.\n\nBest regards,\nTeam FlexiFolio";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Handle Phase 1: Email submission
if (isset($_POST['fp_step1'])) {
    $fp_email = strtolower(mysqli_real_escape_string($db, $_POST['fp_email']));

    if (empty($fp_email)) {
        array_push($errors, "Email ID is required");
    } else {
        $query = "SELECT * FROM login_info WHERE LOWER(email) = '$fp_email' LIMIT 1";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            array_push($errors, "Email ID does not exist");
        }
    }

    // If no errors, generate OTP and store in session
    if (count($errors) == 0) {
        $otp = rand(100000, 999999);
        $_SESSION['fp_email'] = $fp_email;
        $_SESSION['fp_otp'] = $otp;
        $_SESSION['fp_otp_time'] = time(); // store timestamp

        // ✅ Send OTP using the formal forgot-password format
        if (!sendForgotPasswordOtpEmail($fp_email, $otp)) {
            array_push($errors, "Failed to send OTP. Please try again.");
        } else {
            // Redirect to next step
            header('Location: ../forgot_password_2.php');
            exit();
        }
    }
}
?>
