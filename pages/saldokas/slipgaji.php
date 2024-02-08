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
                    <h1 style="font-size:33px;color:cornflowerblue"><b>SLIP GAJI</b></h1>
                </div>
            </div>
            <hr>
            <!-- info row -->
            <div class="row invoice-info">
                <?php 
                    $idgj    = $_GET['idgji'];
                    $query2     = mysqli_query($conn, "SELECT * FROM gaji_perawat, perawat WHERE gaji_perawat.id='$idgj' and gaji_perawat.idpwt=perawat.id");
                    $datah      = mysqli_fetch_array($query2);
                    $nogaji 	= $datah['nogaji'];
                    $gapok 		= $datah['gp'];
                    $namapwt     = $datah['namapwt'];
                    $fee         = $datah['fee'];
                    $lembur         = $datah['lembur'];
                    $insentif         = $datah['insentif'];
                    $bpjs         = $datah['bpjs'];
                    $bulan         = substr($datah['blnthn'],5,2);
                    $tahun         = substr($datah['blnthn'],0,4);
                    $totalgj = $gapok+$fee+$lembur+$insentif-$bpjs;
                    ?>
                <div class="col-sm-6 invoice-col">
                    <h4><b>PEMBAYARAN GAJI KEPADA</b><br>
                        <b style="font-size:20px">
                            <?php    echo $namapwt;  ?></b>
                    </h4>
                </div>
                <div class="col-sm-4 invoice-col">
                    <h4><b>NO GAJI</b></h4>
                    <h4><b>Periode Bulan</b></h4>
                </div>
                <div class="col-sm-2 invoice-col">
                    <h6><?= $nogaji ?></h6>
                    <h5><?php    echo $bulan.' - '.$tahun; ?></h5>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table style="width:100%">
                        <thead>
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th>No</th>
                                <th>Deskripsi</th>
                                <th></th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td>1</td>
                                <td>Gaji Pokok</td>
                                <td></td>
                                <td><?php echo "Rp.".number_format($gapok,0,',','.'); ?></td>
                            </tr>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td>2</td>
                                <td>Fee</td>
                                <td></td>
                                <td><?php echo "Rp.".number_format($fee,0,',','.'); ?></td>
                            </tr>
                            <?php if($fee!=0){
                                    $query4     = mysqli_query($conn, "SELECT * FROM det_komisi, jenispkt WHERE det_komisi.nogaji='$nogaji' AND det_komisi.idjnspkt=jenispkt.id");
                                    while($data4 = mysqli_fetch_array($query4)){
                            ?>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td></td>
                                <td><?php echo "* ".$data4['notrx']." - ".$data4['namajenis']." ".$data4['qty']." x ".$data4['komisi']; 
                                          $detfee = $data4['qty']*$data4['komisi']; ?>
                                </td>
                                <td><?php echo "Rp.".number_format($detfee,0,',','.'); ?></td>
                                <td></td>
                            </tr>
                            <?php }
                            } ?>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td>3</td>
                                <td>Lembur</td>
                                <td></td>
                                <td><?php echo "Rp.".number_format($lembur,0,',','.'); ?></td>
                            </tr>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td>4</td>
                                <td>Insentif</td>
                                <td></td>
                                <td><?php echo "Rp.".number_format($insentif,0,',','.'); ?></td>
                            </tr>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td>5</td>
                                <td>Potongan BPJS</td>
                                <td></td>
                                <td><?php echo "- Rp.".number_format($bpjs,0,',','.'); ?></td>
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


                </div>
                <!-- /.col -->
                <div class="col-6">

                    <div class="table-responsive">
                        <table style="width:100%">
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th style="width:55%">Subtotal:</th>
                                <td><b><?php echo "Rp.".number_format($totalgj,0,',','.'); ?></b></td>
                            </tr>
                            <!-- <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr> -->
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th>Total:</th>
                                <td><b><?php echo "Rp.".number_format($totalgj,0,',','.'); ?></b></td>
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