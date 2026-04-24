<?php
include("include/p_header.php");
include("config/login_check.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Show alert once if set
if (!empty($_SESSION['template_alert'])) {
    echo "<script>alert('" . addslashes($_SESSION['template_alert']) . "');</script>";
    unset($_SESSION['template_alert']); // Show only once
}

// DB connection
include __DIR__ . "/config/connect.php";

// Get user's email
$email = $_SESSION['email'] ?? '';

$viewmode = null;
if (!empty($email)) {
    $stmt = mysqli_prepare($db, "SELECT viewmode FROM login_info WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $viewmode);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

// Ensure viewmode is between 0 and 8
if ($viewmode !== null && $viewmode >= 0 && $viewmode <= 8) {
    $page = __DIR__ . "/p_portfolio_{$viewmode}.php";
    if (file_exists($page)) {
        include $page;
    } else {
        echo "<p style='text-align:center; font-weight:bold; margin-top:20px; color:#00ADB5;'>Page for template {$viewmode} not found.</p>";
    }
} else {
    echo "<p style='text-align:center; font-weight:bold; margin-top:20px; color:#00ADB5;'>Invalid template selection.</p>";
}
?>
<?php
include("include/footer.php");
?>
