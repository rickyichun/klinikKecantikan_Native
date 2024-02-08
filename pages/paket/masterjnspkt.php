<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jenis Paket</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-2">
                        <a href="inputjnspkt.php"><button class="btn btn-primary btn-block"><i class="fa fa-plus"></i>
                                Tambah Jenis</button></a>
                    </div>
                    <div class="col-md-10 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jenis</th>
                                <th>Komisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from jenispkt order by id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){ 
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['namajenis']; ?></td>
                                <td><?php echo "Rp.".number_format($data['komisi'],0,',','.'); ?></td>
                                <td><?php if($role=='admin' || $role=='dokter'){ ?>
                                    <a href="editjns.php?ide=<?php echo $data['id']; ?>"><button
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