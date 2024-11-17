<?php
ob_start();
include 'header.php';
include 'sidebar.php';
if (isset($_GET['post_id']) && !empty($_GET['post_id'])) {
    // Get the post_id from the URL
    $post_id = $_GET['post_id'];

    // Query to fetch the feature image of the post
    $query = "SELECT feature_image FROM blog_post WHERE post_id = '$post_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the post data
        $post = mysqli_fetch_assoc($result);
        $feature_image = $post['feature_image'];

        // Delete the feature image if it exists
        if (!empty($feature_image) && file_exists($feature_image)) {
            unlink($feature_image);  // Delete the image from the server
        }

        // Delete the post from the database
        $delete_query = "DELETE FROM blog_post WHERE post_id = '$post_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            $_SESSION['message'] = "Post deleted successfully!";
            $_SESSION['messageType'] = "success";
        } else {
            $_SESSION['message'] = "Failed to delete post. Please try again.";
            $_SESSION['messageType'] = "error";
        }
    } else {
        $_SESSION['message'] = "Post not found. Please try again.";
        $_SESSION['messageType'] = "error";
    }

    // Redirect to the dashboard after deletion
    header('Location: user_dashboard.php');
    exit;
}

ob_end_flush();?>

<?php include 'footer.php'; ?>