<?php
include 'db.php';
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1001) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_id = mysqli_real_escape_string($conn, $_POST['report_id']);
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);

    if ($action === 'reject') {
        $rejection_reason = mysqli_real_escape_string($conn, $_POST['rejection_reason']);

        // Update the blog_post table
        $update_post_query = "UPDATE blog_post 
                              SET status = 'rejected', rejection_reason = '$rejection_reason' 
                              WHERE post_id = '$post_id'";
        $updated_post_query = mysqli_query($conn, $update_post_query);

        // Update the report status
        $update_report_query = "UPDATE report 
                                SET status = 'resolved' 
                                WHERE report_id = '$report_id'";
        $updated_report_query = mysqli_query($conn, $update_report_query);

        $_SESSION['message'] = "Post rejected successfully.";
        $_SESSION['messageType'] = 'success';

    } elseif ($action === 'dismiss') {
        $dismiss_reason = mysqli_real_escape_string($conn, $_POST['dismiss_reason']);

        //  reposrt status to resolved
        $update_report_query = "UPDATE report 
                                SET status = 'dismissed', dismiss_reason = '$dismiss_reason' 
                                WHERE report_id = '$report_id'";
        $updated_report_query = mysqli_query($conn, $update_report_query);
        $_SESSION['message'] = "Report dismissed successfully";
        $_SESSION['messageType'] = 'success';
    }
}

header("Location: approve_post.php?tab=report");
exit();
?>