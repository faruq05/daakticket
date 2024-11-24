<?php
session_start();
include 'db.php';

// Ensure admin is logged in
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1001) {
    header("Location: login.php");
    exit();
}

// Validate and process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = intval($_POST['post_id']);
    $status = $_POST['status'];
    $rejection_reason = !empty($_POST['rejection_reason']) ? mysqli_real_escape_string($conn, $_POST['rejection_reason']) : NULL;

    if ($status === 'approved') {
        // Approve the post
        $query = "UPDATE blog_post SET status = 'approved', rejection_reason = NULL WHERE post_id = $post_id";
    } elseif ($status === 'rejected' && $rejection_reason) {
        // Reject the post with a reason
        $query = "UPDATE blog_post SET status = 'rejected', rejection_reason = '$rejection_reason' WHERE post_id = $post_id";
    } else {
        $_SESSION['message'] = "Rejection requires a reason.";
        $_SESSION['messageType'] = "error";
        header("Location: approve_post.php");
        exit();
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Post status updated successfully";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update post status. Please try again.";
        $_SESSION['messageType'] = "error";
    }

    header("Location: approve_post.php");
    exit();
}
?>
