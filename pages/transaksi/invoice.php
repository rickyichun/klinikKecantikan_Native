<?php include('../componen/head.php'); ?>

<body>
    <div class="wrapper container mt-5">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <img src="../../dist/img/klinikdemo.png" class="mr-4 ml-3" alt="Klinik Demo">
                <h4>
                    <b>Klinik Demo <br> CENTER</b>
                    <!-- <small class="float-right">Date: 2/10/2023</small> -->
                </h4>
                <div style="margin-left:300px">
                    <h1 style="font-size:60px;color:cornflowerblue"><b>TAGIHAN</b></h1>
                </div>
            </div>
            <hr>
            <!-- info row -->
            <div class="row invoice-info">
                <?php 
                                    $idtrx    = $_GET['idtrx'];
                                    $query2     = mysqli_query($conn, "SELECT * FROM riw_trx,pasien WHERE riw_trx.idpasien=pasien.id and riw_trx.id='$idtrx'");
                                    $datah      = mysqli_fetch_array($query2);
                                    $idpaket	= $datah['idpkt'];
                                    $notrx 		= $datah['notrx'];
                                    $pasien     = $datah['nama'];
                                    $jk         = $datah['jeniskelamin'];
                                    $idjdwl     = $datah['idjdwl'];
                                    ?>
                <div class="col-sm-6 invoice-col">
                    <h4><b>PEMBAYARAN KEPADA</b><br>
                        <b style="font-size:20px">
                            <?php if($jk == "Perempuan"){
                        echo "Kk.". $pasien; 
                    }else{
                        echo $pasien; 
                    }
                     ?></b>
                    </h4>
                </div>
                <div class="col-sm-4 invoice-col">
                    <h4><b>TAGIHAN</b></h4>
                    <h4><b>TANGGAL PEMBUATAN</b></h4>
                </div>
                <div class="col-sm-2 invoice-col">
                    <h5><?= $notrx ?></h5>
                    <h5><?= date("d")."/".date("m")."/".date("Y") ?></h5>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table style="width:100%">
                        <thead>
                            <?php 
                                            
                                            $qpaket     = mysqli_query($conn, "SELECT * FROM namapkt WHERE id='$idpaket'");
                                            $paket      = mysqli_fetch_array($qpaket);
                                            $hargapkt	= $paket['harga'];
                                            $totalharga = $hargapkt * $datah['qtypkt'];
                                        ?>
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Qty #</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td>1</td>
                                <td><?php echo $paket['namapkt']; ?></td>
                                <td><?php echo $datah['qtypkt']; ?></td>
                                <td><?php echo "Rp.".number_format($hargapkt,0,',','.'); ?></td>
                                <td><?php echo "Rp.".number_format($totalharga,0,',','.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Note :</p>

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Pembayaran dapat dilakukan melalui tranfer maupun Cash
                        <?php 
                            if($idjdwl!=0){
                                $qjdwal     = mysqli_query($conn, "SELECT * FROM jadwal WHERE id='$idjdwl'");
                                $jdwal      = mysqli_fetch_array($qjdwal);
                        ?><br />
                        <b>Cust. telah membayar DP Sebesar Rp.
                            <?php echo number_format($jdwal['dp'],0,',','.'); ?>,-</b>
                        <?php } ?>

                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Amount Due <?php echo date("d-m-Y",strtotime($datah['tgl'])); ?></p>

                    <div class="table-responsive">
                        <table style="width:100%">
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th style="width:50%">Subtotal:</th>
                                <td><b><?php echo "Rp.".number_format($totalharga,0,',','.'); ?></b></td>
                            </tr>
                            <!-- <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr> -->
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th>Total:</th>
                                <td><b><?php echo "Rp.".number_format($totalharga,0,',','.'); ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default">
                                    <i class="fas fa-print"></i> Print</a> -->

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
    window.addEventListener("load", window.print());
    </script>
</body>

</html>