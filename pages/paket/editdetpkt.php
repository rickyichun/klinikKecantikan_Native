<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php   $idpkt = $_GET['idp']; 
                    $iddetpkt = $_GET['ide']; 
                    $tampil = mysqli_query($conn, "SELECT * from detailpkt WHERE id='$iddetpkt'");
                    $data   = mysqli_fetch_array($tampil);
                
            ?>

            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Detail Paket</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/update.php?mode=14" method="post">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idpkt" name="idpkt" value="<?php echo $idpkt; ?>">
                        <input type="hidden" class="form-control" id="iddetpkt" name="iddetpkt"
                            value="<?php echo $iddetpkt; ?>">
                        <div class="form-group">
                            <label>Pilih Barang</label>
                            <select id="barang" name="barang" class="form-control selectize" required>
                                <?php 
                                    
                                    $qbarang = mysqli_query($conn, "SelECT * FROM m_barang WHERE id='$data[idbrg]'");
                                    $barang  = mysqli_fetch_array($qbarang); ?>
                                <option value="<?php echo $barang['id']; ?>"><?php echo $barang['namabrg']; ?> - (Data
                                    Sebelumnya)</option>
                                <?php
                                    $query1 = mysqli_query($conn, "SelECT * FROM m_barang");
                                    while ($data1  = mysqli_fetch_array($query1)) { ?>
                                <option value="<?php echo $data1['id']; ?>">
                                    <?php echo $data1['namabrg']; ?> - <?php echo $data1['satuan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty"
                                value="<?php echo $data['qty']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" id="keterangan"
                                name="keterangan"><?php echo $data['ket']; ?></textarea>
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