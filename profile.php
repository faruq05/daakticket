<?php
include 'header.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

if (!$user_id) {
    echo "<div class='alert alert-danger'>Invalid user profile.</div>";
    exit;
}

$user_query = "
    SELECT 
        u.username, u.first_name, u.last_name, u.email, 
        up.bio, up.profile_picture, up.facebook_link, up.twitter_link, up.instagram_link, up.linkedin_link,
        (SELECT COUNT(*) FROM blog_post WHERE user_id = u.user_id AND status = 'approved') AS total_posts,
        (SELECT COUNT(*) FROM likes l 
         JOIN blog_post p ON l.post_id = p.post_id 
         WHERE p.user_id = u.user_id AND p.status = 'approved') AS total_likes,
        (SELECT COUNT(*) FROM comment c 
         JOIN blog_post p ON c.post_id = p.post_id 
         WHERE p.user_id = u.user_id AND p.status = 'approved') AS total_comments
    FROM user u
    LEFT JOIN user_profile up ON u.user_id = up.user_id
    WHERE u.user_id = $user_id
";

$user_result = mysqli_query($conn, $user_query);

if (!$user_result || mysqli_num_rows($user_result) === 0) {
    echo "<div class='alert alert-danger'>User profile not found.</div>";
    exit;
}

$user = mysqli_fetch_assoc($user_result);
?>

<div class="banner_user ">
    <div class="container">
        <div class="row">

        </div>
    </div>
</div>
<div class="main">
    <div class="container">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-12">
                <div class="brdd">
                    <ul class="breadcrumb pt-2">
                        <li><a href="index.php">Home </a></li>
                        <li class="active"><i class="fa-solid fa-angle-right ps-2 pe-2"></i>Profile</li>
                    </ul>
                </div>
                <div class="profile user_pfp">
                    <img src="<?php echo htmlspecialchars($user['profile_picture'] ?: 'assets/uploads/profile_pictures/default_profile.png'); ?>"
                        alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    <h2 class="mt-3"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>
                    </h2>
                    <p>
                        <i class="lni lni-double-quotes-end-1"></i>
                        <?php echo htmlspecialchars($user['bio'] ?: 'No bio available.'); ?>
                    </p>
                    <div class="total_inter">
                        <div class="post_qty qty">
                            <i class="lni lni-pen-to-square"></i><strong><?php echo $user['total_posts']; ?></strong>
                        </div>
                        <div class="like_qty qty">
                            <i class="lni lni-thumbs-up-3"></i><strong><?php echo $user['total_likes']; ?></strong>
                        </div>
                        <div class="comment_qty qty">
                            <i
                                class="lni lni-comment-1-text"></i><strong><?php echo $user['total_comments']; ?></strong>
                        </div>
                    </div>
                    <div class="social_links_user social_icon mt-5">
                        <?php if (!empty($user['facebook_link'])): ?>
                            <a href="<?php echo htmlspecialchars($user['facebook_link']); ?>" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($user['twitter_link'])): ?>
                            <a href="<?php echo htmlspecialchars($user['twitter_link']); ?>" target="_blank">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($user['instagram_link'])): ?>
                            <a href="<?php echo htmlspecialchars($user['instagram_link']); ?>" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($user['linkedin_link'])): ?>
                            <a href="<?php echo htmlspecialchars($user['linkedin_link']); ?>" target="_blank">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Posts Section -->
            <div class="col-md-12">
                <div class="user_posts cp60 mt-5">
                    <h3 class="mb-3">All Posts</h3>
                    <div class="row" id="masonry-grid">
                        <?php
                        $post_query = "
                              SELECT 
        p.post_id, p.title, p.feature_image, p.created_at, p.updated_at, p.content, 
        c.category_name, 
        u.username 
    FROM blog_post p
    LEFT JOIN category c ON p.category_id = c.category_id
    LEFT JOIN user u ON p.user_id = u.user_id
    WHERE p.user_id = $user_id AND p.status = 'approved'
    ORDER BY p.created_at DESC
                        ";
                        $post_result = mysqli_query($conn, $post_query);

                        if ($post_result && mysqli_num_rows($post_result) > 0) {
                            while ($post = mysqli_fetch_assoc($post_result)) {
                                $excerpt = isset($post['content']) ? substr($post['content'], 0, 90) . '...' : 'No content available.';
                                ?>
                                <div class="col-md-4 mb-4">
                                    <div class="blog_box">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <img src="<?php echo htmlspecialchars($post['feature_image']); ?>" class="img-fluid"
                                                alt="<?php echo htmlspecialchars($post['title']); ?>">
                                        </a>
                                        <div class="post_title">
                                            <div class="author_box d-flex align-items-center pt-2">
                                                <i class="lni lni-pencil-1"></i>
                                                <?php echo htmlspecialchars($post['username'] ?? 'Unknown'); ?>
                                                <i class="lni lni-calendar-days ps-4"></i>
                                                <p class="ps-2"><?php echo date('d M, Y', strtotime($post['created_at'])); ?>
                                                </p>
                                            </div>
                                            <div class="author_box category_name">
                                                <p>Category:
                                                    <?php echo htmlspecialchars($post['category_name'] ?? 'Uncategorized'); ?>
                                                </p>
                                            </div>
                                            <div class="blog_ttle">
                                                <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                                </a>
                                                <p><?php echo htmlspecialchars($excerpt); ?></p>
                                            </div>
                                            <div class="like_box mt-2 d-flex align-items-center">
                                                <i class="lni lni-thumbs-up-3"></i>
                                                <span class="like-count ps-2">
                                                    <?php
                                                    $post_id = $post['post_id']; // Assuming $post['post_id'] is already available
                                                    $like_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = '$post_id'";
                                                    $like_result = mysqli_query($conn, $like_query);
                                                    $like_data = mysqli_fetch_assoc($like_result);
                                                    echo htmlspecialchars($like_data['like_count'] ?? 0); // if no likes then 0
                                                    ?>
                                                </span>
                                                <div class="comment-count-box d-flex align-items-center ps-3 pe-3">
                                                    <a
                                                        href="view-post.php?post_id=<?php echo $post['post_id']; ?>#comment_section">
                                                        <i class="lni lni-comment-1-text"></i></a>
                                                    <span class="comment-count">
                                                        <?php
                                                        $post_id = $post['post_id'];
                                                        $comment_query = "SELECT COUNT(*) AS comment_count FROM comment WHERE post_id = '$post_id'";
                                                        $comment_result = mysqli_query($conn, $comment_query);
                                                        $comment_data = mysqli_fetch_assoc($comment_result);
                                                        echo htmlspecialchars($comment_data['comment_count'] ?? 0); // if no comments then 0
                                                        ?>
                                                    </span>
                                                </div>
                                                <!-- Share Modal Trigger -->
                                                <i class="lni lni-share-1" data-bs-toggle="modal"
                                                    data-bs-target="#shareModal-<?php echo $post['post_id']; ?>"></i>
                                                <!-- share modal is in footer -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="nothing_found text-center">
                                    <img src="assets/uploads/empty.png" class="img-fluid w-10" alt="nothing">
                                    <p class="text-center mt-4">No Published posts found.</p>
                                  </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>