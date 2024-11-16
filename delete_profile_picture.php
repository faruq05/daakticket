<?php
session_start();
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT profile_picture FROM User_Profile WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$profile_picture = $row['profile_picture'];

if ($profile_picture && file_exists($profile_picture)) {
    unlink($profile_picture);

    // Update the database to set profile_picture to NULL
    $update_query = "UPDATE User_Profile SET profile_picture = NULL WHERE user_id = '$user_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        $_SESSION['message'] = "Profile picture deleted successfully!";
        $_SESSION['messageType'] = 'success';
    } else {
        $_SESSION['message'] = "Failed to delete profile picture from the database!";
        $_SESSION['messageType'] = 'error';
    }
} else {
    $_SESSION['message'] = "No profile picture to delete.";
    $_SESSION['messageType'] = 'error';
}

// Redirect back to the profile page
header('Location:user_dashboard.php');
exit();
