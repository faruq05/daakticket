<?php
include 'db.php';
$post_id = $_GET['post_id'];

$query = "UPDATE blog_post SET status = 'approved' WHERE post_id = '$post_id'";
if (mysqli_query($conn, $query)) {
    $_SESSION['message'] = "Post approved successfully!";
    header("Location: admin_dashboard.php");
} else {
    $_SESSION['message'] = "Failed to approve post.";
    header("Location: admin_dashboard.php");
}