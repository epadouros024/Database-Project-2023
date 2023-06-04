<?php
session_start(); // Start the session at the beginning

if (isset($_SESSION['user_id'])) {
    // Unset user_id session variable
    unset($_SESSION['user_id']);
}

// Destroy the session
session_destroy();
// Redirect the user to the login page
header('Location: login.html');
exit();
?>