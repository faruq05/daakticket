<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $role_action = $_POST['role_action'];

    if ($role_action === 'make_admin') {
        $update_query = "UPDATE user SET role_id = 1001 WHERE user_id = $user_id";
        $success_message = "User successfully made an Admin.";

        // If the current logged-in user to admin
        if ($user_id == $_SESSION['user_id']) {
            $_SESSION['role_id'] = 1001;
        }
    } elseif ($role_action === 'make_user') {
        $update_query = "UPDATE user SET role_id = 1002 WHERE user_id = $user_id";
        $success_message = "User successfully made a Regular User.";

        // If the current logged-in user is to user
        if ($user_id == $_SESSION['user_id']) {
            $_SESSION['role_id'] = 1002;
        }
    } elseif ($role_action === 'delete_user') {
        $update_query = "DELETE FROM user WHERE user_id = $user_id";
        $success_message = "User successfully deleted.";

        // Prevent admins from deleting themselves
        if ($user_id == $_SESSION['user_id']) {
            $_SESSION['message'] = "You cannot delete your own account.";
            $_SESSION['messageType'] = "error";
            header("Location: admin_dashboard.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid action selected.";
        $_SESSION['messageType'] = "error";
        header("Location: admin_dashboard.php");
        exit();
    }

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['message'] = $success_message;
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        $_SESSION['messageType'] = "error";
    }

    // Redirect back to admin dashboard
    header("Location: admin_dashboard.php");
    exit();
}