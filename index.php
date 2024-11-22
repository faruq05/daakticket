<?php include 'header.php'; ?>

<!-- banner starts -->
<div class="banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="banner-title">
                    <h1>Daak Ticket .</h1>
                    <h2 class="space">Delivering Ideas, Inspiring Minds – A Platform for Knowledge, Stories, and
                        Community
                        Insight"</h2>
                    <a href="blog.php" class="btn btn-cs">Read Our Blogs</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="custom-shape-divider-bottom-1731212084">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path
            d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
            opacity=".25" class="shape-fill"></path>
        <path
            d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
            opacity=".5" class="shape-fill"></path>
        <path
            d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
            class="shape-fill"></path>
    </svg>
</div>


<!-- blog starts -->
<div class="blogs cp60">
    <div class="container">
        <div class="about_title d-flex align-items-center justify-content-between mb-5">
            <h2>Featured Blogs</h2>
            <div class="abt_btn">
                <a href="blog.php" class="btn btn-cs">View All Posts</a>
            </div>
        </div>
        <div class="row gy-4" id="masonry-grid">
            <?php
            $query = "SELECT p.*, u.username, c.category_name
          FROM blog_post p
          LEFT JOIN user u ON p.user_id = u.user_id
          LEFT JOIN category c ON p.category_id = c.category_id
          ORDER BY p.created_at DESC LIMIT 6";

            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($post = mysqli_fetch_assoc($result)) {
                    $excerpt = substr($post['content'], 0, 90) . (strlen($post['content']) > 90 ? '...' : '');
            ?>
                    <div class="col-md-4">
                        <div class="blog_box">
                            <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                <img src="<?php echo htmlspecialchars($post['feature_image']); ?>" class="img-fluid"
                                    alt="<?php echo htmlspecialchars($post['title']); ?>">
                            </a>
                            <div class="post_title">
                                <div class="author_box d-flex align-items-center pt-2">
                                    <i class="lni lni-pencil-1"></i>
                                    <p class="ps-2"><?php echo htmlspecialchars($post['username'] ?? 'Unknown'); ?></p>
                                    <i class="lni lni-calendar-days ps-4"></i>
                                    <p class="ps-2"><?php echo date('d M, Y', strtotime($post['updated_at'])); ?></p>
                                </div>
                                <div class="author_box category_name">
                                    <p>Category: <?php echo htmlspecialchars($post['category_name'] ?? 'Uncategorized'); ?></p>
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
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>#comment_section">
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
                                </div>



                                <!-- Share Modal -->
                                <div class="modal fade" id="shareModal-<?php echo $post['post_id']; ?>" tabindex="-1"
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
                                                        (function() {
                                                            var copyButton = document.querySelector('.copy-button');
                                                            var copyInput = document.querySelector('.copy-form input');

                                                            copyButton.addEventListener('click', function(e) {
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
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No posts available.</p>";
            }
            ?>

        </div>
    </div>
</div>
<!-- blog ends -->

<!-- about 0-->
<div class="about cp60">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-md-6">
                <div class="about_title_box">
                    <h2>About Us</h2>
                    <p class="space">Welcome to DaakTicket – your destination for diverse voices, stories, and
                        insights from
                        around the world. We believe in the power of words to connect, inspire, and inform. Our
                        platform is designed to be a space where anyone can share valuable knowledge, personal
                        stories, and unique perspectives on topics that matter.</p>
                    <div class="abt_btn">
                        <a href="about.php" class="btn btn-cs">Know More About Us</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_img">
                    <img src="assets/uploads/about-blog.webp" class="img-fluid" alt="about_blog">
                </div>
            </div>
            <!-- about icon -->
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/science.svg" class="img-fluid" alt="sicence-icon">
                        <h4 class="text-center">Technology</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/health.svg" class="img-fluid" alt="health-icon">
                        <h4 class="text-center">Health</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/food.svg" class="img-fluid" alt="food-icon">
                        <h4 class="text-center">Food</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/education.svg" class="img-fluid" alt="education-icon">
                        <h4 class="text-center">Education</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/travel.svg" class="img-fluid" alt="travel-icon">
                        <h4 class="text-center">Travel</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/more.svg" class="img-fluid" alt="more-icon">
                        <h4 class="text-center">And Many More</h4>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>