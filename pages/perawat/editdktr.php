<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
                $ide = $_GET['uid'];
                $tampil=mysqli_query($conn, "SELECT * from dokter WHERE id='$ide'");
                $data=mysqli_fetch_array($tampil);
            ?>
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit data Dokter</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=9" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $data['namadktr'];?>">
                            <input type="hidden" class="form-control" id="ide" name="ide" value="<?php echo $ide;?>">
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
                                value="<?php echo $data['tempatlahir'];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgllahir" name="tgllahir"
                                value="<?php echo $data['tgllahir'];?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" id="alamat" name="alamat"
                                placeholder="Masukkan Alamat ..."><?php echo $data['alamat'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telpon</label>
                            <input type="number" class="form-control" id="notlp" name="notlp"
                                value="<?php echo $data['notlp'];?>">
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