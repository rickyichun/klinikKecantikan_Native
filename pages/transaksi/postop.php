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
                    <h3 class="card-title">Rawat Jalan</h3>
                </div>
                <!-- /.card-header -->
                <?php
                    $idtrx = $_GET['idtrx'];
                    $qtrans = mysqli_query($conn, "SELECT * FROM riw_trx WHERE id='$idtrx';");
                    $trans  = mysqli_fetch_array($qtrans); 
                    $notrx = $trans['notrx']; 
                    $qcekpop = mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx' AND idpkt=46");
                    $cekpop  = mysqli_num_rows($qcekpop);
                    if($cekpop>=5){
                        $_SESSION['alert'] = "warning";
                        $_SESSION['pesan'] = "Post_OP melewati batas maksimal!";
                    }
                ?>
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=16" method="post">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idtrx" name="idtrx" value="<?php echo $idtrx; ?>">
                        <div class="form-group">
                            <label>Nama Paket</label><?php
                                    $query3 = mysqli_query($conn, "SelECT * FROM namapkt WHERE id=46");
                                    $data3  = mysqli_fetch_array($query3);
                                ?>
                            <input type="hidden" class="form-control" id="paket" name="paket" value="46">
                            <input type="text" class="form-control" readonly="readonly"
                                value="<?php echo $data3['namapkt']; ?>">
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
                    <?php if($cekpop<5){ ?>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <?php } ?>
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