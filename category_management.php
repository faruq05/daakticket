<?php
ob_start();
include 'header.php';
include 'admin_sidebar.php';

// Handle Add Category
if (isset($_POST['add_category'])) {
    $category_name = mysqli_real_escape_string($conn, trim($_POST['category_name']));

    if (!empty($category_name)) {
        // Check if the category already exists
        $check_query = "SELECT * FROM category WHERE category_name = '$category_name'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Category already exists
            $_SESSION['message'] = "Category already exists!";
            $_SESSION['messageType'] = "error";
        } else {
            // Insert the new category
            $query = "INSERT INTO category (category_name) VALUES ('$category_name')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = "Category added successfully!";
                $_SESSION['messageType'] = "success";
            } else {
                $_SESSION['message'] = "Failed to add category. Please try again.";
                $_SESSION['messageType'] = "error";
            }
        }
    } else {
        $_SESSION['message'] = "Category name cannot be empty.";
        $_SESSION['messageType'] = "error";
    }
}

// Handle Delete Category
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    $query = "DELETE FROM category WHERE category_id = $delete_id";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Category deleted successfully!";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete category. Please try again.";
        $_SESSION['messageType'] = "error";
    }
    header('Location: category_management.php');
    exit();
}
ob_end_flush();
?>

<div class="main categorypg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 cp60">
                <!-- Add Category Form -->
                <div class="add_category_form">
                    <h3 class="mt-2 mb-4">Add New Category</h3>
                    <div class="card p-4">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                    required>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-cs">Add Category</button>
                        </form>
                    </div>
                </div>

                <!-- Display Existing Categories -->
                <div class="display_category cp60">
                    <h3 class="mt-2 mb-4">Existing Categories</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Category Name</th>
                                <th>Actions</th>
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
                                        <td>
                                            <a href='?delete_id={$category['category_id']}' 
                                            class='btn btn-danger btn-sm'
                                            onclick='return confirm(\"Are you sure you want to delete this category?\")'>
                                            Delete
                                        </a></td>
                                        </tr>";
                                    $serialNo++; 
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>No categories available.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="admin_dashboard.php" class="btn btn-cs ep_dlt">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>