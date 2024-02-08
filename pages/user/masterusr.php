<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="tambahusr.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah User</a>
                    <div class="col-md-12 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Role</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from tb_user WHERE user_id!=1 order by user_id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['fullname']; ?></td>
                                <td><?php echo $data['role']; ?></td>
                                <td>
                                    <a href="editusr.php?uid=<?php echo $data['user_id']; ?>"><button
                                            class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                                    <!-- <button class="btn btn-danger"><i class="fas fa-trash"></i></button> -->
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