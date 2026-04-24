<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($showAlert): ?>
        window.onload = function() {
            alert("You are now logged in");
        };
        <?php endif; ?>
    </script>
    <link rel="icon" href="asset/images/icon.png">
    </link>
    <link rel="stylesheet" href="asset/css/style.css" />

    <!-- font_awesome_library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>


<?php

if (isset($_SESSION['email'])) {
    
    // User is logged in — show the logged-in header
    ?>
    <!-- Logged-in header HTML starts -->
    <body>
        <header class="header-details">
            <nav class="navbar navbar-expand-lg navbar-light header-bg-color">
                <div class="container">
                    <a class="header-logo" href="index.php">
                        <img src="asset/images/logo.png" alt="Logo" class="header-logo-hover">
                    </a>
                    <button class="header-menu-hover header-menu navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover"
                                href="p_portfolio.php">My Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_certificates.php">Certificates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_contact_me.php">Contact Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_templates.php">Templates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_templates.php">Create</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="config/logout.php">Logout</a>
                            </li>
                            <li class="nav-item">
                                <p class="header-login-icon-divider">.............</p>
                            </li>
                            <li class="nav-item">
                                <a href="#" title="Hello" data-bs-toggle="popover" data-bs-trigger="focus hover" data-bs-content="<?php echo htmlspecialchars($_SESSION['name']); ?>"><img class="header-login-icon" src="asset/images/header-login-icon.png" alt="header-login-icon"></a>
                                <!-- <i class='fas fa-user-alt header-login-icon header-login-icon-hover'></i> -->
    
                                <!-- Javascript for popup -->
                                <script>
                                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                                var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                                  return new bootstrap.Popover(popoverTriggerEl)
                                })
                                </script>                           
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    <!-- Logged-in header HTML ends -->
    <?php
} else {
    // User is NOT logged in — show the guest header
    ?>
    <!-- Guest header HTML starts -->
    <body>
        <header class="header-details">
            <nav class="navbar navbar-expand-lg navbar-light header-bg-color">
                <div class="container">
                    <a class="header-logo" href="index.php">
                        <img src="asset/images/logo.png" alt="Logo" class="header-logo-hover">
                    </a>
                    <button class="header-menu-hover header-menu navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="menu">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover"
                                href="p_portfolio.php">My Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_certificates.php">Certificates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_contact_me.php">Contact Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_templates.php">Templates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_templates.php">Create</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color menu-text-color menu-text-hover" href="p_templates.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    <!-- Guest header HTML ends -->
    <?php
}
?>

