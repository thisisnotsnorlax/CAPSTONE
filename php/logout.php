<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['users_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page
    header("Location: login.php");
    exit();
}
