<?php
include 'header.php';
include 'sidebar.php';
?>
<div class=" main dashboard">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
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
                    <div class="profile-container">
                        <!-- Profile picture container -->
                        <div class="profile-picture-container">
                            <?php
                            if ($profile_picture && file_exists($profile_picture)) {
                                $updated_profile_picture = $profile_picture . '?' . time();
                                echo "<img src='$updated_profile_picture' alt='Profile Picture' class='profile-picture' />";
                            } else {
                                // placeholder image
                                echo "<img src='uploads/profile_pictures/default_profile.png' alt='Profile Picture' class='profile-picture img-fluid' />";
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
                            // Show options to change or delete the profile picture
                            echo '<div class="profile-options">';
                            // echo '<form action="upload_profile_picture.php" method="GET"><button type="submit" class="btn btn-primary">Change Profile Picture</button></form>';
                            echo '<form action="delete_profile_picture.php" method="POST"><button type="submit" name="delete_picture" class="btn btn-danger mt-2">Delete Profile Picture</button></form>';
                            echo '</div>';
                        }

                        if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
                            // Display the welcome message if logged in
                            echo '<h2>Welcome to Your Dashboard, ' . htmlspecialchars($_SESSION['username']) . '!</h2>';
                        } else {
                            // Redirect or display message if not logged in
                            echo '<p>You are not logged in. Please <a href="login.php">login</a> to access the dashboard.</p>';
                        }
                        ?>
                    </div>

                </div>
            </div>

            <!-- user_info profile -->

            <div class="col-md-12">
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


        </div>
    </div>
</div>
<?php include 'footer.php'; ?>