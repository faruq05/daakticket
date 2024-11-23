<?php include 'header.php';
// Get the search query from the URL
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

// search data store checking user logged in
if (isset($_SESSION['user_id']) && !empty($search_query)) {
    $user_id = $_SESSION['user_id'];
    $insert_history_query = "INSERT INTO search_history (user_id, search_query) VALUES ('$user_id', '$search_query')";
    mysqli_query($conn, $insert_history_query);
}

// Query to search for posts
$query = "SELECT p.*, u.username, c.category_name
          FROM blog_post p
          LEFT JOIN user u ON p.user_id = u.user_id
          LEFT JOIN category c ON p.category_id = c.category_id
          WHERE p.title LIKE '%$search_query%' OR p.content LIKE '%$search_query%'
          ORDER BY p.created_at DESC";

$result = mysqli_query($conn, $query);
?>

<div class="contactpg aboutpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <?php if (!empty($search_query)) { ?>
                    <div class="search-query-display">
                        <h2>Showing results for:
                            <?php echo htmlspecialchars($search_query); ?></h2>
                    </div>
                <?php } ?>
              
            </div>
        </div>
    </div>
</div>

<div class="blogs cp60">
    <div class="container">
        <div class="row gy-4">
            <!-- Filter by categories -->
            <?php
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
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>No results found for your search query.</p>";
        }
        ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>