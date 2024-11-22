<?php
session_start();

// Set the logout success message
$_SESSION['message'] = "Successfully logged out!";
$_SESSION['messageType'] = "success";

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit;
?>

