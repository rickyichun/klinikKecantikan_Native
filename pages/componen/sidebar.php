<?php 
include('navbar.php'); ?>
<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../../dist/img/klinikdemo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Klinik Demo</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user1.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="../user/editusr.php?uid=<?php echo $_SESSION['user_id']; ?>"
                    class="d-block"><?php echo $fullname; ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <?php include('menu.php'); ?>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>