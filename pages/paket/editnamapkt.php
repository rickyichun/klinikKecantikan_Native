<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
                    $ide = $_GET['ide'];
                    $tampil=mysqli_query($conn, "SELECT * from namapkt WHERE id='$ide'");
                    $data=mysqli_fetch_array($tampil);
                ?>
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Paket</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=13" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Paket</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $data['namapkt']; ?>" required>
                            <input type="hidden" class="form-control" id="ide" name="ide" value="<?php echo $ide; ?>">
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
                            <input type="text" class="form-control" id="satuan" name="satuan"
                                value="<?php echo $data['satuan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="<?php echo $data['harga']; ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Komisi</label>
                            <input type="number" class="form-control" id="komisi" name="komisi"
                                value="<?php echo $data['komisi']; ?>">
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Paket</label>
                            <select id="jenis" name="jenis" class="form-control selectize" required>

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