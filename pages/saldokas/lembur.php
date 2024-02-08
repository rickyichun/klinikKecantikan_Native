<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Lembur Karyawan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Nominal</th>
                                <th>Disetujui Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from lembur, tb_user WHERE lembur.userid=tb_user.user_id order by lembur.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                                    $idadm = $data['updateby'];                                        
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo date("d-F-Y",strtotime($data['tgl'])); ?></td>
                                <td><?php echo floor(($data['durasi']/60))." Menit"?></td>
                                <td><?php echo "Rp.".number_format($data['nominal'],0,',','.'); 
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        $qadm = mysqli_query($conn, "SELECT * from tb_user WHERE user_id='$idadm'");
                                        $admin = mysqli_fetch_array($qadm); 
                                        echo $admin['username'];
                                    ?>
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