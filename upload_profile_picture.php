<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id']; // Assuming role_id is stored in the session

// Check if the file was uploaded
if (isset($_FILES['profile_picture'])) {
    $file = $_FILES['profile_picture'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = mime_content_type($file_tmp);

    if (in_array($file_type, $allowed_types)) {
        if ($file_size < 5000000) { // Max 5MB
            // Generate a unique filename
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = 'profile_' . $user_id . '.' . $file_ext;
            $file_path = 'assets/uploads/profile_pictures/' . $new_file_name;

            // Move the uploaded file to the uploads folder
            if (move_uploaded_file($file_tmp, $file_path)) {
                $update_query = "UPDATE User_Profile SET profile_picture = '$file_path' WHERE user_id = '$user_id'";
                $update_result = mysqli_query($conn, $update_query);

                if ($update_result) {
                    $_SESSION['message'] = "Profile picture updated successfully!";
                    $_SESSION['messageType'] = 'success';
                } else {
                    $_SESSION['message'] = "Failed to update profile picture in the database!";
                    $_SESSION['messageType'] = 'error';
                }
            } else {
                $_SESSION['message'] = "Failed to upload the profile picture!";
                $_SESSION['messageType'] = 'error';
            }
        } else {
            $_SESSION['message'] = "File size exceeds the limit of 5MB!";
            $_SESSION['messageType'] = 'error';
        }
    } else {
        $_SESSION['message'] = "Invalid file type. Only images are allowed!";
        $_SESSION['messageType'] = 'error';
    }
}

// Role-based redirection
if ($role_id == 1001) { // Admin
    header('Location: admin_dashboard.php');
} else { // Regular user
    header('Location: user_dashboard.php');
}
exit();
