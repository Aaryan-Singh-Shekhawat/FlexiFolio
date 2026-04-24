<?php
include("config/connect.php");
include('include/login_header.php');
?>
<div class="container col-md-4 col-sm-6 col-lg-6 col-12 d-flex justify-content-center align-items-center min-vh-100 signup-card-container">
    <div class="card shadow p-4 signup-card">
        <h2 class="text-center mb-4">Sign Up</h2>
        <form method="post" action="signup_1.php">
            <?php include("config/errors.php") ?>
            <div class="mb-3">
                <label for="signup1_email" class="form-label">Email ID</label>
                <input type="email" id="signup1_email" class="form-control" placeholder="Enter your Email ID" name="signup1_email">
            </div>
            <div>
                <button type="submit" class="btn btn-primary signup-button signup-button-hover" name="signup_step1">Submit</button>
            </div>
            <div class="text-center">
                <a href="login_page.php"
                    class="text-decoration-none link-option-color link-option-color-hover">Back to login</a>
            </div>
        </form>
    </div>
</div>

<?php
// Redirect to step 2 if email is valid
if (isset($_POST['signup_step1']) && count($errors) == 0) {
    header('Location: signup_2.php');
    exit();
}

include("include/footer.php");
?>
