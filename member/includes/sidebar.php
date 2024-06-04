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
    <hr class="sidebar-divider my-2">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $page == 'index.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?= $page == 'jaapdetail.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="jaapdetail.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Jaap Summary</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-2">
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
                <a class="collapse-item <?= $page == 'jaap.php' ? 'active' : ''; ?>" href="jaap.php">View Jaap</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider my-2">
    
    <li class="nav-item <?= $page == 'donation.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="donation.php">
            <i class="fas fa-fw fa-coins"></i>
            <span>Donations</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
