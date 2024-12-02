<div class="col-md-12 wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-dashboard-square-1"></i>
            </button>
            <div class="sidebar-logo">
                <a href="user_dashboard.php"> <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
                        <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="user_dashboard.php#profile" class="sidebar-link">
                    <i class="lni lni-user-4"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#posts" class="sidebar-link">
                    <i class="lni lni-pen-to-square"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="media.php" class="sidebar-link">
                    <i class="lni lni-gallery"></i>
                    <span>Media</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="user_dashboard.php#notification" class="sidebar-link">
                    <button type="button" class="btn notibtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="lni lni-bell-1"></i>
                        <span>Notification</span>
                    </button>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="user_dashboard.php#browsing_histroy" class="sidebar-link">
                    <i class="lni lni-search-text"></i>
                    <span>Browsing History</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-shield-2-check"></i>
                    <span>Change Password</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <form id="logoutForm" action="logout.php" method="POST">
                    <i class="lni lni-power-button" style="cursor: pointer;"
                        onclick="document.getElementById('logoutForm').submit();"> <span>Logout</span></i>
                </form>

            </a>
        </div>
    </aside>



</div>