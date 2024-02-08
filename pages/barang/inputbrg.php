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
                    <h3 class="card-title">Tambah Barang Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=6" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stok awal</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Awal">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Minimal Stok</label>
                            <input type="number" class="form-control" id="minstok" name="minstok"
                                placeholder="Minimal Stok">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan">
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