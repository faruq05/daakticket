<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_report'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "You must be logged in to report a post.";
        $_SESSION['messageType'] = "error";
        header("Location: login.php");
        exit();
    }

    $user_id = intval($_SESSION['user_id']);
    $post_id = intval($_POST['post_id']);
    $report_reason = $conn->real_escape_string($_POST['report_reason']);
    $report_query = "INSERT INTO report (post_id, report_reason, user_id) 
                     VALUES ('$post_id', '$report_reason', '$user_id')";

    if ($conn->query($report_query)) {
        $_SESSION['message'] = "Thank you for your report. Our team will review it shortly.";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "An error occurred. Please try again.";
        $_SESSION['messageType'] = "error";
    }

    header("Location: view-post.php?post_id=$post_id");
    exit();
}
?>