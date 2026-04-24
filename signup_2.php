<?php
include("config/connect.php");
include('include/login_header.php');
?>
<div
    class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 signup-card-container">
    <div class="card shadow p-4 signup-card">
        <h2 class="text-center mb-4">Sign Up</h2>
        <p style="text-align: center;">
            An OTP has been sent to your email. Please enter it below.
        </p>

        <!-- Use same error display style as signup_1.php -->
        <?php include("config/errors.php") ?>

        <form method="post" action="signup_2.php">
            <div class="mb-3">
                <label for="signup2_otp" class="form-label">OTP</label>
                <input type="text" id="signup2_otp" class="form-control" placeholder="Enter your OTP" name="signup2_otp">
            </div>
            <div>
                <button type="submit" class="btn btn-primary signup-button signup-button-hover" name="signup_step2">Submit</button>
            </div>
        </form>
        <div class="text-center mt-2">
            <form method="post" action="signup_2.php">
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
<?php
include("include/footer.php");
?>
