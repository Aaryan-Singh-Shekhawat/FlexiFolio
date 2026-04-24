<?php
if (!empty($errors)) {
    // Remove the specific "Email session expired. Please start signup again." message
    $errors = array_filter($errors, function($e) {
        return $e !== "Email session expired. Please start signup again.";
    });

    echo '<div class="alert alert-danger">';
    foreach ($errors as $error) {
        echo '<p>' . htmlspecialchars($error) . '</p>';
    }
    echo '</div>';
}
?>
