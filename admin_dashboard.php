<?php
include 'header.php';
include 'admin_sidebar.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1001) {
    header('Location: login.php');
    exit();
}

// Fetch all posts from the database
$query = "SELECT bp.post_id, bp.title, bp.content, bp.feature_image, bp.created_at, bp.updated_at, 
                 c.category_name 
          FROM blog_post bp 
          LEFT JOIN category c ON bp.category_id = c.category_id 
          ORDER BY bp.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <?php include 'admin_sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="dashboard">
                <h1 class="my-4">Welcome to Admin Dashboard</h1>
                <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>

                <div class="tables-container row">
                    <!-- User Info Section -->
                    <div class="user-info-container col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-light">
                                <h4>User Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-white">
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Role</th>
                                                <th>Registered</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user-info-table">
                                            <!-- User data will be loaded dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Post History Section -->
                    <div class="post-history-container col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-light">
                                <h4>Post History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="table-white">
                                            <tr>
                                                <th>History ID</th>
                                                <th>Post ID</th>
                                                <th>User ID</th>
                                                <th>Change Description</th>
                                            </tr>
                                        </thead>
                                        <tbody id="post-history-table">
                                            <!-- Post history data will be loaded dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display Existing Posts -->
                <h2 class="mt-4 p-4">Existing Posts</h2>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($post = mysqli_fetch_assoc($result)): ?>
                        <div class="exist_post mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="post_ftimg">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <?php if (!empty($post['feature_image']) && file_exists($post['feature_image'])) { ?>
                                                <img src="<?php echo $post['feature_image']; ?>" class="img-fluid" alt="Post Image">
                                            <?php } else { ?>
                                                <img src="assets/uploads/post_images/default_image.jpg" class="img-fluid" alt="Default Image">
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ep_title">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                        </a>
                                        <p class="mt-2 mb-2"><?php echo htmlspecialchars(substr($post['content'], 0, 100)) . '...'; ?></p>
                                        <span>Category: <?php echo htmlspecialchars($post['category_name']); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="created">
                                        <span>Created at: <?php echo $post['created_at']; ?></span><br>
                                        <span>Updated at: <?php echo $post['updated_at']; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="like_box d-flex justify-content-center">
                                        <i class="lni lni-thumbs-up-3"></i>
                                        <i class="lni lni-comment-1-text"></i>
                                        <i class="lni lni-share-1"></i>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="ep_dlt d-flex justify-content-center">
                                        <a href="delete-post.php?post_id=<?php echo $post['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')" class="dltp">
                                            <i class="lni lni-basket-shopping-3"></i>
                                        </a>
                                        <a href="edit-post.php?post_id=<?php echo $post['post_id']; ?>" class="edtp">
                                            <i class="lni lni-pen-to-square"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No posts found.</p>
                <?php endif; ?>

                <!-- Add New Post Button -->
                <a href="add-new-post.php" class="btn btn-cs m-3">Add New Post</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to fetch user and post history data dynamically
    function fetchData() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_users.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                document.getElementById('user-info-table').innerHTML = response.userTable;
                document.getElementById('post-history-table').innerHTML = response.postHistoryTable;
            }
        };
        xhr.send();
    }

    // Fetch data every 5 seconds
    setInterval(fetchData, 5000);

    // Initial fetch when the page loads
    fetchData();
</script>

<?php include 'footer.php'; ?>