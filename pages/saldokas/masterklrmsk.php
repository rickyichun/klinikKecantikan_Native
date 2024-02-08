<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat kas keluar-masuk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php  if($role=='admin' || $role=='dokter'){ ?>
                    <a href="pemasukanlain.php"><button class="btn btn-success"><i class="fa fa-plus"></i>
                            Pemasukan Lain2</button></a>

                    <a href="pengeluaranlain.php"><button class="btn btn-secondary"><i class="fa fa-shopping-cart"></i>
                            Pengeluaran Lain2</button></a>

                    <a href="riw_gaji.php"><button class="btn btn-warning"><i class="fa fa-dollar-sign"></i>
                            Pembayaran Gaji</button></a>

                    <a href="../report/report_keluar_masuk.php"><button class="btn btn-info"><i class="fa fa-book"></i>
                            Report Saldo</button></a>
                    <?php } ?>
                    <div class="col-md-12 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Masuk</th>
                                <th>Keluar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from saldo_klrmsk order by tgltrx desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                                    $hargain[] =$data['hrgin'];
                                    $hargaout[] =$data['hrgout'];
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo date("d-m-Y",strtotime($data['tgltrx'])); ?></td>
                                <td><?php echo $data['deskripsi']; ?></td>
                                <td><?php echo "Rp.".number_format($data['hrgin'],0,',','.'); ?>
                                <td><?php echo "Rp.".number_format($data['hrgout'],0,',','.'); ?>

                            </tr>
                            <?php $no++;
                                    } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-2">
                            <b>Total Masuk</b>
                        </div>
                        <div class="col-lg-10">
                            <?php
                            $jumlah_in=array_sum($hargain);
                            $jumlah_out=array_sum($hargaout);
                            echo ": Rp.".number_format($jumlah_in,0,',','.'); ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-2">
                            <b>Total Keluar</b>
                        </div>
                        <div class="col-lg-10">
                            <?php echo ": Rp.".number_format($jumlah_out,0,',','.'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <b>Value</b>
                        </div>
                        <?php $profit=$jumlah_in-$jumlah_out; 
                              if($profit<0){ ?>
                        <div class="col-lg-10" style="color:red">
                            <?php } else { ?>
                            <div class="col-lg-10" style="color:green">
                                <?php }
                             echo ": Rp.".number_format($profit,0,',','.'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
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