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
                        <!-- HTML Form for Uploading and Deleting Profile Picture -->
                        <?php
                        // Fetch the user's profile picture from the database
                        $user_id = $_SESSION['user_id']; // Assuming you have the user's ID stored in the session
                        
                        // Query to get the profile picture path from the User_Profile table
                        $query = "SELECT profile_picture FROM User_Profile WHERE user_id = '$user_id'";
                        $result = mysqli_query($conn, $query);
                        $profile_picture = '';

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $profile_picture = $row['profile_picture'];
                        }
                        ?>

                        <div class="profile-container">
                            <!-- Profile picture container -->
                            <div class="profile-picture-container">
                                <?php
                                if ($profile_picture && file_exists($profile_picture)) {
                                    // Display the uploaded profile picture
                                    //echo "<img src='$profile_picture' alt='Profile Picture' class='profile-picture' />";
                                    $updated_profile_picture = $profile_picture . '?' . time();
                                    echo "<img src='$updated_profile_picture' alt='Profile Picture' class='profile-picture' />";
                                } else {
                                    // Display default placeholder if no profile picture is uploaded
                                    echo "<img src='uploads/profile_pictures/default_profile.png' alt='Profile Picture' class='profile-picture img-fluid' />";
                                }
                                ?>
                                <!-- Hover effect to upload new picture -->
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
                            ?>
                        </div>



                        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
                            <!-- Display the welcome message if logged in -->
                            <h2>Welcome to Your Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

                        <?php else: ?>
                            <!-- Redirect or display message if not logged in -->
                            <p>You are not logged in. Please <a href="login.php">login</a> to access the dashboard.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>