<?php
include 'header.php';
include 'sidebar.php';
?>
<div class=" main dashboard">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 cp60" id="profile">
                <div class="dash">
                    <!-- profile_picture -->
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT profile_picture FROM User_Profile WHERE user_id = '$user_id'";
                    $result = mysqli_query($conn, $query);
                    $profile_picture = '';

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $profile_picture = $row['profile_picture'];
                    } else {
                        $profile_picture = null;
                    }
                    ?>
                    <div class="profile-container dash_font">
                        <!-- Profile picture container -->
                        <div class="profile-picture-container">
                            <?php
                            if ($profile_picture && file_exists($profile_picture)) {
                                $updated_profile_picture = $profile_picture . '?' . time();
                                echo "<img src='$updated_profile_picture' alt='Profile Picture' class='profile-picture' />";
                            } else {
                                // placeholder image
                                echo "<img src='assets/uploads/profile_pictures/default_profile.png' alt='Profile Picture' class='profile-picture img-fluid' />";
                            }
                            ?>
                            <!-- upload pic -->
                            <div class="upload-icon" onClick="document.getElementById('upload-file').click();">
                                <i class="fa fa-plus"></i>
                            </div>
                            <form action="upload_profile_picture.php" method="POST" enctype="multipart/form-data"
                                class="upload-form">
                                <!-- Hidden file input -->
                                <input type="file" name="profile_picture" id="upload-file" class="upload-file"
                                    onChange="this.form.submit()" />
                            </form>
                        </div>

                        <!-- Options to Upload or Delete -->
                        <?php
                        if ($profile_picture && file_exists($profile_picture)) {
                            echo '<div class="profile-options mb-3">';
                            echo '<form action="delete_profile_picture.php" method="POST"><button type="submit" name="delete_picture" class="btn btn-danger mt-2">Delete Profile Picture</button></form>';
                            echo '</div>';
                        }

                        if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                            echo '<h2>Welcome to Your Profile, ' . htmlspecialchars($_SESSION['username']) . '!</h2>';
                        } else {
                            echo '<p>You are not logged in. Please <a href="login.php">login</a> to access the dashboard.</p>';
                        }
                        ?>
                    </div>

                </div>
            </div>

            <!-- user_info profile -->

            <div class="col-md-12 cp60">
                <div class="user_info">
                    <?php
                    $query = "SELECT * FROM User_Profile WHERE user_id = '$user_id'";
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $first_name = $row['first_name'] ?? '';
                        $last_name = $row['last_name'] ?? '';
                        $email = $row['email'] ?? '';
                        $bio = $row['bio'] ?? '';
                        $facebook_link = $row['facebook_link'] ?? '';
                        $twitter_link = $row['twitter_link'] ?? '';
                        $instagram_link = $row['instagram_link'] ?? '';
                        $linkedin_link = $row['linkedin_link'] ?? '';
                    } else {
                        $first_name = $last_name = $email = $bio = $facebook_link = $twitter_link = $instagram_link = $linkedin_link = '';
                    }
                    ?>

                    <!-- User Information Form -->
                    <form action="user_dashboard.php" method="POST" class="user-info-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        value="<?php echo htmlspecialchars($first_name); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        value="<?php echo htmlspecialchars($last_name); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio:</label>
                                <textarea name="bio" id="bio" class="form-control"
                                    rows="4"><?php echo htmlspecialchars($bio); ?></textarea>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="facebook_link">Facebook Link:</label>
                                    <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                        value="<?php echo htmlspecialchars($facebook_link); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="twitter_link">Twitter Link:</label>
                                    <input type="url" name="twitter_link" id="twitter_link" class="form-control"
                                        value="<?php echo htmlspecialchars($twitter_link); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="instagram_link">Instagram Link:</label>
                                    <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                                        value="<?php echo htmlspecialchars($instagram_link); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="linkedin_link">LinkedIn Link:</label>
                                    <input type="url" name="linkedin_link" id="linkedin_link" class="form-control"
                                        value="<?php echo htmlspecialchars($linkedin_link); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Update Button -->
                        <button type="submit" name="update_user_info" class="btn btn-cs">Update</button>
                    </form>

                    <?php

                    // Check if the form is submitted
                    if (isset($_POST['update_user_info'])) {
                        $user_id = $_SESSION['user_id'];
                        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
                        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
                        $email = mysqli_real_escape_string($conn, $_POST['email']);
                        $bio = mysqli_real_escape_string($conn, $_POST['bio']);
                        $facebook_link = mysqli_real_escape_string($conn, $_POST['facebook_link']);
                        $twitter_link = mysqli_real_escape_string($conn, $_POST['twitter_link']);
                        $instagram_link = mysqli_real_escape_string($conn, $_POST['instagram_link']);
                        $linkedin_link = mysqli_real_escape_string($conn, $_POST['linkedin_link']);

                        // Update query
                        $query = "UPDATE User_Profile SET 
                        first_name = '$first_name',
                        last_name = '$last_name',
                        email = '$email',
                        bio = '$bio',
                        facebook_link = '$facebook_link',
                        twitter_link = '$twitter_link',
                        instagram_link = '$instagram_link',
                        linkedin_link = '$linkedin_link'
                        WHERE user_id = '$user_id'";

                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $_SESSION['message'] = "Profile updated successfully!";
                            $_SESSION['messageType'] = 'success';
                        } else {
                            $_SESSION['message'] = "Failed to update profile. Please try again.";
                            $_SESSION['messageType'] = 'error';
                        }
                    }
                    ?>

                </div>
            </div>


            <!-- add post is at add-new-post.php-->
            <!-- display -->
            <div class="col-md-12 add_post cp60 dash_font" id="posts">
                <h2 class="mb-3">Your Posts</h2>

                <?php
                $user_id = $_SESSION['user_id'];

                // count post
                $query = "SELECT COUNT(*) as post_count FROM blog_post WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);
                $post_count = 0;

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $post_count = $row['post_count'];
                }
                ?>

                <p>You have <strong><?php echo $post_count; ?></strong> post(s).</p>

                <!-- display post code here  -->
                <?php
                $query = "SELECT blog_post.*, category.category_name FROM blog_post
                LEFT JOIN category ON blog_post.category_id = category.category_id
                WHERE blog_post.user_id = '$user_id' ORDER BY blog_post.created_at DESC";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    while ($post = mysqli_fetch_assoc($result)) {
                        $post_id = $post['post_id'];
                        $title = $post['title'];
                        $content = $post['content'];
                        $feature_image = $post['feature_image'];
                        $created_at = date('F j, Y, g:i a', strtotime($post['created_at']));
                        $updated_at = date('F j, Y, g:i a', strtotime($post['updated_at']));
                        $category_name = $post['category_name'];

                        // excerpt
                        $excerpt = substr($content, 0, 100) . '...';
                        ?>

                        <!-- Displaying each post -->
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
                                            <?php } ?></a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ep_title">
                                        <a href="view-post.php?post_id=<?php echo $post['post_id']; ?>">
                                            <h3><?php echo htmlspecialchars($title); ?></h3>
                                        </a>
                                        <p class="mt-2 mb-2"><?php echo $excerpt; ?></p>
                                        <span>Category: <?php echo htmlspecialchars($category_name); ?>
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
                                        <i class="lni lni-thumbs-up-3"></i>
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
                                        <!-- Add a link to view post history -->
                                        <!-- <a href="user_dashboard.php?post_id=<?php echo $post_id; ?>#Post_history"
                                            class="history-link">
                                            <i class="lni lni-bookmark"></i> History
                                        </a> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <!-- Add New Post Button -->
                <a href="add-new-post.php" class="btn btn-cs">Add New Post</a>
            </div>



        </div>
    </div>
</div>
<?php include 'footer.php'; ?>