<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>
        <?php $idpkt = $_GET['idpkt']; 
              $tampil1 = mysqli_query($conn, "SELECT * from namapkt WHERE id='$idpkt'");
              $data1   = mysqli_fetch_array($tampil1);
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Paket <?php echo $data1['namapkt'] ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <div class="col-md-2">
                        <a href="inputdetpkt.php?idpkt=<?php echo $idpkt; ?>"><button
                                class="btn btn-primary btn-block"><i class="fa fa-arrow-up"></i>
                                Tambah Detail Paket</button></a>
                    </div> -->
                    <div class="col-md-10 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from detailpkt, m_barang WHERE detailpkt.idpkt='$idpkt' AND detailpkt.idbrg=m_barang.id");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){ 
                            ?>
                            <tr>
                                <!-- <td><?php echo $no;?></td> -->
                                <td><?php echo $data['namabrg']; ?></td>
                                <td><?php echo $data['qty']; ?></td>
                                <td><?php echo $data['satuan']; ?></td>
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