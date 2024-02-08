<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="inputjadwal.php"><button class="btn btn-primary"><i class="fa fa-plus"></i>
                            Tambah
                            Jadwal</button></a>
                    <a href="jadwalcancel.php"><button class="btn btn-danger"><i class="fa fa-stop"></i>
                            Jadwal Cancel</button></a>
                    <div class="col-md-12 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NoBooking</th>
                                <th>Tanggal</th>
                                <th>NamaPasien</th>
                                <th>DP</th>
                                <th>Marketing</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from jadwal WHERE status!='cancel' order by id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                                    $stat=$data['status']; 
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['nobook']; ?></td>
                                <td><?php echo date("d-m-Y",strtotime($data['tgl'])); ?></td>
                                <td><?php 
                                        $idp = $data['idpasien'];
                                        if($idp>0){
                                            $tampil1=mysqli_query($conn, "SELECT * from pasien WHERE id='$idp'");
                                            $data1=mysqli_fetch_array($tampil1); ?>
                                    <i class="fa fa-user"></i> <?php echo $data1['nama']; 
                                        } else {
                                             echo $data['nama'];
                                        } ?>
                                </td>
                                <td><?php echo "Rp.".number_format($data['dp'],0,',','.'); ?>
                                <td><?php   $idmkt = $data['idmkt'];
                                            $tampil2=mysqli_query($conn, "SELECT * from marketing WHERE id='$idmkt'");
                                            $data2=mysqli_fetch_array($tampil2); 
                                            if($idmkt==0){ 
                                                echo 'Tanpa Marketing'; } 
                                                else { echo $data2['nama']; }
                                             ?></td>
                                <td><?php   if($stat=='done'){ ?>
                                    <font style="color: green;">
                                        <?php } elseif ($stat=='cancel') { ?>
                                        <font style="color:red">
                                            <?php } elseif ($stat=='booked') { ?>
                                            <font style="color:blue">
                                                <?php } else { ?>
                                                <font style="color:orange">
                                                    <?php } ?>
                                                    <b><?php echo strtoupper($stat); ?></b>
                                                </font>
                                </td>
                                <td><?php
                                    if($stat=='booked' && ($role=='kasir' || $role=='admin')){
                                        if($idp==0){
                                    ?>
                                    <a href="../pasien/inputpasien.php?jns=mkt&idjdw=<?php echo $data['id']; ?>"><button
                                            class="btn btn-success btn-sm">Konfrimasi</button></a>
                                    <?php } else { ?>
                                    <a
                                        href="../transaksi/inputtrxpasien.php?idpas=<?php echo $idp ;?>&idjdwl=<?php echo $data['id']; ?>"><button
                                            class="btn btn-success btn-sm">Konfrimasi</button></a>
                                    <?php } ?>
                                    <br />
                                    <br />
                                    <a href="../control/update.php?mode=4&idjdw=<?php echo $data['id']; ?>"><button
                                            class="btn btn-warning btn-sm">Cancel</button></a>
                                    <?php } ?>

                                    <a href="buktibook.php?idjdw=<?php echo $data['id']; ?>" target="_blank"><button
                                            class="btn btn-secondary btn-sm">Bukti</button></a>
                                </td>
                            </tr>
                            <?php $no++;
                                    } ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class=" control-sidebar control-sidebar-dark">

        </aside>

        <?php include('../componen/foot.php'); ?>
    </div>
    <?php include('../componen/script.php'); ?>
</body>

</html>