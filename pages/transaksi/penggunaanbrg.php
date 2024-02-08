<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <?php
    $idtrx   = $_GET['idtrx'];
    $tampil2 = mysqli_query($conn, "SELECT * FROM riw_trx, pasien, namapkt, detailpkt WHERE riw_trx.id='$idtrx' AND riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id");
    $data2   = mysqli_fetch_array($tampil2);
    $qtypkt  = $data2['qtypkt'];
    $idbsc   = $data2['idbasic'];
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengguanaan barang pada Transaksi No <?php echo $data2['notrx']; ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12 mb-4"> <a href=""><button class="btn btn-primary"><i class="fa fa-plus"></i>
                                Barang Keluar Lainnya</button></a></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from riw_brgkeluar, m_barang WHERE idtrx='$idtrx' AND riw_brgkeluar.idbarang=m_barang.id order by riw_brgkeluar.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['namabrg']; ?></td>
                                <td><?php echo $data['qtyout']; ?></td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td> <a href=""><button class="btn btn-danger btn-sm">Hapus</button></a></td>
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
        <aside class=" control-sidebar control-sidebar-dark">

        </aside>

        <?php include('../componen/foot.php'); ?>
    </div>
    <?php include('../componen/script.php'); ?>
</body>

</html>