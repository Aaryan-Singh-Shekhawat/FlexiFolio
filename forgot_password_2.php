<?php
// Start session at the very top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("config/connect.php");  // Database & PHPMailer
include('include/login_header.php');

// Initialize errors array if not set
if (!isset($errors)) { $errors = array(); }

// Ensure user has already submitted email in step 1
if (!isset($_SESSION['fp_email'])) {
    header('Location: forgot_password_1.php');
    exit();
}

// Handle OTP submission
if (isset($_POST['fp_step2'])) {
    $entered_otp = mysqli_real_escape_string($db, $_POST['fp_otp']);

    if (empty($entered_otp)) {
        array_push($errors, "Please enter the OTP.");
    } elseif (!isset($_SESSION['fp_otp']) || !isset($_SESSION['fp_otp_time'])) {
        array_push($errors, "OTP session expired. Please go back and try again.");
    } else {
        if (time() - $_SESSION['fp_otp_time'] > 600) {
            array_push($errors, "OTP has expired. Please request a new one.");
        } elseif ($entered_otp != $_SESSION['fp_otp']) {
            array_push($errors, "Incorrect OTP. Please try again.");
        } else {
            $_SESSION['fp_verified'] = true;
            header('Location: forgot_password_3.php');
            exit();
        }
    }
}

// Handle Resend OTP
if (isset($_POST['resend_otp'])) {
    if (isset($_SESSION['fp_email'])) {
        $otp = rand(100000, 999999);
        $_SESSION['fp_otp'] = $otp;
        $_SESSION['fp_otp_time'] = time();

        if (!sendForgotPasswordOtpEmail($_SESSION['fp_email'], $otp)) {
            array_push($errors, "Failed to resend OTP. Please try again.");
        } else {
            array_push($errors, "A new OTP has been sent to your email.");
        }
    } else {
        array_push($errors, "Email session expired. Please start forgot password again.");
    }
}
?>

<div class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 f-p-card-container">
    <div class="card shadow p-4 f-p-card">
        <h2 class="text-center mb-4">Forgot Password</h2>
        <p style="text-align: center;">An OTP has been sent to your email. Please enter it below.</p>

        <form method="post" action="">
            <?php include("config/errors.php"); ?>
            <div class="mb-3">
                <label for="fp_otp" class="form-label">OTP</label>
                <input type="text" id="fp_otp" class="form-control" placeholder="Enter your OTP" name="fp_otp">
            </div>
            <div>
                <button type="submit" class="btn btn-primary f-p-button f-p-button-hover" name="fp_step2">Submit</button>
            </div>
        </form>

        <div class="text-center mt-2">
            <form method="post" action="">
                <button type="submit" class="btn btn-link p-0 text-decoration-none link-option-color link-option-color-hover" name="resend_otp">
                    Resend OTP
                </button>
            </form>
        </div>

        <div class="text-center mt-2">
            <a href="login_page.php" class="text-decoration-none link-option-color link-option-color-hover">Back to login</a>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
