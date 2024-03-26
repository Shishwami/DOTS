<?php

// Check if a session is active, and if not, start a new session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Unset all of the session variables by assigning an empty array to $_SESSION
$_SESSION = array();

// Destroy the session data on the server
session_destroy();

// Redirect the user to the login page (assuming the login page is located at '../index.php')
header("Location: ../index.php");

// Exit the script to prevent further execution
exit;

?>
