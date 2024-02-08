<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
                $ide = $_GET['ide'];
                $tampil=mysqli_query($conn, "SELECT * from m_barang WHERE id='$ide'");
                $data=mysqli_fetch_array($tampil);
            ?>
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data barang</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=11" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $data['namabrg'];?>">
                            <input type="hidden" class="form-control" id="ide" name="ide" value="<?php echo $ide;?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok Berjalan</label>
                            <input type="text" class="form-control" id="stok" name="stok"
                                value="<?php echo $data['stok'];?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan"
                                value="<?php echo $data['satuan'];?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Minimal Stok</label>
                            <input type="number" class="form-control" id="minstok" name="minstok"
                                value="<?php echo $data['minstok'];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <input type="text" class="form-control" id="ket" name="ket"
                                value="<?php echo $data['ket'];?>">
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