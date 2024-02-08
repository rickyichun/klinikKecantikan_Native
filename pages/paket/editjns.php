<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php   $idjns = $_GET['ide']; 
                    $tampil = mysqli_query($conn, "SELECT * from jenispkt WHERE id='$idjns'");
                    $data   = mysqli_fetch_array($tampil);
                
            ?>
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Jenis Paket</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=16" method="post">
                    <input type="hidden" class="form-control" id="idjns" name="idjns" value="<?= $data['id']; ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Jenis Paket</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?= $data['namajenis']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Komisi</label>
                            <input type="number" class="form-control" id="komisi" name="komisi"
                                value="<?= $data['komisi']; ?>" required>
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