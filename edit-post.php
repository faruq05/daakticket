<?php
ob_start();
include 'header.php';
include 'sidebar.php';
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Fetch the post data from the database
    $query = "SELECT * FROM blog_post WHERE post_id = '$post_id'";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);

    if (!$post) {
        $_SESSION['message'] = "Post not found.";
        $_SESSION['messageType'] = "error";
        header('Location: user_dashboard.php');
        exit();
    }

    if (isset($_POST['submit_post'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
        $feature_image = $post['feature_image']; // Default to current feature image

        // Handle feature image upload
        if (isset($_FILES['feature_image']) && $_FILES['feature_image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = $_FILES['feature_image']['tmp_name'];
            $image_name = 'post_' . time() . '_' . $_FILES['feature_image']['name'];
            $image_path = 'assets/uploads/post_images/' . $image_name;

            if (move_uploaded_file($image_tmp, $image_path)) {
                $feature_image = $image_path; // Update to the new image
            }
        }

        // Update post in the database
        $update_query = "UPDATE blog_post SET title = '$title', content = '$content', feature_image = '$feature_image', category_id = '$category_id', status = 'pending', updated_at = NOW() WHERE post_id = '$post_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            // add the update in post_history
            $change_description = "Updated post: $title";
            $log_query = "INSERT INTO post_history (post_id, user_id, change_description) 
                          VALUES ('$post_id', '{$_SESSION['user_id']}', '$change_description')";
            mysqli_query($conn, $log_query);

            $_SESSION['message'] = "Post updated successfully, waiting for admin approval!";
            $_SESSION['messageType'] = "success";
            header('Location: user_dashboard.php');
            exit();
        } else {
            $_SESSION['message'] = "Failed to update post. Please try again.";
            $_SESSION['messageType'] = "error";
        }
    }
} else {
    // Redirect if no post_id is provided
    header('Location: user_dashboard.php');
    exit();
}
ob_end_flush(); ?>

<div class="main dashboard post">
    <div class="container">
        <div class="row align-items-center">
            <div class="post_box cp60">
                <h2 class="mb-5">Edit Post</h2>
                <form action="edit-post.php?post_id=<?php echo $post_id; ?>" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea name="content" id="content" class="form-control" rows="5"
                            required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                    <div class="form-group edit-ftimg">
                        <div class="col-md-7">
                            <label for="feature_image">Feature Image:</label>
                            <input type="file" name="feature_image" id="feature_image" class="form-control"
                                onchange="previewImage(event)">
                        </div>
                        <div class="col-md-4">
                            <img id="preview_image" src="<?php echo $post['feature_image']; ?>" class="img-fluid mt-2"
                                alt="Current Feature Image">
                        </div>
                    </div>

                    <script>
                        function previewImage(event) {
                            const file = event.target.files[0];
                            const preview = document.getElementById('preview_image');
                            if (file) {
                                const reader = new FileReader();

                                reader.onload = function (e) {
                                    preview.src = e.target.result;
                                };

                                reader.readAsDataURL(file);
                            }
                        }
                    </script>

                    <div class="form-group">
                        <label for="category_id">Category:</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            <?php
                            // Fetch categories from the database
                            $category_query = "SELECT * FROM category";
                            $category_result = mysqli_query($conn, $category_query);
                            while ($category = mysqli_fetch_assoc($category_result)) {
                                echo "<option value='{$category['category_id']}'" . ($category['category_id'] == $post['category_id'] ? ' selected' : '') . ">{$category['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group post_button  mt-3">
                        <button type="submit" name="submit_post" class="btn btn-cs">Update Post</button>
                        <a href="user_dashboard.php" class="btn btn-cs ms-2">Don't want to Edit</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>