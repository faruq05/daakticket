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

<div class=" main dashboard">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
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
                        <form action="admin_dashboard.php" method="POST" class="user-info-form">
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

                <!-- all user section and post history -->
                <div class="tables-container row" id="all_user">
                    <!-- User Info Section -->
                    <div class="user-info-container col-md-12 cp60">
                        <h3 class="mb-4">User Information...</h3>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-white">
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Registered</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user-info-table">
                                        <?php
                                        $sl_no = 1;
                                        $query = "SELECT user_id, username, email, status, role_id, registration_date FROM user";
                                        $result = mysqli_query($conn, $query);

                                        if ($result && mysqli_num_rows($result) > 0) {
                                            while ($user = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($sl_no++) . "</td>";
                                                echo "<td><a href='profile.php?user_id=" . htmlspecialchars($user['user_id']) . "'>" . htmlspecialchars($user['username']) . "</a></td>";
                                                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user['status']) . "</td>";
                                                echo "<td>" . htmlspecialchars($user['role_id'] == 1 ? 'Admin' : 'User') . "</td>";
                                                echo "<td>" . htmlspecialchars(date('d M, Y', strtotime($user['registration_date']))) . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No users found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                    <!-- Post History Section -->
                    <div class="post-history-container col-md-12 cp60" id="post_history">
                        <h3 class="mb-4">Post History...</h3>
                        <div class="accordion" id="accordionExample">
                            <!-- like notification -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#history_panel" aria-expanded="false"
                                        aria-controls="history_panel">
                                        <p>Click to Expand</p>
                                    </button>
                                </h2>
                                <div id="history_panel" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-white">
                                                        <tr>
                                                            <th>Sl no</th>
                                                            <th>Post Name</th>
                                                            <th>User Name</th>
                                                            <th>Change Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="post-history-table">
                                                        <?php
                                                        $sl_no = 1;
                                                        // Query to fetch post history
                                                        $query = "SELECT history_id, ph.post_id, p.title, u.username, ph.change_description
                                            FROM post_history ph LEFT JOIN user u ON ph.user_id = u.user_id
                                            LEFT JOIN blog_post p ON ph.post_id = p.post_id ORDER BY ph.history_id DESC";
                                                        ;

                                                        $result = mysqli_query($conn, $query);

                                                        if ($result && mysqli_num_rows($result) > 0) {
                                                            while ($history = mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td>" . htmlspecialchars($sl_no++) . "</td>";
                                                                echo "<td>" . htmlspecialchars($history['title']) . "</td>";
                                                                echo "<td>" . htmlspecialchars($history['username'] ?? 'Unknown') . "</td>";
                                                                echo "<td>" . htmlspecialchars($history['change_description']) . "</td>";
                                                                echo "</tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='4'>No history records found.</td></tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- add post is at add-new-post.php-->
                <!-- display -->
                <?php include 'fetch-post.php'; ?>
            </div>

            <!-- category view -->
            <div class="col-md-12">
                <div class="add_category cp60 dash_font" id="add_category">
                    <h3 class="mb-4">Existing Categories</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Category Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM category ORDER BY category_id DESC";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $serialNo = 1;
                                while ($category = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$serialNo}</td> 
                                        <td>{$category['category_name']}</td>
                                        
                                        </tr>";
                                    $serialNo++; // Increment the serial number
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>No categories available.</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                    <a href="category_management.php" class="btn btn-cs">Add New Category</a>
                </div>
            </div>

            <!-- browsing history -->
            <div class="col-md-12 add_post cp60 dash_font" id="browsing_histroy">
                <?php
                ob_start();
                // Ensure user is logged in
                if (!isset($_SESSION['user_id'])) {
                    echo "Please log in to view search history.";
                    exit;
                }

                $user_id = $_SESSION['user_id'];

                // Handle search history deletion
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_search_history'])) {
                    $delete_query = "DELETE FROM search_history WHERE user_id = $user_id";
                    if (mysqli_query($conn, $delete_query)) {
                        $_SESSION['message'] = "Search history deleted successfully!";
                        $_SESSION['messageType'] = "success";
                    } else {
                        $_SESSION['message'] = "Failed to delete search history. Please try again.";
                        $_SESSION['messageType'] = "error";
                    }
                }

                // Fetch search history
                $search_history_query = "
    SELECT search_query, search_timestamp
    FROM search_history
    WHERE user_id = $user_id
    ORDER BY search_timestamp DESC
";
                $search_history_result = mysqli_query($conn, $search_history_query);
                ob_end_flush(); ?>

                <div class="history_header d-flex align-items-center justify-content-between mb-2">
                    <h3>Browsing History</h3>
                    <form method="POST"
                        onsubmit="return confirm('Are you sure you want to delete all search history?');">
                        <button type="submit" name="delete_search_history" class="btn btn-danger mb-3">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </div>
                <div class="history-panel">
                    <?php if ($search_history_result && mysqli_num_rows($search_history_result) > 0): ?>
                        <ul class="history-list">
                            <?php while ($history = mysqli_fetch_assoc($search_history_result)): ?>
                                <li>
                                    <span class="search-query">
                                        You searched for <b>"<?php echo htmlspecialchars($history['search_query']); ?>"</b>
                                    </span>
                                    <span class="search-timestamp">
                                        at - <b><?php echo date('d/m/Y H:i:s', strtotime($history['search_timestamp'])); ?></b>
                                    </span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                        <div class="nothing_found text-center">
                            <img src="assets/uploads/no_history.png" class="img-fluid w-10" alt="no_history">
                            <p class="text-center mt-4">No search history available.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- forgot_password -->
            <div class="col-md-12 add_post cp60 dash_font" id="forgot_password">
                <h3>Forgot Password?</h3>
                <p class="mt-2"><a href="forgot_password.php">Click Here</a> to change password</p>
            </div>
        </div>


        <!-- notification panel in modal -->
        <div class="row">
            <div class="col-md-12">
                <div class="bell" id="noti_bell">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="lni lni-bell-1"></i>
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Notifications</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- notification center -->
                                <div class="col-md-12 add_post cp60 dash_font" id="notification">
                                    <?php
                                    // Ensure user is logged in
                                    if (!isset($_SESSION['user_id'])) {
                                        echo "Please log in to view notifications.";
                                        exit;
                                    }

                                    $user_id = $_SESSION['user_id'];

                                    // Fetch notifications for likes
                                    $like_notifications_query = "
    SELECT l.created_at, u.username, p.title, p.post_id
    FROM likes l
    INNER JOIN user u ON l.user_id = u.user_id
    INNER JOIN blog_post p ON l.post_id = p.post_id
    WHERE p.user_id = $user_id
    ORDER BY l.created_at DESC
";
                                    $like_notifications_result = mysqli_query($conn, $like_notifications_query);

                                    // Fetch notifications for comments
                                    $comment_notifications_query = "
    SELECT c.created_at, u.username, c.comment_text, p.title, p.post_id
    FROM comment c
    INNER JOIN user u ON c.user_id = u.user_id
    INNER JOIN blog_post p ON c.post_id = p.post_id
    WHERE p.user_id = $user_id
    ORDER BY c.created_at DESC
";
                                    $comment_notifications_result = mysqli_query($conn, $comment_notifications_query);
                                    ?>

                                    <div class="notification-panel">
                                        <div class="accordion" id="accordionExample">
                                            <!-- like notification -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#like_panel"
                                                        aria-expanded="false" aria-controls="like_panel">
                                                        <h4><i class="lni lni-thumbs-up-3 pe-2"></i>Likes</h4>
                                                    </button>
                                                </h2>
                                                <div id="like_panel" class="accordion-collapse collapse"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <?php if ($like_notifications_result && mysqli_num_rows($like_notifications_result) > 0): ?>
                                                            <ul class="notification-list">
                                                                <?php while ($like = mysqli_fetch_assoc($like_notifications_result)): ?>
                                                                    <li>
                                                                        <strong>
                                                                            <?php echo htmlspecialchars($like['username']); ?>
                                                                        </strong> liked your post
                                                                        <a
                                                                            href="view-post.php?post_id=<?php echo $like['post_id']; ?>">
                                                                            "
                                                                            <?php echo htmlspecialchars($like['title']); ?>"
                                                                        </a>
                                                                        on
                                                                        <?php echo date('d/m/Y H:i:s', strtotime($like['created_at'])); ?>.
                                                                    </li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <div class="nothing_found text-center mt-2">
                                                                <img src="assets/uploads/like.png" class="img-fluid w-10"
                                                                    alt="like">
                                                                <p class="text-center mt-4">No likes yet.</p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- comment notification -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        <h4><i class="lni lni-comment-1-text pe-2"></i>Comments</h4>
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <?php if ($comment_notifications_result && mysqli_num_rows($comment_notifications_result) > 0): ?>
                                                            <ul class="notification-list">
                                                                <?php while ($comment = mysqli_fetch_assoc($comment_notifications_result)): ?>
                                                                    <li>
                                                                        <strong>
                                                                            <?php echo htmlspecialchars($comment['username']); ?>
                                                                        </strong> commented on your
                                                                        post
                                                                        <a
                                                                            href="view-post.php?post_id=<?php echo $comment['post_id']; ?>">
                                                                            "
                                                                            <?php echo htmlspecialchars($comment['title']); ?>"
                                                                        </a>:
                                                                        <q>
                                                                            <?php echo htmlspecialchars($comment['comment_text']); ?>
                                                                        </q>
                                                                        on
                                                                        <?php echo date('d/m/Y H:i:s', strtotime($comment['created_at'])); ?>.
                                                                    </li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <div class="nothing_found text-center mt-2">
                                                                <img src="assets/uploads/comment.png" class="img-fluid w-10"
                                                                    alt="comment">
                                                                <p class="text-center mt-4">No comments yet.</p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'footer.php'; ?>