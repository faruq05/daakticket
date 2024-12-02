<?php
session_start();
include('db.php'); 

if (isset($_GET['post_id']) && isset($_GET['status'])) {
    $post_id = $_GET['post_id'];
    $status = $_GET['status'];

    if ($status == 'draft' || $status == 'approved') {
        $query = "UPDATE blog_post SET status = '$status' WHERE post_id = '$post_id'";
        if (mysqli_query($conn, $query)) {
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
