<?php
include 'header.php';
include 'admin_sidebar.php';
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1001) {
    header('Location: login.php');
    exit();
}

?>
<div class=" main dashboard">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="dash">
                    <?php
                    echo "<h1>Welcome to Admin Dashboard</h1>";
                    echo "<p>Hello, " . $_SESSION['username'] . "!</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>