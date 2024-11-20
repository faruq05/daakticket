    <!-- User Management Section -->
    <section>
        <h2>Manage Users</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo $user['status'] == 1 ? 'Active' : 'Restricted'; ?></td>
                        <td>
                            <a href="restrict_user.php?id=<?php echo $user['id']; ?>">Restrict</a> |
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Post Management Section -->
    <section>
        <h2>Manage Posts</h2>
        <a href="add_post.php">Add New Post</a>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['author']); ?></td>
                        <td><?php echo $post['created_at']; ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a> |
                            <a href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>











     <!-- post history============================================================ -->

     <div class="col-md-12 post_history cp60 dash_font" id="Post_history">
                <h2 class="mb-3">Post History</h2>
                <?php
                if (isset($_GET['post_id']) && !empty($_GET['post_id'])) {
                    $post_id = intval($_GET['post_id']); // Ensure post_id is an integer
                
                    // Fetch post history (adjust table name as needed)
                    $query = "SELECT ph.*, up.user_id 
                              FROM post_history ph
                              LEFT JOIN User_Profile up ON ph.user_id = up.user_id
                              WHERE ph.post_id = '$post_id'
                              ORDER BY ph.change_timestamp DESC";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table">
                                <thead>
                                    <tr>
                                        <th>Change Timestamp</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while ($history = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($history['change_timestamp']) . "</td>
                                    <td>" . htmlspecialchars($history['change_description']) . "</td>
                                  </tr>";
                        }
                        echo '</tbody></table>';
                    } else {
                        echo "<p>No history available for this post.</p>";
                    }
                } else {
                    echo "<p><strong>Note:</strong> Click the history icon on a post to view its history.</p>";
                }

                ?>
            </div>








             <!-- Comments Section -->
             <div class="comment_section cp60">
                <h2>Comments</h2>
                <?php
                if ($comments_result && mysqli_num_rows($comments_result) > 0) {
                    while ($comment = mysqli_fetch_assoc($comments_result)) {
                        // Determine the user's profile image or use a placeholder
                        $profile_image = !empty($comment['profile_picture'])
                            ? htmlspecialchars($comment['profile_picture'])
                            : 'assets/uploads/profile_pictures/default_profile.png';
                        ?>
                        <div class="comment-add">
                            <img src="<?php echo $profile_image; ?>" alt="User Image" class="img-fluid me-3"
                                style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <div class="">
                                <div class="comment-header d-flex align-items-center">
                                    <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                                    <span
                                        class="comment-date ms-2 me-2">(<?php echo date('d/m/Y H:i:s', strtotime($comment['created_at'])); ?>):
                                    </span>
                                </div>
                                <p class="comment-text"><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No comments yet. Be the first to comment!</p>";
                }
                ?>
                <hr>



                <!-- Comment Form -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST">
                        <textarea name="comment_text" class="form-control" placeholder="Write your thoughts..."
                            required></textarea>
                        <button type="submit" class="btn btn-cs mt-2">Post Comment</button>
                    </form>
                <?php else: ?>
                    <p>Please <a href="login.php">sign in</a> to comment.</p>
                <?php endif; ?>


            </div>