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
                    <h3 class="card-title">Tambah paket</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=16" method="post">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idtrx" name="idtrx"
                            value="<?php echo $_GET['idtrx']; ?>">

                        <div class="form-group">
                            <label>Nama Paket</label>
                            <select id="paket" name="paket" class="form-control selectize" required>
                                <option></option>
                                <?php
                                    $query3 = mysqli_query($conn, "SELECT * FROM namapkt WHERE (id!=1 AND id!=46)");
                                    while ($data3  = mysqli_fetch_array($query3)) { ?>
                                <option value="<?php echo $data3['id']; ?>">
                                    <?php echo $data3['namapkt']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Perawat</label>
                            <select id="perawat" name="perawat" class="form-control selectize" required>
                                <option></option>
                                <?php
                                    $query4 = mysqli_query($conn, "SELECT * FROM perawat");
                                    while ($data4  = mysqli_fetch_array($query4)) { ?>
                                <option value="<?php echo $data4['id']; ?>">
                                    <?php echo $data4['namapwt']; ?></option>
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