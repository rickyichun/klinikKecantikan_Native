<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>Calendar</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right"></ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="pb-2">
                        <?php if ($role!='perawat') { 
                        ?>
                        <a href="inputjadwal.php">
                            <button class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                Tambah Jadwal
                            </button>
                        </a>
                        <?php } ?>

                        <a href="masterjadwal.php">
                            <button class="btn btn-primary">
                                <i class="fa fa-calendar"></i>
                                Daftar Jadwal
                            </button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-12">
                        <div class="card card-primary">
                            <div class="card-body p-2">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <div class="sticky-top mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Summary jadwal Pasien Hari ini:</h4>
                                </div>
                                <div class="card-body">
                                    <?php 
                                    $tglskg = date("Y-m-d");
                                    $query= mysqli_query($conn, "SELECT status,COUNT(status) as jumlah from jadwal WHERE tgl='$tglskg' AND status!='cancel' GROUP BY status order by jumlah asc");

                                    while($data=mysqli_fetch_array($query)){
                                        if($data['status']=='booked'){
                                            $bgcolor='bg-primary';
                                        }else if($data['status']=='done'){
                                            $bgcolor='bg-success';
                                        }else if($data['status']=='proses'){
                                            $bgcolor='bg-warning';
                                        }else if($data['status']=='cancel'){
                                            $bgcolor='bg-danger';
                                        };
                                        ?>
                                    <div class="card w-100 p-2 pr-3 <?= $bgcolor?>">
                                        <div class="d-flex justify-content-between">
                                            <div class="float-start">
                                                <b>
                                                    <?= $data['status']?>
                                                </b>
                                            </div>
                                            <div class="float-end">
                                                <b>
                                                    <?= $data['jumlah']?>
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">

        </aside>

        <?php include('../componen/foot.php'); ?>
    </div>
    <?php include('../componen/script.php'); ?>

</body>

</html>