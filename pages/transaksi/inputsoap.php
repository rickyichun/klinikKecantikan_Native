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
                    <?php 
                        $idtrx =$_GET['idtrx'];
                        $tampil=mysqli_query($conn, "SELECT *, pasien.nama as namapas, namapkt.id as idpkt FROM riw_trx, pasien, namapkt WHERE riw_trx.id='$idtrx' AND riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id ");
						$data=mysqli_fetch_array($tampil);
                    ?>
                    <h3 class="card-title">S.O.A.P Pasien <?php echo $data['namapas']; ?></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=15" method="post">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idtrx" name="idtrx" value="<?php echo $idtrx; ?>">
                        <input type="hidden" class="form-control" id="idpwt" name="idpwt"
                            value="<?php echo $data['idpwt']; ?>" readonly="readonly">
                        <div class="form-group">
                            <label>Keluhan (S)</label>
                            <textarea class="form-control" rows="3" id="keluhan" name="keluhan"
                                placeholder=" ................"
                                required><?php if(isset($data['keluhan'])){ echo $data['keluhan'];} ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tensi (O)</label>
                            <textarea class="form-control" rows="3" id="tensi" name="tensi"
                                placeholder=" ................"
                                required><?php if(isset($data['tensi'])){ echo $data['tensi'];} ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Dosis (A)</label>
                            <input class="form-control" value="<?php echo $data['qtypkt']; ?>" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label>Paket (P)</label>
                            <input class="form-control" value="<?php echo $data['namapkt']; ?>" readonly="readonly">
                        </div>
                    </div>

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