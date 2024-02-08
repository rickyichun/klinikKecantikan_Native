<?php include('../componen/head.php'); ?>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        Demo Klinik
                        <!-- <small class="float-right">Date: 2/10/2023</small> -->
                    </h4>
                    <b>BUKTI BOOKING </b><br>
                    <br>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-6">
                    <?php 
                        $idjdw      = $_GET['idjdw'];
                        $query2     = mysqli_query($conn, "SELECT * FROM jadwal WHERE id='$idjdw'");
                        $datah      = mysqli_fetch_array($query2);
                        $nobook 		= $datah['nobook'];
                        $idpasien 		= $datah['idpasien'];
                        $idmkt 		= $datah['idmkt'];
                        $dp 		= $datah['dp'];
                    ?>
                    <div class="row">
                        <div class="col-sm-5 invoice-col">
                            <b>No Booking:</b> <?php echo $nobook; ?><br>

                            <b>Nama :</b> <?php if($idpasien==0) {
                                echo $datah['nama']; } else {
                                    $qpasien = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpasien'");
                                    $pasien  = mysqli_fetch_array($qpasien);
                                    echo $pasien['nama'];
                                } ?><br>
                            <b>Marketing :</b> <?php if($idmkt==0) {
                                echo '-'; } else {
                                    $qmkt = mysqli_query($conn, "SELECT * FROM marketing WHERE id='$idmkt'");
                                    $mkt  = mysqli_fetch_array($qmkt);
                                    echo $mkt['nama'];
                                } ?><br>

                            <b>DP :</b> <?php if($dp==0) {
                                echo '-'; } else { 
                                    echo "Rp.".number_format($dp,0,',','.');
                                } ?>
                        </div>
                        <div class="col-sm-5">
                            NOTE :
                            <p class="text-muted well well-sm shadow-none">
                                Pastikan melakukan koordinasi dengan admin saat konfirmasi kehadiran pasien
                            </p>
                        </div>
                        <div class="col-sm-2">
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-6">

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