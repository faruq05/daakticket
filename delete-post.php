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
            // // add the delete history in post_history
            // $change_description = "Deleted post: " . $post['title'];
            // $log_query = "INSERT INTO post_history (post_id, user_id, change_description) 
            //               VALUES ('$post_id', '{$_SESSION['user_id']}', '$change_description')";
            // mysqli_query($conn, $log_query);

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
    if ($_SESSION['role_id'] == 1001) {
        header('Location: user_dashboard.php');
        exit();
    } else {
        header('Location: admin_dashboard.php');
        exit();
    }
}

ob_end_flush(); ?>

<?php include 'footer.php'; ?>