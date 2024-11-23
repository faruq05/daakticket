<?php
include "header.php";
include 'db.php';
include 'admin_sidebar.php';
ob_start();
// Function to log admin actions
if (!function_exists('log_admin_action')) {
    function log_admin_action($conn, $action_description)
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = (int) $_SESSION['user_id'];
            $action_description = mysqli_real_escape_string($conn, $action_description);
            $log_query = "INSERT INTO admin_actions (user_id, action_description) 
                         VALUES ($user_id, '$action_description')";
            if (!mysqli_query($conn, $log_query)) {
                error_log("Failed to log admin action: " . mysqli_error($conn));
            }
        }
    }
}
// Example of logging an action (you can remove this after testing)
if (isset($_SESSION['user_id'])) {
    log_admin_action($conn, "Viewed admin activity log");
}
// Fetch all admin actions
$query = "SELECT a.action_id, u.username, a.action_description, a.action_timestamp 
          FROM admin_actions a
          LEFT JOIN user u ON a.user_id = u.user_id
          ORDER BY a.action_timestamp DESC";
$result = mysqli_query($conn, $query);
// Check for query error
if (!$result) {
    echo "Error: " . mysqli_error($conn);
}
ob_end_flush();
?>
<div class=" main dashboard cp60">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <h3 class="mt-4 mb-4">Admin Activity Log</h3>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Admin Username</th>
                                    <th>Action Description</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $serialNo = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $serialNo++; ?></td>
                                            <td><?php echo htmlspecialchars($row['username'] ?? 'Unknown Admin'); ?></td>
                                            <td><?php echo htmlspecialchars($row['action_description']); ?></td>
                                            <td><?php echo date('d/m/Y H:i:s', strtotime($row['action_timestamp'])); ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No actions logged yet.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="admin_dashboard.php" class="btn btn-cs mt-3">Go Back</a>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>