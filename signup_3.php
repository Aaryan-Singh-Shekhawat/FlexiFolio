<?php
include("config/connect.php");
include('include/login_header.php');
?>
        <div
        class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 signup-card-container">
        <div class="card shadow p-4 signup-card">
            <h2 class="text-center mb-4">Sign Up</h2>

            <!-- Use same error display style as signup_1.php -->
                 <?php include("config/errors.php") ?>

            <form method="post" action="signup_3.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Enter your Name" name="name">
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Phone Number</label>
                    <input type="tel" id="number" class="form-control" placeholder="Enter your phone Number" inputmode="numeric" name="number">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter a strong Password" name="password">
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" id="cpassword" class="form-control" placeholder="Re-enter Password" name="cpassword">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary signup-button signup-button-hover" name="signup_user">Signup</button>
                </div>
                <div class="text-center">
                    <a href="login_page.php"
                        class="text-decoration-none link-option-color link-option-color-hover">Back to login</a>
                </div>
            </form>
        </div>
    </div>
<?php
include("include/footer.php");
?>        