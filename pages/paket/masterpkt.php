<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Paket</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12">
                        <a href="inputpkt.php"><button class="btn btn-primary"><i class="fa fa-user"></i>
                                Tambah Paket</button></a>
                        <?php if($role=='admin' || $role=='dokter'){ ?>
                        <a href="masterjnspkt.php"><button class="btn btn-warning"><i class="fa fa-plus"></i>
                                Master Komisi</button></a>
                        <?php } ?>
                    </div>
                    <div class="col-md-12 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Jenis</th>
                                <th>Ket</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT *, namapkt.id as ide from namapkt, jenispkt where namapkt.idjenis=jenispkt.id order by namapkt.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){ 
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><a
                                        href="detailpkt.php?idpkt=<?php echo $data['ide']; ?>"><?php echo $data['namapkt']; ?></a>
                                </td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td><?php echo "Rp.".number_format($data['harga'],0,',','.'); ?></td>
                                <td><?php echo $data['namajenis']; ?></td>
                                <td><?php echo $data['ket']; ?></td>
                                <td><a href="inputdetpkt.php?idpkt=<?php echo $data['ide']; ?>"><button
                                            class="btn btn-sm btn-primary login-submit-cs"><i
                                                class="fa fa-arrow-up"></i> Tambah Detail</button></a>
                                    <?php if($role=='admin' || $role=='dokter'){ ?>
                                    <a href="editnamapkt.php?ide=<?php echo $data['ide']; ?>"><button
                                            class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                                    <?php } ?>
                                </td>
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