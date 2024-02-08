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
                    $idtrx      = $_GET['idtrx'];
                    $query2     = mysqli_query($conn, "SELECT * FROM riw_trx,pasien WHERE riw_trx.idpasien=pasien.id and riw_trx.notrx='$idtrx'");
                    while($datah= mysqli_fetch_array($query2)){
                        $idpaket[]= $datah['idpkt'];
                        $notrx[]= $datah['notrx'];
                        $pasien[]= $datah['nama'];
                        $jk[]= $datah['jeniskelamin'];
                        $qty[]=$datah['qtypkt'];
                        $tgl[]=$datah['tgl'];
                        $idjdwl[]=$datah['idjdwl'];
                    }
                ?>
                <div class="col-sm-6 invoice-col">
                    <h4><b>PEMBAYARAN KEPADA</b><br>
                        <b style="font-size:20px">
                            <?php if($jk[0] == "Perempuan"){
                        echo "Kk.". $pasien[0]; 
                    }else{
                        echo $pasien[0]; 
                    }
                     ?></b>
                    </h4>
                </div>
                <div class="col-sm-4 invoice-col">
                    <h4><b>TAGIHAN</b></h4>
                    <h4><b>TANGGAL PEMBUATAN</b></h4>
                </div>
                <div class="col-sm-2 invoice-col">
                    <h5><?= $notrx[0] ?></h5>
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
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Qty #</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                for($i = 0;$i < count($idpaket);$i++) {
                                    $no         = $i+1;
                                    $idpket     = $idpaket[$i];
                                    $qtyy       = $qty[$i];
                                    $qpaket     = mysqli_query($conn, "SELECT * FROM namapkt WHERE id='$idpket'");
                                    $paket      = mysqli_fetch_array($qpaket);
                                    $hargapkt	= $paket['harga'];
                                    $totalharga = $hargapkt * $qtyy;
                                    $totalarry[] = $totalharga;
                            ?>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $paket['namapkt']; ?></td>
                                <td><?php echo $qtyy; ?></td>
                                <td><?php echo "Rp.".number_format($hargapkt,0,',','.'); ?></td>
                                <td><?php echo "Rp.".number_format($totalharga,0,',','.'); ?></td>
                            </tr>
                            <?php } 
                            $cekjdwal=array_sum($idjdwl);
                            if($cekjdwal!=0){
                                for($s=0;$s<count($idjdwl);$s++) {
                                    $idjdwlarr = $idjdwl[$s];
                                    $qjdwal     = mysqli_query($conn, "SELECT * FROM jadwal WHERE id='$idjdwlarr'");
                                    $jdwal      = mysqli_fetch_array($qjdwal);
                                    $totaldp[]  = $jdwal['dp'];
                                }
                                $totalandp=array_sum($totaldp);
                            ?>
                            <tr style="height:45px;margin-bottom:20px;background-color:ghostwhite">
                                <td></td>
                                <td>DP</td>
                                <td></td>
                                <td></td>
                                <td style="color: red;"><?php echo "- Rp.".number_format($totalandp,0,',','.'); ?></td>
                            </tr>
                            <?php 
                                $subtot = $totalharga - $totalandp;    
                            }
                            ?>
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
                        Cara Bayar melalui <br />
                        BCA DEWI SULESTARI <br />
                        0877-000-048

                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <!-- <p class="lead">Amount Due <?php echo date("d-m-Y",strtotime($tgl[0])); ?></p> -->
                    <br />
                    <?php 
                        $jumlah_total=array_sum($totalarry);
                    ?>
                    <div class="table-responsive">
                        <table style="width:100%">
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th style="width:50%">Total Bayar:</th>
                                <td>
                                    <b><?php
                                        if($cekjdwal!=0){
                                            echo "Rp.".number_format($subtot,0,',','.');
                                        } else {
                                            echo "Rp.".number_format($jumlah_total,0,',','.');    
                                        } ?>
                                    </b>
                                </td>
                            </tr>
                            <!-- <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr> -->
                            <tr style="background-color:cornflowerblue; height:45px; color:white;">
                                <th>Total Harga:</th>
                                <td><b><?php echo "Rp.".number_format($jumlah_total,0,',','.'); ?></b></td>
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