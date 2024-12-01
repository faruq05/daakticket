<?php
ob_start();
include 'header.php';
include 'sidebar.php';
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    $_SESSION['message'] = 'Please verify your OTP before accessing the dashboard.';
    $_SESSION['messageType'] = 'error';
    header('Location: verify_otp.php');
    exit();
}
ob_end_flush(); ?>
<div class=" main dashboard usb">
    <div class="container-lg">
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
                    // user_profile update
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

                        $profile_result = mysqli_query($conn, $query);

                        $update_user_query = "
                        UPDATE user 
                        SET 
                        first_name = '$first_name',
                        last_name = '$last_name',
                        email = '$email'
                        WHERE user_id = '$user_id'";

                        $user_result = mysqli_query($conn, $update_user_query);

                        if ($profile_result && $user_result) {
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
            <!-- user post info is in fetch_post.php -->
            <?php include 'fetch-post.php'; ?>


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
            <div class="col-md-12 add_post cp60 dash_font" id="browsing_histroy">
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
                <?php include 'notification.php' ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>