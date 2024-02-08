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
                    <h3 class="card-title">Tambah Dokter Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=13" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control selectize" id="jk" name="jk">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempatlhr" name="tempatlhr"
                                placeholder="Tempat Lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgllahir" name="tgllahir"
                                placeholder="Tanggal Lahir" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" id="alamat" name="alamat"
                                placeholder="Masukkan Alamat ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telpon</label>
                            <input type="number" class="form-control" id="notlp" name="notlp" placeholder="No Telpon">
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