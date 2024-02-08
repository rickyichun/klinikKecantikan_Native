<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12">
                        <a href="inputtrx.php"><button class="btn btn-primary"><i class="fa fa-plus"></i>
                                Trx Pasien Lama</button></a>
                        <a href="../pasien/inputpasien.php?jns=lgsng"><button class="btn btn-warning"><i
                                    class="fa fa-plus"></i>
                                Trx Pasien Baru</button></a>
                        <a href="../jadwal/masterjadwal.php"><button class="btn btn-primary"><i
                                    class="fa fa-user-tie"></i>
                                Booked by Maketing</button></a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="col-md-12 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>NoTransaksi</th>
                                <th>Nama</th>
                                <th>Paket</th>
                                <th>Qty Pkt</th>
                                <th>Dokter/Perawat</th>
                                <th>Status</th>
                                <th>TglUpdate</th>
                                <th>Tindakan</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
                                    if($_SESSION['role']=='perawat') {
                                        $idp = $_SESSION['idpwt'];
                                        $tampil=mysqli_query($conn, "SELECT *, riw_trx.id as idt, riw_trx.tglupdate as tglnew, riw_trx.status as statusps FROM riw_trx, pasien, namapkt, perawat, tb_user WHERE riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id AND riw_trx.idpwt=perawat.id AND riw_trx.iduser=tb_user.user_id AND riw_trx.idpwt='$idp'  order by riw_trx.id desc");    
                                    } else {
									    $tampil=mysqli_query($conn, "SELECT *, riw_trx.id as idt, riw_trx.tglupdate as tglnew, riw_trx.status as statusps FROM riw_trx, pasien, namapkt, perawat, tb_user WHERE riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id AND riw_trx.idpwt=perawat.id AND riw_trx.iduser=tb_user.user_id  order by riw_trx.notrx desc");
                                    }
                                    $no=1;
									while($data=mysqli_fetch_array($tampil)){
                                        if($data['statusps']=="tindakan"){ ?>
                            <tr style="background-color:purple;color:white;border-color:black;font-size:larger">
                                <?php } else if($data['statusps']=="pemeriksaan"){ ?>
                            <tr style="background-color:darksalmon;color:white;border-color:black;">
                                <?php } else if($data['statusps']=="done"){ ?>
                            <tr style="background-color:greenyellow;border-color:black;">
                                <?php } else if($data['statusps']=="done_brg"){ ?>
                            <tr style="background-color:lightgreen;border-color:black;">
                                <?php } else { ?>
                            <tr>
                                <?php } ?>
                                <td><?php echo $no;?></td>
                                <td><?php echo date("d-m-Y",strtotime($data['tgl'])); ?></td>
                                <td>
                                    <!-- <a target="_blank" href="invoicedone.php?idtrx=<?php echo $data['notrx']; ?>"> -->
                                    <?php echo $data['notrx']; ?>
                                    <!-- </a> -->
                                </td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['namapkt']; ?></td>
                                <td><?php echo $data['qtypkt']." ".$data['satuan']; ?></td>
                                <td><?php echo $data['namapwt']; ?></td>
                                <td><?php $stat = $data['statusps'];
                                          echo $stat; ?></td>
                                <td><?php echo date("d-m-Y H:i:s",strtotime($data['tglnew'])); ?></td>
                                <td><?php  
                                    //status pemeriksaan
                                    if($stat=='pemeriksaan'){ 
                                        if($role!='marketing' && $role!='kasir' ){?>
                                    <a href="inputdosis.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-warning btn-sm btn-block"><i class="fa fa-syringe"></i>
                                            Dosis</button></a>
                                    <br />
                                    <a href="inputsoap.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-primary btn-sm btn-block"><i class="fa fa-medkit"></i>
                                            S.O.A.P</button></a>

                                    <br />
                                    <a href="tambahpaket.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></a>
                                    <a href="gantipaket.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-success btn-sm">Ganti Pkt</button></a>

                                    <?php } 

                                    //status pratindakan
                                    } else if($stat=='pratindakan' && ($role=='perawat' || $role=='admin')){ ?>
                                    <!-- <a href="uploadfile.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-secondary btn-sm">Upload File</button></a>
                                    <br />
                                    <br /> -->
                                    <a href="ttdonline.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-warning btn-sm"><i class="fa fa-pen"></i>
                                            Input ttd</button></a>
                                    <br />
                                    <br />
                                    <?php if ($data['filepernyataan']!=Null || $data['filepersetujuan']!=Null){ ?>
                                    <a href="../control/update.php?mode=19&idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i>
                                            Tindakan</button></a>
                                    <?php } ?>
                                    <?php  
                                    //status tindakan
                                    } else if ($stat=='tindakan' && ($role=='perawat' || $role=='admin' || $role=='dokter' )){ 
                                    ?>
                                    <a href="../control/insert.php?mode=8&idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-success btn-block">
                                            Selesaikan Tindakan</button></a>
                                    <br />
                                    <a href="tambahpaket.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Paket</button></a>

                                    <?php  //status slesai tindakan
                                    } else if ($stat=='slse_tindakan' && ($role=='kasir' || $role=='admin' || $role=='dokter' ) ){ ?>
                                    <a href="invoicedone.php?idtrx=<?php echo $data['notrx']; ?>"
                                        target="_blank"><button class="btn btn-primary btn-sm btn-block">
                                            Invoice</button></a>
                                    <br />
                                    <a href="../control/insert.php?mode=14&idtrx=<?php echo $data['idt']; ?>"
                                        target="_blank"><button class="btn btn-success btn-sm btn-block"><i
                                                class="fa fa-dollar-sign"></i> <b> Selesai </b></button></a>
                                    <?php } else if ($stat=='done' && $data['idbasic']==46 &&  ($role=='perawat' || $role=='admin' || $role=='dokter' ) ){ ?>
                                    <a href="postop.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-primary btn-sm btn-block">
                                            Post_OP</button></a>
                                    <?php } ?>
                                </td>
                                <td><?php
                                    //status pratindakan
                                    if($stat=='pratindakan' && ($role=='perawat' || $role=='admin')){
                                    ?>
                                    <a href="../attach/SP/pernyataan.php?idtrx=<?php echo $data['idt']; ?>"
                                        target="_blank"><button class="btn btn-warning btn-sm btn-block">
                                            <?php if ($data['filepernyataan']!=Null){ ?> <i class="fa fa-check"></i>
                                            <?php } ?> Pernyataan</button></a>
                                    <br />
                                    <a href="../attach/SP/persetujuan.php?idtrx=<?php echo $data['idt']; ?>"
                                        target="_blank"><button class="btn btn-primary btn-sm btn-block">
                                            <?php if ($data['filepersetujuan']!=Null){ ?> <i class="fa fa-check"></i>
                                            <?php } ?> Persetujuan</button></a>
                                    <br />
                                    <a href="../attach/SP/pernyataan2.php?idtrx=<?php echo $data['idt']; ?>"
                                        target="_blank"><button class="btn btn-warning btn-sm btn-block">
                                            <?php if ($data['filepernyataan']!=Null){ ?> <i class="fa fa-check"></i>
                                            <?php } ?> Pernyataan 2</button></a>

                                    <br />
                                    <a href="../attach/SP/persetujuan2.php?idtrx=<?php echo $data['idt']; ?>"
                                        target="_blank"><button class="btn btn-primary btn-sm btn-block">
                                            <?php if ($data['filepersetujuan']!=Null){ ?> <i class="fa fa-check"></i>
                                            <?php } ?> Persetujuan 2</button></a>
                                    <br />
                                    <?php
                                    //status tindakan 
                                    } else if ($stat=='tindakan') { ?>
                                    <a href="uploadaftr.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-primary btn-sm">
                                            <?php 
                                                $notrx  = $data['notrx'];
                                                $qcekfoto	=	mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx' AND (foto_afr!='' OR foto2_afr!='')");
                                                $cekfoto  = mysqli_num_rows($qcekfoto);
                                                
                                            if ($cekfoto>0){ ?> <i class="fa fa-check"></i>
                                            <?php } ?>
                                            Foto Selesai</button></a>
                                    <?php } else if ($stat=='done') { ?>
                                    <a href="pakaibrg.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pen"></i> Pemakaian Brg</button></a>
                                    <?php } else if ($stat=='done_brg') { ?>
                                    <a href="penggunaanbrg.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-plus"></i> Barang Keluar</button></a>
                                    <?php }?>
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
        <aside class="control-sidebar control-sidebar-dark">

        </aside>

        <?php include('../componen/foot.php'); ?>
    </div>
    <?php include('../componen/script.php'); ?>
</body>

</html>