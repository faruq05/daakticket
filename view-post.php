<?php
ob_start();
include 'header.php';
// Fetch post ID
$post_id = $_GET['post_id'] ?? null;
if (!$post_id) {
    echo "<p>Invalid post ID.</p>";
    exit;
}

$post_id = intval($post_id); // Sanitize post ID

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id']) && !empty($_POST['comment_text'])) {
        $user_id = $_SESSION['user_id'];
        $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);

        $query = "INSERT INTO comment (post_id, user_id, comment_text, created_at) 
                  VALUES ($post_id, $user_id, '$comment_text', NOW())";
        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Comment posted successfully.";
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
        }
        header("Location: view-post.php?post_id=$post_id");
        exit;
    } else {
        $_SESSION['message'] = "Please sign in to comment.";
        header("Location: view-post.php?post_id=$post_id");
        exit;
    }
}

// Fetch post details
$query = "SELECT p.*, u.username, c.category_name 
          FROM blog_post p
          LEFT JOIN user u ON p.user_id = u.user_id
          LEFT JOIN category c ON p.category_id = c.category_id
          WHERE p.post_id = $post_id";
$post_result = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($post_result);

if (!$post) {
    echo "<p>Post not found.</p>";
    exit;
}

// Fetch comments
$comments_query = "SELECT 
                        c.comment_text, 
                        u.username, 
                        c.created_at, 
                        up.profile_picture 
                   FROM comment c
                   LEFT JOIN user u ON c.user_id = u.user_id
                   LEFT JOIN User_Profile up ON u.user_id = up.user_id
                   WHERE c.post_id = $post_id
                   ORDER BY c.created_at DESC";
$comments_result = mysqli_query($conn, $comments_query);

ob_end_flush(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Post Details -->
            <div class="postpg">
                <img src="<?php echo htmlspecialchars($post['feature_image'] ?? 'assets/default-image.jpg'); ?>"
                    alt="Feature Image" class="img-fluid">
                <div class="pcriteria mt-3 mb-2">
                    <p><strong>Category:</strong>
                        <?php echo htmlspecialchars($post['category_name'] ?? 'Uncategorized'); ?></p>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($post['username'] ?? 'Unknown'); ?></p>
                    <p><strong>Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>

                </div>
                <div class="post_content">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="comment_section cp60">
                <h2>Comments</h2>
                <?php
                if ($comments_result && mysqli_num_rows($comments_result) > 0) {
                    while ($comment = mysqli_fetch_assoc($comments_result)) {
                        // Determine the user's profile image or use a placeholder
                        $profile_image = !empty($comment['profile_picture'])
                            ? htmlspecialchars($comment['profile_picture'])
                            : 'assets/uploads/profile_pictures/default_profile.png';
                        ?>
                        <div class="comment-add">
                            <img src="<?php echo $profile_image; ?>" alt="User Image" class="img-fluid me-3"
                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div class="">
                                <div class="comment-header d-flex align-items-center">
                                    <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                                    <span
                                        class="comment-date ms-2 me-2">(<?php echo date('d/m/Y H:i:s', strtotime($comment['created_at'])); ?>):
                                    </span>
                                </div>
                                <p class="comment-text"><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No comments yet. Be the first to comment!</p>";
                }
                ?>
                <hr>



                <!-- Comment Form -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST">
                        <textarea name="comment_text" class="form-control" placeholder="Write your thoughts..."
                            required></textarea>
                        <button type="submit" class="btn btn-cs mt-2">Post Comment</button>
                    </form>
                <?php else: ?>
                    <p>Please <a href="login.php">sign in</a> to comment.</p>
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>