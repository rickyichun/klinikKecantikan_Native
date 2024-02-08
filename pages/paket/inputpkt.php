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
                    <h3 class="card-title">Tambah Paket Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=4" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Paket</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Paket"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Kategori Reguler/Basic</label>
                            <select class="form-control selectize" id="jp" name="jp">
                                <option value="reguler">Reguler</option>
                                <option value="basic">Basic</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Paket</label>
                            <select id="jenis" name="jenis" class="form-control selectize" required>
                                <option></option>
                                <?php
                                        $query4 = mysqli_query($conn, "SELECT * FROM jenispkt");
                                        while ($data4  = mysqli_fetch_array($query4)) { ?>
                                <option value="<?php echo $data4['id']; ?>"><?php echo $data4['namajenis']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Include Basic</label>
                            <select id="basic" name="basic" class="form-control selectize" required>
                                <option value="0">Tanpa Basic</option>
                                <?php
                                        $qbasic = mysqli_query($conn, "SELECT * FROM namapkt WHERE jenispkt='basic'");
                                        while ($basic  = mysqli_fetch_array($qbasic)) { ?>
                                <option value="<?php echo $basic['id']; ?>"><?php echo $basic['namapkt']; ?></option>
                                <?php } ?>
                            </select>
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