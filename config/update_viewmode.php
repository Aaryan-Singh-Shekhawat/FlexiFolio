<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pull in your existing DB connection ($db)
include __DIR__ . "/connect.php";

// Must be logged in
if (empty($_SESSION['email'])) {
    header("Location: ../login_page.php");
    exit();
}

if (isset($_POST['viewmode'])) {
    $viewmode = (int)$_POST['viewmode'];
    $email    = $_SESSION['email']; // using email from session

    // Ensure $db exists; if not, create it (fallback)
    if (!isset($db) || !$db) {
        $db = mysqli_connect('localhost', 'root', '', 'login_db');
        if (!$db) {
            die("Database connection failed.");
        }
    }

    // Update viewmode in login_info by email
    $stmt = mysqli_prepare($db, "UPDATE login_info SET viewmode = ? WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "is", $viewmode, $email);

    if (mysqli_stmt_execute($stmt)) {
        // ✅ Set a one-time alert message for p_portfolio.php
        $_SESSION['template_alert'] = ($viewmode === 0)
            ? "Template removed successfully."
            : "Template applied successfully.";

        header("Location: ../p_portfolio.php");
        exit();
    } else {
        echo "Error updating view mode.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}
