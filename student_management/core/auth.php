<?php
session_start();

// Check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
}

function redirectToLogin() {
    header("Location: ../auth/login.php");
    exit();
}

 // Get the current user
function getCurrentTeacher() {
    return $_SESSION['teacher'] ?? null;
}

// Logout the user
function logout() {
    // unset the session
    session_destroy();
}