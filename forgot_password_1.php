<?php
include("config/connect.php");  // Database & PHPMailer
include('include/login_header.php');

if (!isset($errors)) { 
    $errors = array(); 
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

    // If no errors, generate OTP and redirect
    if (count($errors) == 0) {
        $otp = rand(100000, 999999);
        $_SESSION['fp_email'] = $fp_email;
        $_SESSION['fp_otp'] = $otp;
        $_SESSION['fp_otp_time'] = time(); // store timestamp

        // Send OTP using forgot-password specific function
        if (!sendForgotPasswordOtpEmail($fp_email, $otp)) {
            array_push($errors, "Failed to send OTP. Please try again.");
        } else {
            header('Location: forgot_password_2.php');
            exit();
        }
    }
}
?>

<div class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 f-p-card-container">
    <div class="card shadow p-4 f-p-card">
        <h2 class="text-center mb-4">Forgot Password</h2>
        <form method="post" action="">
            <?php include("config/errors.php"); ?>
            <div class="mb-3">
                <label for="fp_email" class="form-label">Email ID</label>
                <input type="email" id="fp_email" class="form-control" placeholder="Enter your Email ID" name="fp_email"
                       value="<?php echo isset($_POST['fp_email']) ? htmlspecialchars($_POST['fp_email']) : ''; ?>">
            </div>
            <div>
                <button type="submit" class="btn btn-primary f-p-button f-p-button-hover" name="fp_step1">Get OTP</button>
            </div>
            <div class="text-center">
                <a href="login_page.php" class="text-decoration-none link-option-color link-option-color-hover">Back to login</a>
            </div>
        </form>
    </div>
</div>

<?php include("include/footer.php"); ?>
