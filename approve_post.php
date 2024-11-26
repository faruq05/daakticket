<?php
include 'header.php';
include 'admin_sidebar.php';

// Ensure admin is logged in
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1001) {
    header("Location: login.php");
    exit();
}
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'pending';
$pending_search_query = isset($_GET['pending_search']) ? mysqli_real_escape_string($conn, $_GET['pending_search']) : '';
$approved_search_query = isset($_GET['approved_search']) ? mysqli_real_escape_string($conn, $_GET['approved_search']) : '';
$rejected_search_query = isset($_GET['rejected_search']) ? mysqli_real_escape_string($conn, $_GET['rejected_search']) : '';

//pending
$pending_posts_query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, u.username, bp.created_at 
                        FROM blog_post bp
                        INNER JOIN user u ON bp.user_id = u.user_id
                        WHERE bp.status = 'pending' AND (bp.title LIKE '%$pending_search_query%' 
                                                        OR bp.content LIKE '%$pending_search_query%' 
                                                        OR u.username LIKE '%$pending_search_query%')
                        ORDER BY bp.created_at DESC";
$pending_posts = mysqli_query($conn, $pending_posts_query);

//approved
$approved_posts_query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, u.username, bp.created_at 
                         FROM blog_post bp
                         INNER JOIN user u ON bp.user_id = u.user_id
                         WHERE bp.status = 'approved' AND (bp.title LIKE '%$approved_search_query%' 
                                                            OR bp.content LIKE '%$approved_search_query%' 
                                                            OR u.username LIKE '%$approved_search_query%')
                         ORDER BY bp.created_at DESC";
$approved_posts = mysqli_query($conn, $approved_posts_query);

//rejected
$rejected_posts_query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, u.username, bp.created_at, bp.rejection_reason 
                         FROM blog_post bp
                         INNER JOIN user u ON bp.user_id = u.user_id
                         WHERE bp.status = 'rejected' AND (bp.title LIKE '%$rejected_search_query%' 
                                                           OR bp.content LIKE '%$rejected_search_query%' 
                                                           OR u.username LIKE '%$rejected_search_query%')
                         ORDER BY bp.created_at DESC";
$rejected_posts = mysqli_query($conn, $rejected_posts_query);

//reported
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'pending';
$reported_posts_query = "SELECT rp.report_id, 
           bp.post_id, 
           bp.title, 
           bp.content, 
           bp.created_at, 
           u.user_id AS author_user_id,
           u.username AS author, 
           r.user_id AS reporter_user_id, 
           r.username AS reporter, 
           rp.report_reason, 
           rp.report_date, 
           rp.status, 
           rp.dismiss_reason
    FROM report rp
    INNER JOIN blog_post bp ON rp.post_id = bp.post_id
    INNER JOIN user u ON bp.user_id = u.user_id
    INNER JOIN user r ON rp.user_id = r.user_id
    WHERE rp.status = '$filter_status'
    ORDER BY rp.report_date DESC";
$reported_posts = mysqli_query($conn, $reported_posts_query);

?>

<div class="main dashboard">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 cp60 dash_font" id="manage-posts">
                <h2 class="text-center mt-4 mb-2">Manage Posts</h2>
                <p class="text-center">Approve, reject, or review posts submitted by users.</p>

                <!-- Tabs -->
                <div class="menu_tab">
                    <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($current_tab == 'pending' ? 'active' : ''); ?>"
                                id="pills-pending-tab" data-bs-toggle="pill" data-bs-target="#pills-pending"
                                type="button" role="tab" aria-controls="pills-pending"
                                aria-selected="<?php echo ($current_tab == 'pending' ? 'true' : 'false'); ?>">
                                Pending Posts
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($current_tab == 'approved' ? 'active' : ''); ?>"
                                id="pills-approved-tab" data-bs-toggle="pill" data-bs-target="#pills-approved"
                                type="button" role="tab" aria-controls="pills-approved"
                                aria-selected="<?php echo ($current_tab == 'approved' ? 'true' : 'false'); ?>">
                                Approved Posts
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($current_tab == 'rejected' ? 'active' : ''); ?>"
                                id="pills-rejected-tab" data-bs-toggle="pill" data-bs-target="#pills-rejected"
                                type="button" role="tab" aria-controls="pills-rejected"
                                aria-selected="<?php echo ($current_tab == 'rejected' ? 'true' : 'false'); ?>">
                                Rejected Posts
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($current_tab == 'report' ? 'active' : ''); ?>"
                                id="pills-report-tab" data-bs-toggle="pill" data-bs-target="#pills-report" type="button"
                                role="tab" aria-controls="pills-report"
                                aria-selected="<?php echo ($current_tab == 'report' ? 'true' : 'false'); ?>">
                                Report Posts
                            </button>
                        </li>
                    </ul>

                    <!-- tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Pending Posts Tab -->
                        <div class="tab-pane  <?php echo ($current_tab == 'pending' ? 'show active' : ''); ?>"
                            id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                            <!-- Search form for Pending Posts -->
                            <form action="" method="get" class="mb-4">
                                <input type="hidden" name="tab" value="pending">
                                <div class="input-group">
                                    <input type="text" name="pending_search" class="form-control"
                                        placeholder="Search by title, content, or author"
                                        value="<?php echo htmlspecialchars($pending_search_query); ?>">
                                    <button class="btn btn-cscolor" type="submit">Search</button>
                                </div>
                            </form>
                            <?php displayPostsTable($pending_posts, 'pending'); ?>
                        </div>

                        <!-- Approved Posts Tab -->
                        <div class="tab-pane  <?php echo ($current_tab == 'approved' ? 'show active' : ''); ?>"
                            id="pills-approved" role="tabpanel" aria-labelledby="pills-approved-tab">
                            <!-- Search form for Approved Posts -->
                            <form action="" method="get" class="mb-4">
                                <input type="hidden" name="tab" value="approved">
                                <div class="input-group">
                                    <input type="text" name="approved_search" class="form-control"
                                        placeholder="Search by title, content, or author"
                                        value="<?php echo htmlspecialchars($approved_search_query); ?>">
                                    <button class="btn btn-cscolor" type="submit">Search</button>
                                </div>
                            </form>
                            <?php displayPostsTable($approved_posts, 'approved'); ?>
                        </div>

                        <!-- Rejected Posts Tab -->
                        <div class="tab-pane  <?php echo ($current_tab == 'rejected' ? 'show active' : ''); ?>"
                            id="pills-rejected" role="tabpanel" aria-labelledby="pills-rejected-tab">
                            <!-- Search form for Rejected Posts -->
                            <form action="" method="get" class="mb-4">
                                <input type="hidden" name="tab" value="rejected">
                                <div class="input-group">
                                    <input type="text" name="rejected_search" class="form-control"
                                        placeholder="Search by title, content, or author"
                                        value="<?php echo htmlspecialchars($rejected_search_query); ?>">
                                    <button class="btn btn-cscolor" type="submit">Search</button>
                                </div>
                            </form>
                            <?php displayPostsTable($rejected_posts, 'rejected'); ?>
                        </div>

                        <!-- Reported Posts Tab -->
                        <div class="tab-pane <?php echo ($current_tab == 'report' ? 'show active' : ''); ?>"
                            id="pills-report" role="tabpanel" aria-labelledby="pills-report-tab">

                            <?php if (mysqli_num_rows($reported_posts) > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Post Title</th>
                                                <th>Reported By</th>
                                                <th>Author</th>
                                                <th>Reason</th>
                                                <th>Reported At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; ?>
                                            <?php while ($report = mysqli_fetch_assoc($reported_posts)): ?>
                                                <tr>
                                                    <td><?php echo $counter++; ?></td>
                                                    <td><a href="view-post.php?post_id=<?php echo $report['post_id']; ?>">
                                                            <?php echo htmlspecialchars($report['title']); ?></a></td>
                                                    <td><a
                                                            href="profile.php?user_id=<?php echo $report['reporter_user_id']; ?>"><?php echo htmlspecialchars($report['reporter']); ?></a>
                                                    </td>
                                                    <td><a
                                                            href="profile.php?user_id=<?php echo $report['author_user_id']; ?>"><?php echo htmlspecialchars($report['author']); ?></a>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($report['report_reason']); ?></td>
                                                    <td><?php echo date('d/m/Y H:i:s', strtotime($report['report_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <form action="resolve_report.php" method="POST" class="d-inline">
                                                            <input type="hidden" name="report_id"
                                                                value="<?php echo $report['report_id']; ?>">
                                                            <input type="hidden" name="post_id"
                                                                value="<?php echo $report['post_id']; ?>">
                                                            <!-- Reject Post -->
                                                            <div class="mb-2">
                                                                <label for="reject_reason_<?php echo $report['report_id']; ?>"
                                                                    class="form-label">Rejection Reason:</label>
                                                                <textarea name="rejection_reason"
                                                                    id="reject_reason_<?php echo $report['report_id']; ?>"
                                                                    class="form-control mb-2"
                                                                    placeholder="Enter rejection reason" rows="3"></textarea>
                                                                <button type="submit" name="action" value="reject"
                                                                    class="btn btn-danger btn-sm">Reject Post</button>
                                                            </div>
                                                            <!-- Dismiss Report -->
                                                            <div>
                                                                <label for="dismiss_reason_<?php echo $report['report_id']; ?>"
                                                                    class="form-label">Dismissal Reason:</label>
                                                                <textarea name="dismiss_reason"
                                                                    id="dismiss_reason_<?php echo $report['report_id']; ?>"
                                                                    class="form-control mb-2"
                                                                    placeholder="Enter dismissal reason" rows="3"></textarea>
                                                                <button type="submit" name="action" value="dismiss"
                                                                    class="btn btn-edit btn-sm">Dismiss Report</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <tbody>
                                    <div class="nothing_found text-center">
                                        <img src="assets/uploads/empty.png" class="img-fluid w-10" alt="nothing">
                                        <p class="text-center mt-4">No Reported posts found.</p>
                                    </div>
                                </tbody>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <a href="admin_dashboard.php" class="btn btn-cs ms-2">Go Back</a>
            </div>
        </div>
    </div>
</div>

<?php
// Function to display posts table based on the status
function displayPostsTable($posts, $tab)
{
    if ($posts && mysqli_num_rows($posts) > 0): ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-white">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <?php if ($tab == 'rejected'): ?>
                                <th>Rejection Reason</th>
                            <?php endif; ?>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                            <tr class="aprv">
                                <td><?php echo $counter++; ?></td>
                                <td>
                                    <strong><a
                                            href="view-post.php?post_id=<?php echo $post['post_id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></strong>
                                    <br>
                                    <small><?php echo htmlspecialchars(substr($post['content'], 0, 50)); ?>...</small>
                                </td>
                                <td><?php echo htmlspecialchars($post['username']); ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($post['created_at'])); ?></td>
                                <?php if ($tab == 'rejected'): ?>
                                    <td><?php echo htmlspecialchars($post['rejection_reason']); ?></td>
                                <?php endif; ?>
                                <td>
                                    <form action="update_post_status.php" method="POST" class="d-inline">
                                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                                        <select name="status" class="form-select mb-2">
                                            <option value="approved">Approve</option>
                                            <option value="rejected">Reject</option>
                                        </select>
                                        <textarea name="rejection_reason" class="form-control mb-2"
                                            placeholder="Reason (if rejected)" rows="2"></textarea>
                                        <button type="submit" class="btn btn-cscolor btn-sm">Submit</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="nothing_found text-center">
            <img src="assets/uploads/empty.png" class="img-fluid w-10" alt="nothing">
            <p class="text-center mt-4">No posts found.</p>
        </div>
    <?php endif;
}
?>
<?php include 'footer.php'; ?>