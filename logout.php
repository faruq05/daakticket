<?php
session_start();
include 'db.php';

// Get the user ID from the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // logout time and null session token
    $update_logout_query = "
        UPDATE session 
        SET logout_timestamp = NOW(), session_token = NULL 
        WHERE user_id = $user_id";
    $updated_logout_query= mysqli_query($conn, $update_logout_query);
}

$_SESSION['message'] = "Successfully logged out!";
$_SESSION['messageType'] = "success";

// Destroy the session
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>
