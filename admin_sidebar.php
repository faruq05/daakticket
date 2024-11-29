<div class="col-md-12 wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-dashboard-square-1"></i>
            </button>
            <div class="sidebar-logo">
                <a href="#">
                    <p>admin</p>
                </a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="admin_dashboard.php#profile" class="sidebar-link">
                    <i class="lni lni-user-4"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_dashboard.php#all_user" class="sidebar-link">
                    <i class="lni lni-pen-to-square"></i>
                    <span>All Users</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_dashboard.php#post_history" class="sidebar-link">
                    <i class="lni lni-box-archive-1"></i>
                    <span>Post History</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_dashboard.php#admin_post" class="sidebar-link">
                    <i class="lni lni-pen-to-square"></i>
                    <span>Your Post</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="approve_post.php" class="sidebar-link">
                    <i class="lni lni-check-circle-1"></i>
                    <span>Post Manager</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_dashboard.php#add_category" class="sidebar-link">
                    <i class="lni lni-dashboard-square-1"></i>
                    <span>Add New Category</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="admin_action.php" class="sidebar-link">
                    <i class="lni lni-gear-1"></i>
                    <span>Admin Actions</span>
                </a>
            </li>
            <li class="sidebar-item">

                <a href="admin_dashboard.php#notification" class="sidebar-link">
                    <button type="button" class="btn notibtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="lni lni-bell-1"></i>
                        <span>Notification</span>
                    </button>

                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_dashboard.php#browsing_histroy" class="sidebar-link">
                    <i class="lni lni-search-text"></i>
                    <span>Browse History</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="admin_dashboard.php#forgot_password" class="sidebar-link">
                    <i class="lni lni-shield-2-check"></i>
                    <span>Change Paassword</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <form id="logoutForm" action="logout.php" method="POST">
                    <i class="lni lni-power-button" style="cursor: pointer;"
                        onclick="document.getElementById('logoutForm').submit();"></i>
                </form>
                <span>Logout</span>
            </a>
        </div>
    </aside>



</div>