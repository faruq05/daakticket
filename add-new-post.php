<?php
ob_start();
include 'header.php';
include 'sidebar.php';

if (isset($_POST['submit_post'])) {
    // Ensure the user is signed in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = 'You must be logged in to create a post.';
        $_SESSION['messageType'] = 'error';
        header('Location: login.php');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $role_id = $_SESSION['role_id']; // Admin or User
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $feature_image = '';

    // Handle feature image upload
    if (isset($_FILES['feature_image']) && $_FILES['feature_image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['feature_image']['tmp_name'];
        $image_name = 'post_' . time() . '_' . $_FILES['feature_image']['name'];
        $image_path = 'assets/uploads/post_images/' . $image_name;

        if (move_uploaded_file($image_tmp, $image_path)) {
            $feature_image = $image_path;
        }
    }

    // Insert post into the database
    $query = "INSERT INTO blog_post (user_id, title, content, feature_image, category_id, created_at) 
              VALUES ('$user_id', '$title', '$content', '$feature_image', '$category_id', NOW())";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Optional: Log the post creation in the post history
        $last_post_id = mysqli_insert_id($conn);
        $change_description = "Created new post: $title";
        $log_query = "INSERT INTO post_history (post_id, user_id, change_description) 
                      VALUES ('$last_post_id', '$user_id', '$change_description')";
        mysqli_query($conn, $log_query);

        $_SESSION['message'] = 'Post created successfully!';
        $_SESSION['messageType'] = 'success';

        // Redirect based on role
        if ($role_id == 1001) {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: user_dashboard.php');
        }
        exit();
    } else {
        $_SESSION['message'] = 'Failed to create post. Please try again.';
        $_SESSION['messageType'] = 'error';
    }
}

ob_end_flush();?>


<div class="main dashboard post">
    <div class="container">
        <div class="row align-items-center">
            <div class="post_box cp60">
                <h2 class="mb-5">Add New Post</h2>
                <form action="add-new-post.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="feature_image">Feature Image:</label>
                        <input type="file" name="feature_image" id="feature_image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category:</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php
                            // Fetch categories from the database
                            $category_query = "SELECT * FROM category";
                            $category_result = mysqli_query($conn, $category_query);
                            while ($category = mysqli_fetch_assoc($category_result)) {
                                echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group post_button  mt-3">
                        <button type="submit" name="submit_post" class="btn btn-cs">Publish Post</button>
                        <a href="user_dashboard.php" class="btn btn-cs ms-2">Cancel Post</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>