<?php
include("config/connect.php");  // database & sendOtpEmail()
include('include/login_header.php');

// Initialize errors array if not set
if (!isset($errors)) { $errors = array(); }

// Ensure user verified OTP before accessing this page
if (!isset($_SESSION['fp_verified']) || $_SESSION['fp_verified'] !== true) {
    header('Location: forgot_password_1.php');
    exit();
}

// Handle new password submission
if (isset($_POST['fp_step3'])) {
    $new_password = mysqli_real_escape_string($db, $_POST['fp_new_password']);
    $confirm_password = mysqli_real_escape_string($db, $_POST['fp_confirm_password']);
    $email = $_SESSION['fp_email'];

    if (empty($new_password)) {
        array_push($errors, "Password is required");
    }
    if (empty($confirm_password)) {
        array_push($errors, "Confirm Password is required");
    }
    if ($new_password !== $confirm_password) {
        array_push($errors, "Passwords do not match");
    }

    if (count($errors) == 0) {
        // Hash the new password
        $passwordHash = password_hash($new_password, PASSWORD_ARGON2ID);

        // Update in database
        $query = "UPDATE login_info SET password='$passwordHash' WHERE email='$email'";
        mysqli_query($db, $query);

        // Clear OTP verification sessions
        unset($_SESSION['fp_otp']);
        unset($_SESSION['fp_otp_time']);
        unset($_SESSION['fp_verified']);
        unset($_SESSION['fp_email']);

        // Set a one-time alert for login page
        $_SESSION['password_changed'] = true;

        // Redirect to login page
        header('Location: login_page.php');
        exit();
    }
}
?>

<div class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 f-p-card-container">
    <div class="card shadow p-4 f-p-card">
        <h2 class="text-center mb-4">Forgot Password</h2>
        <form method="post" action="">
            <?php include("config/errors.php"); ?>
            <div class="mb-3">
                <label for="fp_new_password" class="form-label">Enter new Password</label>
                <input type="password" id="fp_new_password" class="form-control" placeholder="Enter new Password" name="fp_new_password">
            </div>
            <div class="mb-3">
                <label for="fp_confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="fp_confirm_password" class="form-control" placeholder="Confirm Password" name="fp_confirm_password">
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-primary f-p-button f-p-button-hover" name="fp_step3">Change Password</button>
            </div>
        </form>
        <div class="text-center">
            <a href="login_page.php" class="text-decoration-none link-option-color link-option-color-hover">Back to login</a>
        </div>
    </div>
</div>

<?php include("include/footer.php"); ?>
