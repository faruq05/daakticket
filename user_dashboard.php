<?php 
include 'header.php'; 
?>

<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
                    <!-- Display the welcome message if logged in -->
                    <h2>Welcome to Your Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                    
                    <!-- Logout Button -->
                    <form action="logout.php" method="POST">
                        <button type="submit" name="logout" class="btn btn-danger mt-2">Logout</button>
                    </form>
                <?php else: ?>
                    <!-- Redirect or display message if not logged in -->
                    <p>You are not logged in. Please <a href="login.php">login</a> to access the dashboard.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
