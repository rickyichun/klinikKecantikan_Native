<?php include('head.php'); ?>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" id="back" href="javascript:window.history.back()" role="button">
                        <i class="fas fa-undo"></i> Kembali
                    </a>
                </li>

                <li class="nav-item">
                    <?php
                    $statcekin = $_SESSION['checkin'];
                    if($statcekin=='Anda Belum Checkin'){
                    ?>
                    <a class="nav-link" href="../transaksi/inputabsen.php" role="button">
                        <i class="fas fa-key"></i> <?php echo $statcekin; ?>
                    </a>
                    <?php 
                    } else if ($statcekin=='Anda Sudah Checkout') { ?>
                    <a class="nav-link" href="../transaksi/inputabsen.php"
                        onclick="javascript: return confirm('Anda yakin Checkout ulang ? Absen anda akan di reset !')">
                        <i class="fas fa-clock"></i> <?php echo $statcekin." Hari Ini"; ?>
                    </a>
                    <?php } else { ?>
                    <a class="nav-link" href="../transaksi/inputabsen.php"
                        onclick="javascript: return confirm('Anda yakin Checkout? Anda tidak dapat checkout ulang setelah ini!')">
                        <i class="fas fa-clock"></i> <?php echo date("d-m-Y H:i:s",strtotime($statcekin)); ?>
                    </a>
                    <?php } ?>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="refresh" onmouseover="hover_refresh()" onmouseout="unhover_refresh()"
                        href="javascript:window.location.reload()" role="button">
                        <i class="fas fa-retweet"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="expand" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="logout" onmouseover="hover_logout()" onmouseout="unhover_logout()"
                        href="../control/logout.php" role="button">
                        <i class="fas fa-door-open"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <script>
        function hover_logout() {
            document.getElementById("logout").innerHTML = '<i class="fas fa-door-open"></i> Log Out'
        }

        function unhover_logout() {
            document.getElementById("logout").innerHTML = '<i class="fas fa-door-open"></i>'
        }

        function hover_refresh() {
            document.getElementById("refresh").innerHTML = '<i class="fas fa-retweet"></i> Refresh'
        }

        function unhover_refresh() {
            document.getElementById("refresh").innerHTML = '<i class="fas fa-retweet"></i>'
        }
        </script>