<?php
ob_start();
include 'header.php';

// Fetch post ID
$post_id = $_GET['post_id'] ?? null;
if (!$post_id) {
    echo "<p>Invalid post ID.</p>";
    exit;
}

$post_id = intval($post_id);

// Handle like/unlike submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_like'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // if the user already liked the post
        $check_like_query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
        $like_result = mysqli_query($conn, $check_like_query);

        if (mysqli_num_rows($like_result) === 0) {
            // insert new like, user has not liked the post yet
            $like_query = "INSERT INTO likes (post_id, user_id, created_at) VALUES ($post_id, $user_id, NOW())";
            if (mysqli_query($conn, $like_query)) {
                $_SESSION['message'] = "You liked the post!";
            } else {
                $_SESSION['message'] = "Error liking the post. Please try again.";
            }
        } else {
            // User already liked the post, delete the like
            $unlike_query = "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id";
            if (mysqli_query($conn, $unlike_query)) {
                $_SESSION['message'] = "You unliked the post.";
            } else {
                $_SESSION['message'] = "Error unliking the post. Please try again.";
            }
        }
    } else {
        $_SESSION['message'] = "Please sign in to like the post.";
    }

    header("Location: view-post.php?post_id=$post_id");
    exit;
}

// Handle like/unlike submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_like'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Check if the user already liked the post
        $check_like_query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
        $like_result = mysqli_query($conn, $check_like_query);

        if (mysqli_num_rows($like_result) === 0) {
            // User hasn't liked the post, insert a new like
            $like_query = "INSERT INTO likes (post_id, user_id, created_at) VALUES ($post_id, $user_id, NOW())";
            if (mysqli_query($conn, $like_query)) {
                $_SESSION['message'] = "You liked the post!";
            } else {
                $_SESSION['message'] = "Error liking the post. Please try again.";
            }
        } else {
            // User already liked the post, delete the like
            $unlike_query = "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id";
            if (mysqli_query($conn, $unlike_query)) {
                $_SESSION['message'] = "You unliked the post.";
            } else {
                $_SESSION['message'] = "Error unliking the post. Please try again.";
            }
        }
    } else {
        $_SESSION['message'] = "Please sign in to like the post.";
    }

    // Redirect to avoid form resubmission issues
    header("Location: view-post.php?post_id=$post_id");
    exit;
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

// Check if the user liked the post
$user_liked = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_like_query = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
    $user_like_result = mysqli_query($conn, $user_like_query);
    $user_liked = mysqli_num_rows($user_like_result) > 0;
}

// Count likes for this post
$like_count_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = $post_id";
$like_count_result = mysqli_query($conn, $like_count_query);
$like_count = mysqli_fetch_assoc($like_count_result)['like_count'];

ob_end_flush();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Post Details -->
            <div class="postpg">
                <img src="<?php echo htmlspecialchars($post['feature_image'] ?? 'assets/default-image.jpg'); ?>" alt="Feature Image" class="img-fluid">
                <div class="pcriteria mt-3 mb-2">
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($post['category_name'] ?? 'Uncategorized'); ?></p>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($post['username'] ?? 'Unknown'); ?></p>
                    <p><strong>Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>
                </div>
                <div class="post_content">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comment_section cp60" id="comment_section">
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
                        <textarea name="comment_text" class="form-control" placeholder="Write your thoughts..." required></textarea>
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