<?php
ob_start();
include 'header.php';

//post id
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
    header("Location: view-post.php?post_id=$post_id");
    exit;
}


//comment================================================================================================
// Handle comment submission and editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id']) && !empty($_POST['comment_text'])) {
        if (isset($_GET['comment_id'])) {
            // Editing a comment
            $comment_id = $_GET['comment_id'];
            $new_comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);
            $update_query = "UPDATE comment SET comment_text = '$new_comment_text' WHERE comment_id = '$comment_id' AND user_id = '{$_SESSION['user_id']}'";

            if (mysqli_query($conn, $update_query)) {
                $_SESSION['message'] = 'Comment updated successfully!';
                header('Location: view-post.php?post_id=' . $post_id . '#comment_section');
                exit();
            } else {
                $_SESSION['message'] = 'Failed to update comment. Please try again.';
            }
        } else {
            // Adding a new comment
            $user_id = $_SESSION['user_id'];
            $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);
            $query = "INSERT INTO comment (post_id, user_id, comment_text, created_at) 
                      VALUES ($post_id, $user_id, '$comment_text', NOW())";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = "Comment posted successfully.";
            } else {
                $_SESSION['message'] = "Error: " . mysqli_error($conn);
            }
        }
    } else {
        $_SESSION['message'] = "Please sign in to comment.";
        header('Location: view-post.php?post_id=' . $post_id . '#comment_section');
        exit;
    }
}

// Handle comment deletion
if (isset($_GET['delete']) && isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $user_id = $_SESSION['user_id'];

    $delete_query = "DELETE FROM comment WHERE comment_id = '$comment_id' AND user_id = '$user_id'";

    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['message'] = 'Comment deleted successfully!';
        header('Location: view-post.php?post_id=' . $post_id . '#comment_section');
        exit();
    } else {
        $_SESSION['message'] = 'Failed to delete comment. Please try again.';
        header('Location: view-post.php?post_id=' . $post_id . '#comment_section');
        exit();
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
                        c.comment_id, c.comment_text, 
                        u.username, 
                        c.created_at, 
                        up.profile_picture, u.user_id 
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_report'])) {
    if (!empty($_POST['post_id']) && !empty($_POST['report_reason'])) {
        $post_id = intval($_POST['post_id']);
        $report_reason = mysqli_real_escape_string($conn, $_POST['report_reason']);

        // Insert the report into the database
        $report_query = "INSERT INTO report (post_id, report_reason, report_date)
                         VALUES ($post_id, '$report_reason', NOW())";

        if (mysqli_query($conn, $report_query)) {
            $_SESSION['message'] = "Thank you for your report. Our team will review it shortly.";
            $_SESSION['messageType'] = "success";
        } else {
            $_SESSION['message'] = "An error occurred. Please try again.";
            $_SESSION['messageType'] = "error";
        }
    } else {
        $_SESSION['message'] = "Invalid report submission.";
        $_SESSION['messageType'] = "error";
    }

    // Redirect to the same page to avoid resubmission
    header("Location: view-post.php?post_id=$post_id");
    exit();
}

ob_end_flush();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Post Details -->
            <div class="postpg">
                <img src="<?php echo htmlspecialchars($post['feature_image'] ?? 'assets/default-image.jpg'); ?>"
                    alt="Feature Image" class="img-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pcriteria mt-3 mb-2">
                        <p><strong>Category:</strong>
                            <?php echo htmlspecialchars($post['category_name'] ?? 'Uncategorized'); ?></p>
                        <p><strong>Author:</strong> <?php echo htmlspecialchars($post['username'] ?? 'Unknown'); ?></p>
                        <p><strong>Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?>
                        </p>
                    </div>
                    <div class="author_box">
                        <a href="profile.php?user_id=<?php echo $post['user_id']; ?>" class="btn btn-cs">
                            More from Author
                        </a>
                    </div>
                </div>
                <div class="post_content">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                </div>

                <div class="post_react">
                    <!-- Like Section -->
                    <div class="like-section">
                        <form method="POST">
                            <input type="hidden" name="toggle_like" value="1">
                            <button type="submit" class="like-icon-button">
                                <i class="fa-solid fa-thumbs-up<?php echo $user_liked ? ' liked' : ''; ?>"></i>
                            </button>

                        </form>
                    </div>
                    <div class="comment-count-box d-flex align-items-center ps-3 pe-3">
                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>#comment_section">
                            <i class="lni lni-comment-1-text"></i></a>
                        <span class="comment-count">
                            <?php
                            $post_id = $post['post_id'];
                            $comment_query = "SELECT COUNT(*) AS comment_count FROM comment WHERE post_id = '$post_id'";
                            $comment_result = mysqli_query($conn, $comment_query);
                            $comment_data = mysqli_fetch_assoc($comment_result);
                            echo htmlspecialchars($comment_data['comment_count'] ?? 0);
                            ?>
                        </span>
                    </div>
                    <div class="share_box">
                        <!-- Share Modal Trigger -->
                        <i class="lni lni-share-1" data-bs-toggle="modal"
                            data-bs-target="#shareModal-<?php echo $post['post_id']; ?>"></i>
                    </div>
                    <div class="report_box">
                        <i class="lni lni-flag-1" data-bs-toggle="modal"
                            data-bs-target="#reportModal-<?php echo $post['post_id']; ?>"></i>
                    </div>
                    <!-- Share Modal -->
                    <div class="modal " id="shareModal-<?php echo $post['post_id']; ?>" tabindex="-1"
                        aria-labelledby="shareModalLabel-<?php echo $post['post_id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="shareModalLabel-<?php echo $post['post_id']; ?>">
                                        Share Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center share-social">
                                    <!-- Share Icons -->
                                    <div class="d-flex justify-content-around align-items-center">
                                        <!-- Facebook -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://daakticket.faruqweb.com/view-post.php?post_id=' . $post['post_id']); ?>"
                                            target="_blank" title="Share on Facebook">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                        <!-- X (Twitter) -->
                                        <a href="https://twitter.com/share?url=<?php echo urlencode('https://daakticket.faruqweb.com/view-post.php?post_id=' . $post['post_id']); ?>&text=<?php echo urlencode($post['title']); ?>"
                                            target="_blank" title="Share on X">
                                            <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                        <!-- LinkedIn -->
                                        <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode('https://daakticket.faruqweb.com/view-post.php?post_id=' . $post['post_id']); ?>&title=<?php echo urlencode($post['title']); ?>"
                                            target="_blank" title="Share on LinkedIn">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                        <!-- Copy Link -->
                                        <div class="copy-link">
                                            <form class="copy-form">
                                                <input type="hidden"
                                                    value="https://daakticket.faruqweb.com/view-post.php?post_id=<?php echo $post['post_id']; ?>"
                                                    readonly>
                                                <button type="button" class="copy-button" title="Copy Link"><i
                                                        class="fa-solid fa-copy"></i></button>
                                            </form>
                                        </div>
                                        <!-- share to social -->
                                        <script>
                                            (function () {
                                                var copyButton = document.querySelector('.copy-button');
                                                var copyInput = document.querySelector('.copy-form input');

                                                copyButton.addEventListener('click', function (e) {
                                                    e.preventDefault();
                                                    copyInput.select();
                                                    document.execCommand('copy');
                                                    alert("Link copied to clipboard!");
                                                });
                                            })();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Report Modal -->
                    <div class="modal fade" id="reportModal-<?php echo $post['post_id']; ?>" tabindex="-1"
                        aria-labelledby="reportModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">Report Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                                        <div class="mb-3">
                                            <label for="reportReason" class="form-label">Reason for Reporting
                                                (required)</label>
                                            <textarea name="report_reason" id="reportReason" class="form-control"
                                                rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="submit_report">Submit Report</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <h3 class="mt-2">Total like: <?php echo $like_count; ?></h3>

        </div>

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

                    <div class="comment-item d-flex align-items-end justify-content-between">
                        <div class="comment-add">
                            <div class="comment-avatar">
                                <img src="<?php echo $profile_image; ?>" alt="User Image" class="img-fluid me-3"
                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            </div>
                            <div class="comment_content">
                                <h4><strong><?php echo htmlspecialchars($comment['username']); ?></strong></h4>
                                <p><?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?></p>
                                <div class="comment-date">
                                    <p>Posted on
                                        <?php echo date('F j, Y, g:i a', strtotime($comment['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="comment-buttons">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <?php if ($_SESSION['user_id'] === $comment['user_id']) { ?>
                                        <a href="view-post.php?post_id=<?php echo $post_id; ?>&comment_id=<?php echo $comment['comment_id']; ?>"
                                            class="btn btn-edit">Edit</a>
                                        <a href="view-post.php?post_id=<?php echo $post_id; ?>&delete=1&comment_id=<?php echo $comment['comment_id']; ?>"
                                            class="btn btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this comment?')">Delete</a>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php }
            } else {
                echo "<p>No comments yet.</p>";
            }
            ?>

            <!-- Comment Form -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if (isset($_GET['comment_id'])) {
                    $comment_id = $_GET['comment_id'];
                    $edit_query = "SELECT comment_text FROM comment WHERE comment_id = $comment_id";
                    $edit_result = mysqli_query($conn, $edit_query);
                    $edit_comment = mysqli_fetch_assoc($edit_result);
                    ?>
                    <form method="POST">
                        <textarea name="comment_text" rows="4"
                            class="form-control"><?php echo htmlspecialchars($edit_comment['comment_text']); ?></textarea>
                        <button type="submit" class="btn btn-cs mt-2">Update Comment</button>
                    </form>
                <?php } else { ?>
                    <form method="POST">
                        <textarea name="comment_text" rows="4" class="form-control" placeholder="Write your thoughts..."
                            required></textarea>
                        <button type="submit" class="btn btn-cs mt-2">Post Comment</button>
                    </form>
                <?php } ?>
            <?php else: ?>
                <p>Please <a href="login.php">sign in</a> to comment.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php
include 'footer.php';
?>