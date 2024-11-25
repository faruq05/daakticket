<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report_id = intval($_POST['report_id']);
    $post_id = intval($_POST['post_id']);
    $action = $_POST['action'];
    $rejection_reason = isset($_POST['rejection_reason']) ? mysqli_real_escape_string($conn, $_POST['rejection_reason']) : '';

    if ($action === 'accept') {
        // Reject the post and update its status
        $update_post_query = "UPDATE blog_post SET status = 'rejected', rejection_reason = '$rejection_reason' WHERE post_id = $post_id";
        mysqli_query($conn, $update_post_query);

        // Delete the report
        $delete_report_query = "DELETE FROM report_post WHERE report_id = $report_id";
        mysqli_query($conn, $delete_report_query);

    } elseif ($action === 'deny') {
        // Simply delete the report
        $delete_report_query = "DELETE FROM report_post WHERE report_id = $report_id";
        mysqli_query($conn, $delete_report_query);
    }

    // Redirect back to the manage posts page
    header("Location: approve_post.php?tab=report");
    exit();
}
?>
