<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat barang masuk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Nota/SJ</th>
                                <th>Tgl Trx</th>
                                <th>Nama barang</th>
                                <th>Qty</th>
                                <th>Harga Beli</th>
                                <th>Harga Avg</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from riw_brgmasuk,m_barang WHERE riw_brgmasuk.idbarang=m_barang.id order by riw_brgmasuk.id desc");$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['noform']; ?></td>
                                <td><?php date("d-m-Y",strtotime($data['tgltrx'])); ?></td>
                                <td><?php echo $data['namabrg']; ?></td>
                                <td><?php echo $data['qtyin']; ?></td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td><?php echo "Rp.".number_format($data['harga'],0,',','.'); ?></td>
                                <td><?php echo $data['margin']; ?></td>
                                <td><?php echo "Rp.".number_format($hargajual,0,',','.'); ?></td>
                                <td><?php echo $data['ket']; ?></td>
                                <td></td>
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