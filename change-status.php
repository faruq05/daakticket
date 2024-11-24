<?php
session_start();
include('db.php');  // Ensure you have the database connection

if (isset($_GET['post_id']) && isset($_GET['status'])) {
    $post_id = $_GET['post_id'];
    $status = $_GET['status'];

    // Check if the status is either 'draft' or 'approved'
    if ($status == 'draft' || $status == 'approved') {
        // Update the post status in the database
        $query = "UPDATE blog_post SET status = '$status' WHERE post_id = '$post_id'";
        if (mysqli_query($conn, $query)) {
            // Redirect back to the dashboard or the posts page
            header('Location: user_dashboard.php');
            exit();
        } else {
            echo "Error updating post status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid status.";
    }
} else {
    echo "Missing post ID or status.";
}
?>
