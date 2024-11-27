<?php
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view notifications.";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch notifications for likes
$like_notifications_query = "
    SELECT l.created_at, u.username, p.title, p.post_id
    FROM likes l
    INNER JOIN user u ON l.user_id = u.user_id
    INNER JOIN blog_post p ON l.post_id = p.post_id
    WHERE p.user_id = $user_id
    ORDER BY l.created_at DESC
";
$like_notifications_result = mysqli_query($conn, $like_notifications_query);

// Fetch notifications for comments
$comment_notifications_query = "
    SELECT c.created_at, u.username, c.comment_text, p.title, p.post_id
    FROM comment c
    INNER JOIN user u ON c.user_id = u.user_id
    INNER JOIN blog_post p ON c.post_id = p.post_id
    WHERE p.user_id = $user_id
    ORDER BY c.created_at DESC
";
$comment_notifications_result = mysqli_query($conn, $comment_notifications_query);

// Admin accepted a report
$report_accepted_query = "
    SELECT rp.report_id, rp.post_id, bp.title AS post_title
    FROM report rp
    INNER JOIN blog_post bp ON rp.post_id = bp.post_id
    WHERE rp.user_id = $user_id AND rp.status = 'resolved'
    ORDER BY rp.report_date DESC
";
$report_accepted_result = mysqli_query($conn, $report_accepted_query);

// Admin dismissed a report
$report_dismissed_query = "
    SELECT rp.report_id, rp.post_id, rp.dismiss_reason, bp.title AS post_title
    FROM report rp
    INNER JOIN blog_post bp ON rp.post_id = bp.post_id
    WHERE rp.user_id = $user_id AND rp.status = 'dismissed'
    ORDER BY rp.report_date DESC
";
$report_dismissed_result = mysqli_query($conn, $report_dismissed_query);

// Admin rejected a post for post owner
$post_rejected_query = "
    SELECT rp.report_id, rp.post_id, bp.title AS post_title
    FROM report rp
    INNER JOIN blog_post bp ON rp.post_id = bp.post_id
    WHERE rp.user_id = $user_id AND rp.status = 'rejected'
    ORDER BY rp.report_date DESC
";
$post_rejected_result = mysqli_query($conn, $post_rejected_query);
?>

<!-- Modal HTML -->
<div class="modal fade noti-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"><i class="lni lni-bell-1 pe-2"></i>Notifications</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Notification Center -->
                <div class="col-md-12 add_post cp60 dash_font" id="notification">
                    <div class="notification-panel">
                        <div class="accordion" id="accordionExample">
                            <!-- Like Notification -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#like_panel" aria-expanded="false" aria-controls="like_panel">
                                        <h4><i class="lni lni-thumbs-up-3 pe-2"></i>Likes</h4>
                                    </button>
                                </h2>
                                <div id="like_panel" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php if ($like_notifications_result && mysqli_num_rows($like_notifications_result) > 0): ?>
                                            <ul class="notification-list">
                                                <?php while ($like = mysqli_fetch_assoc($like_notifications_result)): ?>
                                                    <li>
                                                        <strong><?php echo htmlspecialchars($like['username']); ?></strong>
                                                        liked your post
                                                        <a href="view-post.php?post_id=<?php echo $like['post_id']; ?>">
                                                            "<?php echo htmlspecialchars($like['title']); ?>"
                                                        </a>
                                                        on <?php echo date('d/m/Y H:i:s', strtotime($like['created_at'])); ?>.
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="nothing_found text-center mt-2">
                                                <img src="assets/uploads/like.png" class="img-fluid w-10" alt="like">
                                                <p class="text-center mt-4">No likes yet.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Comment Notification -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <h4><i class="lni lni-comment-1-text pe-2"></i>Comments</h4>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php if ($comment_notifications_result && mysqli_num_rows($comment_notifications_result) > 0): ?>
                                            <ul class="notification-list">
                                                <?php while ($comment = mysqli_fetch_assoc($comment_notifications_result)): ?>
                                                    <li>
                                                        <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                                                        commented on your post
                                                        <a href="view-post.php?post_id=<?php echo $comment['post_id']; ?>">
                                                            "<?php echo htmlspecialchars($comment['title']); ?>"
                                                        </a>:
                                                        <q><?php echo htmlspecialchars($comment['comment_text']); ?></q>
                                                        on
                                                        <?php echo date('d/m/Y H:i:s', strtotime($comment['created_at'])); ?>.
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="nothing_found text-center mt-2">
                                                <img src="assets/uploads/comment.png" class="img-fluid w-10" alt="comment">
                                                <p class="text-center mt-4">No comments yet.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Report Notification -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <h4><svg fill="#000000" width="20px" height="20px" viewBox="0 0 15.93 15.93"
                                                id="alert-triangle-16px" xmlns="http://www.w3.org/2000/svg"
                                                stroke="#000000" stroke-width="0.00015934" class="me-2">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path id="Path_175" data-name="Path 175"
                                                        d="M-11.036,16H-22.964a1.985,1.985,0,0,1-1.722-.981,1.985,1.985,0,0,1-.031-1.982l5.965-10.852A1.97,1.97,0,0,1-17,1.148a1.97,1.97,0,0,1,1.752,1.037l5.965,10.852a1.985,1.985,0,0,1-.031,1.982A1.985,1.985,0,0,1-11.036,16ZM-17,2.148a.987.987,0,0,0-.876.518l-5.965,10.852a.991.991,0,0,0,.016.991.993.993,0,0,0,.861.491h11.928a.993.993,0,0,0,.861-.491.989.989,0,0,0,.015-.991L-16.124,2.666A.987.987,0,0,0-17,2.148Zm.5,8.352v-6A.5.5,0,0,0-17,4a.5.5,0,0,0-.5.5v6a.5.5,0,0,0,.5.5A.5.5,0,0,0-16.5,10.5Zm0,3v-1A.5.5,0,0,0-17,12a.5.5,0,0,0-.5.5v1a.5.5,0,0,0,.5.5A.5.5,0,0,0-16.5,13.5Z"
                                                        transform="translate(24.967 -1.148)"></path>
                                                </g>
                                            </svg>Report Notifications</h4>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Admin Accepted Report -->
                                        <h5 class="rpttl"><i class="lni lni-check-circle-1 me-2"></i>Accepted Report
                                        </h5>
                                        <?php if ($report_accepted_result && mysqli_num_rows($report_accepted_result) > 0): ?>
                                            <ul class="notification-list">
                                                <?php while ($report = mysqli_fetch_assoc($report_accepted_result)): ?>
                                                    <li>
                                                        The admin has accepted your report. The post titled
                                                        <a href="view-post.php?post_id=<?php echo $report['post_id']; ?>">
                                                            "<?php echo htmlspecialchars($report['post_title']); ?>"
                                                        </a> has been removed.
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="nothing_found text-center">
                                                <img src="assets/uploads/report-alert.png" class="img-fluid w-10"
                                                    alt="report-alert">
                                                <p class="text-center mt-4">No accepted reports yet.</p>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Admin Dismissed Report -->
                                        <h5 class="rpttl"><i class="lni lni-minus-circle me-2"></i>Dismissed Report</h5>
                                        <?php if ($report_dismissed_result && mysqli_num_rows($report_dismissed_result) > 0): ?>
                                            <ul class="notification-list nnl">
                                                <?php while ($report = mysqli_fetch_assoc($report_dismissed_result)): ?>
                                                    <li>
                                                        Your report on
                                                        <a href="view-post.php?post_id=<?php echo $report['post_id']; ?>">
                                                            "<?php echo htmlspecialchars($report['post_title']); ?>"
                                                        </a> was dismissed. <br><b>Reason:</b>
                                                        <?php echo htmlspecialchars($report['dismiss_reason']); ?>
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="nothing_found text-center">
                                                <img src="assets/uploads/report-alert.png" class="img-fluid w-10"
                                                    alt="report-alert">
                                                <p class="text-center mt-4">No dismissed reports yet.</p>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Admin Rejected Post -->
                                        <h5 class="rpttl"><i class="lni lni-xmark-circle me-2"></i></i>Rejected Post
                                        </h5>
                                        <?php if ($post_rejected_result && mysqli_num_rows($post_rejected_result) > 0): ?>
                                            <ul class="notification-list">
                                                <?php while ($post = mysqli_fetch_assoc($post_rejected_result)): ?>
                                                    <li>
                                                        Your post titled
                                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                                            "<?php echo htmlspecialchars($post['post_title']); ?>"
                                                        </a> was rejected by the admin.
                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="nothing_found text-center">
                                                <img src="assets/uploads/report-alert.png" class="img-fluid w-10"
                                                    alt="report-alert">
                                                <p class="text-center mt-4">No rejected posts yet.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>