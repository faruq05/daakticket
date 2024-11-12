<?php
session_start(); // Start the session

// Destroy all session variables and log out the user
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect the user to the login page or homepage
header("Location: index.php"); // You can change this to any page where you want to redirect
exit();
?>