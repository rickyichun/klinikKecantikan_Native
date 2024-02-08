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
                    <h3 class="card-title">S.O.A.P Pasien <?php echo $data['namapas']; ?> nomor transaksi
                        <?php echo $data['notrx']; ?></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="" method="post">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idtrx" name="idtrx" value="<?php echo $idtrx; ?>">
                        <input type="hidden" class="form-control" id="idpwt" name="idpwt"
                            value="<?php echo $data['idpwt']; ?>" readonly="readonly">
                        <div class="form-group">
                            <label>Keluhan (S)</label>
                            <textarea class="form-control" rows="3" id="keluhan" name="keluhan"
                                readonly="readonly"><?php if(isset($data['keluhan'])){ echo $data['keluhan'];} ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tensi (O)</label>
                            <textarea class="form-control" rows="3" id="tensi" name="tensi"
                                readonly="readonly"><?php if(isset($data['tensi'])){ echo $data['tensi'];} ?></textarea>
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
                </form>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="description">Foto <font size="+1"><b>BEFORE</b></font> </span>
                            <?php if($data['foto_bfr']!=NULL){?>
                            <img class="img-fluid" src="../attach/transaksi/<?php echo $data['foto_bfr']; ?>"
                                alt="Photo">
                            <?php } else if ($data['foto2_bfr']!=NULL) { ?>
                            <img class="img-fluid" src="<?php echo $data['foto2_bfr']; ?>" alt="Photo">
                            <?php } else { ?>
                            Belum Terupload
                            <?php } ?>
                        </div>
                        <div class="col-lg-6">
                            <span class="description">Foto <font size="+1"><b>AFTER</b></font> </span>
                            <?php if($data['foto_afr']!=NULL){?>
                            <img class="img-fluid" src="../attach/transaksi/<?php echo $data['foto_afr']; ?>"
                                alt="Photo">
                            <?php } else if ($data['foto2_afr']!=NULL) { ?>
                            <img class="img-fluid" src="<?php echo $data['foto2_afr']; ?>" alt="Photo">
                            <?php } else { ?>
                            Belum Terupload
                            <?php } ?>
                        </div>
                    </div>
                </div>
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