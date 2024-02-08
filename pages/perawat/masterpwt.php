<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Perawat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-2">
                        <?php if($role=='admin' || $role=='dokter'){ ?>
                        <a href="inputpwt.php"><button class="btn btn-primary btn-block"><i class="fa fa-user"></i>
                                Tambah Perawat</button></a>
                        <?php } ?>
                    </div>
                    <div class="col-md-10 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>JenisKelamin</th>
                                <th>TempatLahir</th>
                                <th>TglLahir</th>
                                <th>Alamat</th>
                                <th>NoTelp</th>
                                <th>Poin</th>
                                <th>TglUpdate</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from perawat order by id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['namapwt']; ?></td>
                                <td><?php echo $data['jeniskelamin']; ?></td>
                                <td><?php echo $data['tempatlahir']; ?></td>
                                <td><?php echo date("d-m-Y",strtotime($data['tgllahir'])); ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td><?php echo $data['notlp']; ?></td>
                                <td><?php $ide = $data['id'];
                                          $bulanini = date('m');
                                          $tampil2=mysqli_query($conn, "SELECT * from riw_trx WHERE idpwt='$ide' AND month(tgl)='$bulanini' ");
                                          $poin  = mysqli_num_rows($tampil2);
                                          echo $poin; ?></td>

                                <td><?php echo date("d-m-Y H:i:s",strtotime($data['tglupdate'])); ?></td>
                                <td><a href="editpwt.php?uid=<?php echo $ide; ?>"><button class="btn btn-warning"><i
                                                class="fas fa-edit"></i></button></a></td>
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