<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Jabatan</h3>
                </div>
                <!-- /.card-header -->
                <?php
                    $ide = $_GET['ide'];
                    $tampil=mysqli_query($conn, "SELECT * from jabatan WHERE id='$ide'");
                    $data=mysqli_fetch_array($tampil);
                ?>
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=12" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Jabatan</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $data['namajab'];?>">
                            <input type="hidden" class="form-control" id="ide" name="ide" value="<?php echo $ide;?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gaji Pokok</label>
                            <input type="number" class="form-control" id="gapok" name="gapok"
                                value="<?php echo $data['gapok'];?>">
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Lembur Per Jam</label>
                            <input type="number" class="form-control" id="lembur" name="lembur"
                                value="<?php echo $data['lembur'];?>">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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