<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
$idtrx =$_GET['idtrx'];
$tampil2=mysqli_query($conn, "SELECT * FROM riw_trx, pasien, namapkt, detailpkt WHERE riw_trx.id='$idtrx' AND riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id");
$data2=mysqli_fetch_array($tampil2);
$qtypkt = $data2['qtypkt'];
$idbsc = $data2['idbasic'];
?>
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pemakaian Barang Paket <?php echo $data2['namapkt']; ?> Dengan Dosis
                        <?php echo $qtypkt;?> Oleh pasien
                        <?php echo $data2['nama']; ?> </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=24" method="post">
                    <input type="hidden" class="form-control" id="idtrx" name="idtrx" value="<?php echo $idtrx; ?>">
                    <input type="hidden" class="form-control" id="idpwt" name="idpwt"
                        value="<?php echo $data2['idpwt']; ?>">
                    <input type="hidden" class="form-control" id="idbsc" name="idbsc" value="<?php echo $idbsc; ?>">

                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                *) Jumlah Barang sudah sesuai dengan qty paket yg diambil
                            </div>
                        </div>
                        <?php 
                        $no=1;
                        $tampil=mysqli_query($conn, "SELECT * FROM riw_trx, detailpkt, m_barang WHERE riw_trx.id='$idtrx' AND riw_trx.idpkt=detailpkt.idpkt AND detailpkt.idbrg=m_barang.id");
						while($data=mysqli_fetch_array($tampil)){ 
                        $qty = $qtypkt*$data['qty'];
                        ?>
                        <div class="row">
                            <div class="col-lg-1">
                                <div class="form-group">
                                    Barang <?php echo $no." :"; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data['namabrg']; ?>"
                                        readonly="readonly">
                                </div>
                                <input type="hidden" class="form-control" id="idbrg" name="idbrg[]"
                                    value="<?php echo $data['idbrg']; ?>">

                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    Quantity :
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $qty; ?>" name="qty[]"
                                        id="qty">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <b><?php echo $data['satuan'];?></b>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        value="<?php echo "Stok = ".$data['stok']." ".$data['satuan']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <?php $no++;
                        }
                        ?>
                        <div class="row">
                            <h3 class="card-title col-lg-12"><b>Barang Basic :</b></h3>
                            <br />
                            <br />
                        </div>
                        <?php     
                            if($idbsc!=0){
                                $tampil1=mysqli_query($conn, "SELECT *, m_barang.satuan as satuan FROM detailpkt, m_barang, namapkt WHERE detailpkt.idpkt='$idbsc' AND detailpkt.idbrg=m_barang.id AND namapkt.id=detailpkt.idpkt");
                                while($data1=mysqli_fetch_array($tampil1)){?>
                        <div class="row">
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <?php echo $data1['namapkt']; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data1['namabrg']; ?>"
                                        readonly="readonly">
                                </div>
                                <input type="hidden" class="form-control" id="idbrg" name="idbrg[]"
                                    value="<?php echo $data1['idbrg']; ?>">

                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    Quantity :
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data1['qty']; ; ?>"
                                        name="qty[]" id="qty">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <b><?php echo $data1['satuan'];?></b>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        value="<?php echo "Stok = ".$data1['stok']." ".$data1['satuan']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <?php }
                        } ?>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Konfirm</button>
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