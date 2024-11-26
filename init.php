<?php
$protected_pages = [
    'add-new-post.php',
    'admin_action.php',
    'admin_dashboard.php',
    'admin_sidebar.php',
    'approve_post.php',
    'category_management.php',
    'change-status.php',
    'db.php',
    'delete_profile_picture.php',
    'delete-post.php',
    'edit-post.php',
    'fetch-post.php',
    'media.php',
    'reject_post.php',
    'sendmail.php',
    'sidebar.php',
    'update_post_status.php',
    'upload_profile_picture.php',
    'user_dashboard.php',
    'init.php',
];

// Get the current script name
$current_page = basename($_SERVER['PHP_SELF']);

// Check if the current page is in the protected list and the user is not logged in
if (in_array($current_page, $protected_pages) && !isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>


