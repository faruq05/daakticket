<?php
include 'db.php';
// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = intval($_POST['post_id']);
    $report_reason = $conn->real_escape_string($_POST['report_reason']);

    // Insert report into the database
    $report_query = "INSERT INTO report (post_id, report_reason) VALUES ('$post_id', '$report_reason')";

    if (mysqli_query($conn, $report_query)) {
        $_SESSION['message'] = "Thank you for your report. Our team will review it shortly.";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "An error occurred. Please try again.";
        $_SESSION['messageType'] = "error";
    }
    header('Location: view-post.php?post_id=' . $post_id . '#like_section');
    exit();
}

include 'footer.php';
?>