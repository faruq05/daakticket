<?php include 'db.php';
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'published';
?>
<!-- display -->
<div class="col-md-12 add_post cp60 dash_font" id="posts">
    <h2 class="mb-3">Your Posts</h2>
    <div class="menu_tab menu_tab_user">

        <!-- Tab Navigation -->
        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($current_tab == 'published' ? 'active' : ''); ?>"
                    id="pills-published-tab" data-bs-toggle="pill" href="#pills-published" role="tab"
                    aria-controls="pills-published" aria-selected="true">Published Posts</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($current_tab == 'draft' ? 'active' : ''); ?>" id="pills-draft-tab"
                    data-bs-toggle="pill" href="#pills-draft" role="tab" aria-controls="pills-draft"
                    aria-selected="true">Draft Posts</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($current_tab == 'pending' ? 'active' : ''); ?>"
                    id="pills-pending-tab" data-bs-toggle="pill" href="#pills-pending" role="tab"
                    aria-controls="pills-pending" aria-selected="false">Pending Posts</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo ($current_tab == 'rejected' ? 'active' : ''); ?>"
                    id="pills-rejected-tab" data-bs-toggle="pill" href="#pills-rejected" role="tab"
                    aria-controls="pills-rejected" aria-selected="false">Rejected Posts</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="pills-tabContent">

            <!-- Published Posts Tab -->
            <div class="tab-pane <?php echo ($current_tab == 'published' ? 'show active' : ''); ?>" id="pills-published"
                role="tabpanel" aria-labelledby="pills-published-tab">
                <?php
                $user_id = $_SESSION['user_id'];
                $search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

                // Search Form
                
                echo '<form method="get" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search your posts..." 
                               value="' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . '">
                        <button type="submit" class="btn btn-cscolor">Search</button>
                        </div>
                    </form>';

                // Query for Published Posts (Approved by Admin)
                $query = "SELECT blog_post.*, category.category_name 
                          FROM blog_post
                          LEFT JOIN category ON blog_post.category_id = category.category_id
                          WHERE blog_post.user_id = '$user_id' 
                          AND blog_post.status = 'approved' 
                          AND (blog_post.title LIKE '%$search_query%' 
                               OR blog_post.content LIKE '%$search_query%' 
                               OR category.category_name LIKE '%$search_query%')
                          ORDER BY blog_post.created_at DESC";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($post = mysqli_fetch_assoc($result)) {
                        $post_id = $post['post_id'];
                        $title = $post['title'];
                        $content = $post['content'];
                        $feature_image = $post['feature_image'];
                        $created_at = date('F j, Y, g:i a', strtotime($post['created_at']));
                        $updated_at = date('F j, Y, g:i a', strtotime($post['updated_at']));
                        $category_name = $post['category_name'];

                        // Excerpt for content preview
                        $excerpt = substr($content, 0, 100) . '...';
                        ?>
                        <!-- Display each post -->
                        <div class="exist_post">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="post_ftimg">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <?php if ($feature_image && file_exists($feature_image)) { ?>
                                                <img src="<?php echo $feature_image; ?>" class="img-fluid" alt="Post Image">
                                            <?php } else { ?>
                                                <img src="assets/uploads/post_images/default_image.jpg" class="img-fluid"
                                                    alt="Default Image">
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ep_title">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <h3><?php echo htmlspecialchars($title); ?></h3>
                                        </a>
                                        <p class="mt-2 mb-2"><?php echo $excerpt; ?></p>
                                        <span>Category: <?php echo htmlspecialchars($category_name); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="created">
                                        <span>Created at <?php echo $created_at; ?></span> <br>
                                        <span>Updated at <?php echo $updated_at; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="like_box mt-2 d-flex align-items-center">
                                        <i class="lni lni-thumbs-up-3 me-0"></i>
                                        <span class="like-count ps-2">
                                            <?php
                                            $like_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = '$post_id'";
                                            $like_result = mysqli_query($conn, $like_query);
                                            $like_data = mysqli_fetch_assoc($like_result);
                                            echo htmlspecialchars($like_data['like_count'] ?? 0);
                                            ?>
                                        </span>
                                        <div class="comment-count-box d-flex align-items-center ps-3 pe-3">
                                            <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>#comment_section">
                                                <i class="lni lni-comment-1-text"></i></a>
                                            <span class="comment-count">
                                                <?php
                                                $comment_query = "SELECT COUNT(*) AS comment_count FROM comment WHERE post_id = '$post_id'";
                                                $comment_result = mysqli_query($conn, $comment_query);
                                                $comment_data = mysqli_fetch_assoc($comment_result);
                                                echo htmlspecialchars($comment_data['comment_count'] ?? 0);
                                                ?>
                                            </span>
                                        </div>
                                        <!-- Share Modal Trigger -->
                                        <i class="lni lni-share-1" data-bs-toggle="modal"
                                            data-bs-target="#shareModal-<?php echo $post['post_id']; ?>"></i>
                                    </div>
                                    <!-- Share Modal -->
                                    <div class="modal " id="shareModal-<?php echo $post['post_id']; ?>" tabindex="-1"
                                        aria-labelledby="shareModalLabel-<?php echo $post['post_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="shareModalLabel-<?php echo $post['post_id']; ?>">
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
                                </div>
                                <div class="col-md-2">
                                    <div class="ep_dlt d-flex justify-content-center">
                                        <a href="delete-post.php?post_id=<?php echo $post_id; ?>"
                                            onclick="return confirm('Are you sure you want to delete this post?')" class="dltp">
                                            <i class="lni lni-basket-shopping-3"></i>
                                        </a>
                                        <a href="edit-post.php?post_id=<?php echo $post_id; ?>" class="edtp"><i
                                                class="lni lni-pen-to-square"></i></a>
                                        <!-- Changing Post Status -->
                                        <div class="dropdown drp">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton<?php echo $post_id; ?>" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <!-- Gear Icon with Color Change Based on Status -->
                                                <i class="lni lni-gear-1"
                                                    style="color: <?php echo ($post['status'] == 'approved') ?>;"></i>
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton<?php echo $post_id; ?>">
                                                <?php if ($post['status'] == 'approved'): ?>
                                                    <!-- Option to change post to draft -->
                                                    <li><a class="dropdown-item"
                                                            href="change-status.php?post_id=<?php echo $post_id; ?>&status=draft">Change
                                                            to Draft</a></li>
                                                <?php else: ?>
                                                    <!-- Option to change post to publish -->
                                                    <li><a class="dropdown-item"
                                                            href="change-status.php?post_id=<?php echo $post_id; ?>&status=approved">Publish</a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="nothing_found text-center">
                    <img src="assets/uploads/published.png" class="img-fluid w-10" alt="published">
                    <p class="text-center mt-4">No Published posts found.</p>
                  </div>';
                }
                ?>
            </div>

            <!-- Draft Posts Tab -->
            <div class="tab-pane <?php echo ($current_tab == 'draft' ? 'show active' : ''); ?>" id="pills-draft"
                role="tabpanel" aria-labelledby="pills-draft-tab">
                <?php
                $user_id = $_SESSION['user_id'];
                // Query for draft Posts
                $query = "SELECT blog_post.*, category.category_name 
                          FROM blog_post
                          LEFT JOIN category ON blog_post.category_id = category.category_id
                          WHERE blog_post.user_id = '$user_id' 
                          AND blog_post.status = 'draft' 
                          AND (blog_post.title LIKE '%$search_query%' 
                               OR blog_post.content LIKE '%$search_query%' 
                               OR category.category_name LIKE '%$search_query%')
                          ORDER BY blog_post.created_at DESC";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($post = mysqli_fetch_assoc($result)) {
                        $post_id = $post['post_id'];
                        $title = $post['title'];
                        $content = $post['content'];
                        $feature_image = $post['feature_image'];
                        $created_at = date('F j, Y, g:i a', strtotime($post['created_at']));
                        $updated_at = date('F j, Y, g:i a', strtotime($post['updated_at']));
                        $category_name = $post['category_name'];

                        // Excerpt for content preview
                        $excerpt = substr($content, 0, 100) . '...';
                        ?>
                        <!-- Display each post -->
                        <div class="exist_post">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="post_ftimg">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <?php if ($feature_image && file_exists($feature_image)) { ?>
                                                <img src="<?php echo $feature_image; ?>" class="img-fluid" alt="Post Image">
                                            <?php } else { ?>
                                                <img src="assets/uploads/post_images/default_image.jpg" class="img-fluid"
                                                    alt="Default Image">
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ep_title">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <h3><?php echo htmlspecialchars($title); ?></h3>
                                        </a>
                                        <p class="mt-2 mb-2"><?php echo $excerpt; ?></p>
                                        <span>Category: <?php echo htmlspecialchars($category_name); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="created">
                                        <span>Created at <?php echo $created_at; ?></span> <br>
                                        <span>Updated at <?php echo $updated_at; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="like_box mt-2 d-flex align-items-center">
                                        <i class="lni lni-thumbs-up-3 me-0"></i>
                                        <span class="like-count ps-2">
                                            <?php
                                            $like_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = '$post_id'";
                                            $like_result = mysqli_query($conn, $like_query);
                                            $like_data = mysqli_fetch_assoc($like_result);
                                            echo htmlspecialchars($like_data['like_count'] ?? 0);
                                            ?>
                                        </span>
                                        <div class="comment-count-box d-flex align-items-center ps-3 pe-3">
                                            <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>#comment_section">
                                                <i class="lni lni-comment-1-text"></i></a>
                                            <span class="comment-count">
                                                <?php
                                                $comment_query = "SELECT COUNT(*) AS comment_count FROM comment WHERE post_id = '$post_id'";
                                                $comment_result = mysqli_query($conn, $comment_query);
                                                $comment_data = mysqli_fetch_assoc($comment_result);
                                                echo htmlspecialchars($comment_data['comment_count'] ?? 0);
                                                ?>
                                            </span>
                                        </div>
                                        <!-- Share Modal Trigger -->
                                        <i class="lni lni-share-1" data-bs-toggle="modal"
                                            data-bs-target="#shareModal-<?php echo $post['post_id']; ?>"></i>
                                    </div>
                                    <!-- Share Modal -->
                                    <div class="modal " id="shareModal-<?php echo $post['post_id']; ?>" tabindex="-1"
                                        aria-labelledby="shareModalLabel-<?php echo $post['post_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="shareModalLabel-<?php echo $post['post_id']; ?>">
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
                                </div>
                                <div class="col-md-2">
                                    <div class="ep_dlt d-flex justify-content-center">
                                        <a href="delete-post.php?post_id=<?php echo $post_id; ?>"
                                            onclick="return confirm('Are you sure you want to delete this post?')" class="dltp">
                                            <i class="lni lni-basket-shopping-3"></i>
                                        </a>
                                        <a href="edit-post.php?post_id=<?php echo $post_id; ?>" class="edtp"><i
                                                class="lni lni-pen-to-square"></i></a>
                                        <!-- Dropdown for Changing Post Status -->
                                        <div class="dropdown drp">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton<?php echo $post_id; ?>" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <!-- Gear Icon with Color Change Based on Status -->
                                                <i class="lni lni-gear-1"
                                                    style="color: <?php echo ($post['status'] == 'approved') ?>;"></i>
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton<?php echo $post_id; ?>">
                                                <?php if ($post['status'] == 'approved'): ?>
                                                    <!-- Option to change post to draft -->
                                                    <li><a class="dropdown-item"
                                                            href="change-status.php?post_id=<?php echo $post_id; ?>&status=draft">Change
                                                            to Draft</a></li>
                                                <?php else: ?>
                                                    <!-- Option to change post to publish -->
                                                    <li><a class="dropdown-item"
                                                            href="change-status.php?post_id=<?php echo $post_id; ?>&status=approved">Publish</a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="nothing_found text-center">
                    <img src="assets/uploads/draft.png" class="img-fluid w-10" alt="draft">
                    <p class="text-center mt-4">No draft posts found.</p>
                  </div>';
                }
                ?>
            </div>

            <!-- pending Posts Tab -->
            <div class="tab-pane <?php echo ($current_tab == 'pending' ? 'show active' : ''); ?>" id="pills-pending"
                role="tabpanel" aria-labelledby="pills-pending-tab">
                <?php
                $user_id = $_SESSION['user_id'];

                // Query for Published Posts (pending)
                $query = "SELECT blog_post.*, category.category_name FROM blog_post
                    LEFT JOIN category ON blog_post.category_id = category.category_id
                    WHERE blog_post.user_id = '$user_id' AND blog_post.status = 'pending' 
                    ORDER BY blog_post.created_at DESC";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($post = mysqli_fetch_assoc($result)) {
                        $post_id = $post['post_id'];
                        $title = $post['title'];
                        $content = $post['content'];
                        $feature_image = $post['feature_image'];
                        $created_at = date('F j, Y, g:i a', strtotime($post['created_at']));
                        $updated_at = date('F j, Y, g:i a', strtotime($post['updated_at']));
                        $category_name = $post['category_name'];

                        // Excerpt for content preview
                        $excerpt = substr($content, 0, 100) . '...';
                        ?>
                        <!-- Display each post -->
                        <div class="exist_post">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="post_ftimg">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <?php if ($feature_image && file_exists($feature_image)) { ?>
                                                <img src="<?php echo $feature_image; ?>" class="img-fluid" alt="Post Image">
                                            <?php } else { ?>
                                                <img src="assets/uploads/post_images/default_image.jpg" class="img-fluid"
                                                    alt="Default Image">
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ep_title">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <h3><?php echo htmlspecialchars($title); ?></h3>
                                        </a>
                                        <p class="mt-2 mb-2"><?php echo $excerpt; ?></p>
                                        <span>Category: <?php echo htmlspecialchars($category_name); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="created">
                                        <span>Created at <?php echo $created_at; ?></span> <br>
                                        <span>Updated at <?php echo $updated_at; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="like_box mt-2 d-flex align-items-center">
                                        <i class="lni lni-thumbs-up-3 me-0"></i>
                                        <span class="like-count ps-2">
                                            <?php
                                            $like_query = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = '$post_id'";
                                            $like_result = mysqli_query($conn, $like_query);
                                            $like_data = mysqli_fetch_assoc($like_result);
                                            echo htmlspecialchars($like_data['like_count'] ?? 0);
                                            ?>
                                        </span>
                                        <div class="comment-count-box d-flex align-items-center ps-3 pe-3">
                                            <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>#comment_section">
                                                <i class="lni lni-comment-1-text"></i></a>
                                            <span class="comment-count">
                                                <?php
                                                $comment_query = "SELECT COUNT(*) AS comment_count FROM comment WHERE post_id = '$post_id'";
                                                $comment_result = mysqli_query($conn, $comment_query);
                                                $comment_data = mysqli_fetch_assoc($comment_result);
                                                echo htmlspecialchars($comment_data['comment_count'] ?? 0);
                                                ?>
                                            </span>
                                        </div>
                                        <!-- Share Modal Trigger -->
                                        <i class="lni lni-share-1" data-bs-toggle="modal"
                                            data-bs-target="#shareModal-<?php echo $post['post_id']; ?>"></i>
                                    </div>
                                    <!-- Share Modal -->
                                    <div class="modal " id="shareModal-<?php echo $post['post_id']; ?>" tabindex="-1"
                                        aria-labelledby="shareModalLabel-<?php echo $post['post_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="shareModalLabel-<?php echo $post['post_id']; ?>">
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
                                </div>
                                <div class="col-md-2">
                                    <div class="ep_dlt d-flex justify-content-center">
                                        <a href="delete-post.php?post_id=<?php echo $post_id; ?>"
                                            onclick="return confirm('Are you sure you want to delete this post?')" class="dltp">
                                            <i class="lni lni-basket-shopping-3"></i>
                                        </a>
                                        <a href="edit-post.php?post_id=<?php echo $post_id; ?>" class="edtp"><i
                                                class="lni lni-pen-to-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="nothing_found text-center">
                    <img src="assets/uploads/pending.png" class="img-fluid w-10" alt="pending">
                    <p class="text-center mt-4">No Pending posts found.</p>
                  </div>';
                }
                ?>
            </div>

            <!-- Rejected Posts Tab -->
            <div class="tab-pane <?php echo ($current_tab == 'rejected' ? 'show active' : ''); ?>" id="pills-rejected"
                role="tabpanel" aria-labelledby="pills-rejected-tab">
                <?php
                // Query for Rejected Posts
                $query = "SELECT blog_post.*, category.category_name FROM blog_post
                    LEFT JOIN category ON blog_post.category_id = category.category_id
                    WHERE blog_post.user_id = '$user_id' AND blog_post.status = 'rejected'
                    ORDER BY blog_post.created_at DESC";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($post = mysqli_fetch_assoc($result)) {
                        $post_id = $post['post_id'];
                        $title = $post['title'];
                        $content = $post['content'];
                        $feature_image = $post['feature_image'];
                        $created_at = date('F j, Y, g:i a', strtotime($post['created_at']));
                        $updated_at = date('F j, Y, g:i a', strtotime($post['updated_at']));
                        $category_name = $post['category_name'];
                        $rejection_reason = $post['rejection_reason'];

                        // Excerpt for content preview
                        $excerpt = substr($content, 0, 100) . '...';
                        ?>
                        <!-- Display each post -->
                        <div class="claim">
                            <p>Please <a href="mailto:daakticket05@gmail.com">contact</a> the admin if the reason for post
                                rejection appears to be invalid to you. We will review
                                the issue and provide further clarification or resolution</p>
                        </div>
                        <div class="exist_post">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="post_ftimg">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <?php if ($feature_image && file_exists($feature_image)) { ?>
                                                <img src="<?php echo $feature_image; ?>" class="img-fluid" alt="Post Image">
                                            <?php } else { ?>
                                                <img src="assets/uploads/post_images/default_image.jpg" class="img-fluid"
                                                    alt="Default Image">
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ep_title">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <h3><?php echo htmlspecialchars($title); ?></h3>
                                        </a>
                                        <p class="mt-2 mb-2"><?php echo $excerpt; ?></p>
                                        <span>Category: <?php echo htmlspecialchars($category_name); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="created">
                                        <span>Created at <?php echo $created_at; ?></span> <br>
                                        <span>Updated at <?php echo $updated_at; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="rejection">
                                        <span><strong>Rejected Reason:</strong>
                                            <?php echo htmlspecialchars($rejection_reason); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="ep_dlt d-flex justify-content-center">
                                        <a href="delete-post.php?post_id=<?php echo $post_id; ?>"
                                            onclick="return confirm('Are you sure you want to delete this post?')" class="dltp">
                                            <i class="lni lni-basket-shopping-3"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="nothing_found text-center">
                            <img src="assets/uploads/rejected.png" class="img-fluid w-10" alt="rejected">
                            <p class="text-center mt-4">No Rejected posts found.</p>
                          </div>';
                }

                ?>
            </div>
        </div>
    </div>

    <!-- Add New Post Button -->
    <a href="add-new-post.php" class="btn btn-cs">Add New Post</a>
</div>