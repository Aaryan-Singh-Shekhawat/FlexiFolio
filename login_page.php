
<?php
include("config/connect.php");
include('include/login_header.php');

// Check if redirected from forgot_password_3.php with password changed
if (isset($_SESSION['password_changed']) && $_SESSION['password_changed'] === true) {
    echo "<script>alert('Your password has been changed successfully. Please login with the new password.');</script>";
    // Unset the session flag so it only shows once
    unset($_SESSION['password_changed']);
}
?>


<div
        class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 login-card-container">
        <div class="card shadow p-4 login-card">
            <h2 class="text-center mb-4">Login</h2>
            <form method="post" action="login_page.php">
                <?php include("config/errors.php") ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email ID</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your Email ID" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                </div>
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary login-button login-button-hover" name="login_user">Log In</button>
                </div>
                <div class="text-center">
                    <a href="forgot_password_1.php"
                        class="text-decoration-none link-option-color link-option-color-hover">Forgot Password?</a>
                </div>
                <div class="text-center mt-3">
                    <span class="dont-have-acc">Don't have an account? </span>
                    <a href="signup_1.php"
                        class="text-decoration-none link-option-color link-option-color-hover">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
<?php
include("include/footer.php");
?>        