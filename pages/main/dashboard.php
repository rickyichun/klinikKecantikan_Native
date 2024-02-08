<?php include('../componen/head.php');

?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <!-- Info boxes -->
                    <?php 
                    if($role!='marketing'){ ?>
                    <div class="row">
                        <!-- <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Jenis Barang</span>
                                    <span class="info-box-number">
                                        <?php $barang=mysqli_query($conn, "SELECT * from m_barang");
                                        $brg=mysqli_num_rows($barang);
                                        echo $brg;
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><a href="../barang/masterbrg.php"><i
                                            class="fas fa-stop"></i></a></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Barang Mendekati Habis</span>
                                    <span class="info-box-number">
                                        <?php $qbarang=mysqli_query($conn, "SELECT * from m_barang WHERE stok<minstok");
                                        $stokbrg=mysqli_num_rows($qbarang);
                                        echo $stokbrg;
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><a
                                        href="../transaksi/history_trx.php"><i
                                            class="fas fa-shopping-cart"></i></a></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Tindakan Berjalan</span>
                                    <span class="info-box-number">
                                        <?php $trx=mysqli_query($conn, "SELECT *, riw_trx.id as idt, riw_trx.tglupdate as tglnew FROM riw_trx, pasien, namapkt, perawat, tb_user WHERE riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id AND riw_trx.idpwt=perawat.id AND riw_trx.iduser=tb_user.user_id  order by riw_trx.id desc");
                                        $tr=mysqli_num_rows($trx);
                                        echo $tr;
                                        
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><a
                                        href="../pasien/masterpasien.php"><i class="fas fa-users"></i></a></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Pasien</span>
                                    <span class="info-box-number">
                                        <?php $pasien=mysqli_query($conn, "SELECT * from pasien");
                                        $psn=mysqli_num_rows($pasien);
                                            echo $psn;
                                        ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Summary Report</h5>

                                    <!-- <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-tool dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="fas fa-wrench"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                <a href="#" class="dropdown-item">Action</a>
                                                <a href="#" class="dropdown-item">Another action</a>
                                                <a href="#" class="dropdown-item">Something else here</a>
                                                <a class="dropdown-divider"></a>
                                                <a href="#" class="dropdown-item">Separated link</a>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div> -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <!-- chart 
                                            <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                            </p>

                                            <div class="chart">
                                                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                            </div>
                                        </div> -->
                                        <?php 
                                        $query= mysqli_query($conn, "SELECT status,COUNT(status) as jumlah from riw_trx GROUP BY status order by status='done',status='slse_tindakan',status='tindakan',status='pratindakan',status='pemeriksaan'");
                                        $hasil=mysqli_fetch_array($query);
                                        if($hasil!=null){
                                        ?>
                                        <div class="col-md-12">
                                            <p class="text-center">
                                                <strong>Status Tindakan Berjalan</strong>
                                            </p>

                                            <?php 
                                                    foreach($query as $q){
                                                        $sum[]=$q['jumlah'];
                                                    }
                                                    $total=array_sum($sum);
                                                    foreach($query as $data){
                                                        if($data['status']=='pratindakan'){
                                                            $bgcolor='bg-primary';
                                                            $name='Pra Tindakan';
                                                        }else if($data['status']=='tindakan'){
                                                            $bgcolor='bg-danger';
                                                            $name='Sedang Tindakan';
                                                        }else if($data['status']=='pemeriksaan'){
                                                            $bgcolor='bg-info';
                                                            $name='Pemeriksaan';
                                                        }else if($data['status']=='slse_tindakan'){
                                                            $bgcolor='bg-warning';
                                                            $name='Setelah Tindakan';
                                                        }else if($data['status']=='done'){
                                                            $bgcolor='bg-success';
                                                            $name='Transaksi Selesai';
                                                        };             
                                                    $persen=$data['jumlah']/$total*100;                      
                                                ?>
                                            <div class="progress-group">
                                                <?= $name?>
                                                <span
                                                    class="float-right"><b><?= $data['jumlah']?></b>/<?= $total?></span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar <?= $bgcolor?>"
                                                        style="width: <?= $persen?>%"></div>
                                                </div>
                                            </div>
                                            <?php 
                                                    }
                                            }else{
                                            ?>
                                            <div class="col-md-12">
                                                <div class="progress-group">
                                                    Belum ada Tindakan
                                                    <span class="float-right"><b>0</b>/0</span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-secondary" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <!-- <div class="progress-group">
                                                Sedang Tindakan
                                                <span class="float-right"><b>310</b>/400</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                <span class="progress-text">Setelah Tindaakan</span>
                                                <span class="float-right"><b>480</b>/800</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                                </div>
                                            </div>

                                            <div class="progress-group">
                                                Transaksi Selesai
                                                <span class="float-right"><b>300</b>/500</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                </div>
                                            </div> -->
                                            <!-- /.progress-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- ./card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <?php if($role=='admin'){ ?>
                                        <div class="col-sm-4 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">
                                                    <?php   $qtotalan=mysqli_query($conn, "SELECT sum(hrgin) as hrgmasuk, sum(hrgout) as hrgkeluar from saldo_klrmsk");
                                                            $totalan=mysqli_fetch_array($qtotalan);
                                                            $hrgmasuk = $totalan['hrgmasuk'];
                                                            $hrgkeluar = $totalan['hrgkeluar'];
                                                            $hrgmargin = $hrgmasuk-$hrgkeluar;
                                                            echo "Rp.".number_format($hrgmasuk,0,',','.');
                                                        ?>
                                                </h5>
                                                <span class="description-text">TOTAL MASUK</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 col-6">
                                            <div class="description-block border-right">
                                                <!-- <span class="description-percentage text-warning"><i
                                                        class="fas fa-caret-left"></i> 0%</span> -->
                                                <h5 class="description-header">
                                                    <?php  echo "Rp.".number_format($hrgkeluar,0,',','.'); ?>
                                                </h5>
                                                <span class="description-text">TOTAL KELUAR</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">
                                                    <?php  echo "Rp.".number_format($hrgmargin,0,',','.'); ?>
                                                </h5>
                                                <span class="description-text">TOTAL VALUE</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>

                                        <!-- <div class="col-sm-3 col-6">
                                            <div class="description-block">
                                                <?php   $qtotbrg=mysqli_query($conn, "SELECT * FROM m_barang");
                                                    while($totbrg=mysqli_fetch_array($qtotbrg)){
                                                        $totperbarang[] = $totbrg['harga']*$totbrg['stok'];
                                                    };
                                                    
                                                    $jumlah_total=array_sum($totperbarang);
                                                ?>
                                                <h5 class="description-header">
                                                    <?php  echo "Rp.".number_format($jumlah_total,0,',','.'); ?></h5>
                                                <span class="description-text">TOTAL HARGA BARANG</span>
                                            </div>
                                        </div> -->
                                    </div>
                                    <?php } ?>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php } ?>
                    <!-- /.row -->
                    <div class="card w-100">
                        <div class="row">
                            <div class="col-md-7 col-12">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                            <div class="col-md-5 col-12">
                                <div class="sticky-top mb-3">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h4>Summary jadwal Pasien Keseluruhan:</h4>
                                        </div>
                                        <?php 
                                    $query= mysqli_query($conn, "SELECT status, COUNT(status) as jumlah from jadwal WHERE status!='cancel' GROUP BY status order by status='done',status='proses',status='booked'");

                                    while($data=mysqli_fetch_array($query)){
                                        if($data['status']=='booked'){
                                            $bgcolor='bg-primary';
                                        }else if($data['status']=='done'){
                                            $bgcolor='bg-success';
                                        }else if($data['status']=='proses'){
                                            $bgcolor='bg-warning';
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

                    <!-- /.row -->
                </div>
                <!--/. container-fluid -->
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