<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Gaji Perawat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="inputgajipwt.php"><button class="btn btn-warning"><i class="fa fa-dollar-sign"></i>
                            Pembayaran
                            Gaji</button></a>
                    <div class="col-md-12" style="margin-top:2em"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Gapok</th>
                                <th>Fee</th>
                                <th>Lembur</th>
                                <th>Insentif</th>
                                <th>BPJS</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT *, gaji_perawat.id as idgj from gaji_perawat, perawat WHERE gaji_perawat.idpwt=perawat.id order by gaji_perawat.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['namapwt']; ?></td>
                                <td><?php echo substr($data['blnthn'],5,2); ?></td>
                                <td><?php echo substr($data['blnthn'],0,4); ?></td>
                                <td><?php echo "Rp.".number_format($data['gp'],0,',','.'); ?></td>
                                <td><?php echo "Rp.".number_format($data['fee'],0,',','.'); ?></td>
                                <td><?php echo "Rp.".number_format($data['lembur'],0,',','.'); ?></td>
                                <td><?php echo "Rp.".number_format($data['insentif'],0,',','.'); ?></td>
                                <td><?php echo "Rp.".number_format($data['bpjs'],0,',','.'); ?></td>
                                <td> <a href="slipgaji.php?idgji=<?php echo $data['idgj']; ?>" target="_blank"><button
                                            class="btn btn-secondary btn-sm btn-block"><i class="fa fa-pencil"></i>
                                            Slip</button></a></td>
                            </tr>
                            <?php $no++;
                                    } ?>
                        </tbody>

                    </table>
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