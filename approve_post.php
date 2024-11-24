<?php
include 'header.php';
include 'sidebar.php';

// Ensure admin is logged in
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1001) {
    header("Location: login.php");
    exit();
}
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'pending';
$pending_search_query = isset($_GET['pending_search']) ? mysqli_real_escape_string($conn, $_GET['pending_search']) : '';
$approved_search_query = isset($_GET['approved_search']) ? mysqli_real_escape_string($conn, $_GET['approved_search']) : '';
$rejected_search_query = isset($_GET['rejected_search']) ? mysqli_real_escape_string($conn, $_GET['rejected_search']) : '';

// Fetch posts based on status
$pending_posts_query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, u.username, bp.created_at 
                        FROM blog_post bp
                        INNER JOIN user u ON bp.user_id = u.user_id
                        WHERE bp.status = 'pending' AND (bp.title LIKE '%$pending_search_query%' 
                                                        OR bp.content LIKE '%$pending_search_query%' 
                                                        OR u.username LIKE '%$pending_search_query%')
                        ORDER BY bp.created_at DESC";
$pending_posts = mysqli_query($conn, $pending_posts_query);

$approved_posts_query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, u.username, bp.created_at 
                         FROM blog_post bp
                         INNER JOIN user u ON bp.user_id = u.user_id
                         WHERE bp.status = 'approved' AND (bp.title LIKE '%$approved_search_query%' 
                                                            OR bp.content LIKE '%$approved_search_query%' 
                                                            OR u.username LIKE '%$approved_search_query%')
                         ORDER BY bp.created_at DESC";
$approved_posts = mysqli_query($conn, $approved_posts_query);

$rejected_posts_query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, u.username, bp.created_at, bp.rejection_reason 
                         FROM blog_post bp
                         INNER JOIN user u ON bp.user_id = u.user_id
                         WHERE bp.status = 'rejected' AND (bp.title LIKE '%$rejected_search_query%' 
                                                           OR bp.content LIKE '%$rejected_search_query%' 
                                                           OR u.username LIKE '%$rejected_search_query%')
                         ORDER BY bp.created_at DESC";
$rejected_posts = mysqli_query($conn, $rejected_posts_query);
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
                    </ul>
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