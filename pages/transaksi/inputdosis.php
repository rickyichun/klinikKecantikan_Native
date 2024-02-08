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
                    <h3 class="card-title">Transaksi</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=3" method="post">
                    <div class="card-body">
                        <?php 
                        $idtrx =$_GET['idtrx'];
                        $tampil=mysqli_query($conn, "SELECT *, pasien.nama as namapas, namapkt.id as idpkt FROM riw_trx, pasien, namapkt WHERE riw_trx.id='$idtrx' AND riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id ");
						$data=mysqli_fetch_array($tampil);
                        if($data['keluhan']==NULL) {
							$_SESSION['alert'] = "dosis";
                            $_SESSION['pesan'] = "Keluhan & Tensi (SOAP) belum terisi!";
                        }
                        ?>
                        <input type="hidden" class="form-control" id="idtrx" name="idtrx" value="<?php echo $idtrx; ?>">
                        <div class="form-group">
                            <label>No Transaksi</label>
                            <input type="name" class="form-control" value="<?php echo $data['notrx']; ?>"
                                readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="name" class="form-control" value="<?php echo $data['namapas']; ?>"
                                readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label>Nama Paket</label>
                            <input type="name" class="form-control" value="<?php echo $data['namapkt'] ;?>"
                                readonly="readonly">
                            <input type="text" name="idpkt" class="form-control" value="<?php echo $data['idpkt'] ;?>"
                                readonly="readonly" hidden>
                        </div>
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty Dosis Paket"
                                required>
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