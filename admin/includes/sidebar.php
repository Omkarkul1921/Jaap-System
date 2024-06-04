<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-om"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Jaap System</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-3">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $page == 'index.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider my-1">

    <li class="nav-item <?= $page == 'jaapdetail.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="jaapdetail.php">
            <i class="fas fa-fw fa-list-check"></i>
            <span>Jaap Summary</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-1">

    <!-- Heading -->
    <div class="sidebar-heading">Jaap</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($page == 'jaap-create.php' || $page == 'jaap.php') ? 'active' : ''; ?>">
        <a class="nav-link <?= ($page == 'jaap-create.php' || $page == 'jaap.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="<?= ($page == 'jaap-create.php' || $page == 'jaap.php') ? 'true' : 'false'; ?>"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-om"></i>
            <span>Jaap</span>
        </a>
        <div id="collapseTwo" class="collapse <?= ($page == 'jaap-create.php' || $page == 'jaap.php') ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jaap Components:</h6>
                <a class="collapse-item <?= $page == 'jaap-create.php' ? 'active' : ''; ?>" href="jaap-create.php">Create Jaap</a>
                <a class="collapse-item <?= $page == 'jaap.php' ? 'active' : ''; ?>" href="jaap.php">View Jaap</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= ($page == 'members-create.php' || $page == 'members.php' || $page == 'approve-members.php') ? 'active' : ''; ?>">
        <a class="nav-link <?= ($page == 'members-create.php' || $page == 'members.php' || $page == 'approve-members.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="<?= ($page == 'members-create.php' || $page == 'members.php' || $page == 'approve-members.php') ? 'true' : 'false'; ?>"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>Member</span>
        </a>
        <div id="collapseUtilities" class="collapse <?= ($page == 'members-create.php' || $page == 'members.php' || $page == 'approve-members.php') ? 'show' : ''; ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Member</h6>
                <a class="collapse-item <?= $page == 'members-create.php' ? 'active' : ''; ?>" href="members-create.php">Add Member</a>
                <a class="collapse-item <?= $page == 'members.php' ? 'active' : ''; ?>" href="members.php">View Member</a>
                <a class="collapse-item <?= $page == 'approve-members.php' ? 'active' : ''; ?>" href="approve-members.php">Approve Member</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item <?= ($page == 'admin-create.php' || $page == 'admins.php') ? 'active' : ''; ?>">
        <a class="nav-link <?= ($page == 'admin-create.php' || $page == 'admins.php') ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="<?= ($page == 'admin-create.php' || $page == 'admins.php') ? 'true' : 'false'; ?>"
            aria-controls="collapseUsers">
            <i class="fas fa-fw fa-user"></i>
            <span>Admin</span>
        </a>
        <div id="collapseUsers" class="collapse <?= ($page == 'admin-create.php' || $page == 'admins.php') ? 'show' : ''; ?>" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User</h6>
                <a class="collapse-item <?= $page == 'admin-create.php' ? 'active' : ''; ?>" href="admin-create.php">Add Admin</a>
                <a class="collapse-item <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins.php">View Admins</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
