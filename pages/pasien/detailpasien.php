<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>
        <?php $idpasien = $_GET['idpasien']; 
              $tampil1 = mysqli_query($conn, "SELECT * from pasien WHERE id='$idpasien'");
              $data1   = mysqli_fetch_array($tampil1);
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="d-flex">
                    <div class="col-md-3 col-sm-4">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if($data1['foto']!=Null){ ?>
                                <img class="profile-user-img img-fluid img-circle"
                                    src="../attach/foto/<?php $data1['foto']; ?>" alt="User profile picture">
                                <?php } else { ?>
                                <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user1.jpg"
                                    alt="User profile picture">
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <h3 class="profile-username text-center"><?= $data1['nama'];?></h3>

                        <p class="text-muted text-center"><?= $data1['noktp'];?></p>

                    </div>
                    <!-- /.card -->
                    <div class="col-md-9 col-sm-8">
                        <div class="card-body box-profile">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Jenis Kelamin : </b> <?= $data1['jeniskelamin'];?>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat : </b> <?= $data1['alamat'];?>
                                </li>
                                <li class="list-group-item">
                                    <b>Tempat, Tgl Lahir :</b>
                                    <?= $data1['tempatlahir'].", ".date("d-m-Y",strtotime($data1['tgllahir']));;?>
                                </li>
                                <li class="list-group-item">
                                    <b>No Telpon : </b> <?= $data1['notlp'];?>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">History Transaksi Pasien <?php echo $data1['nama'] ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                <th>File</th>
                        </thead>
                        <tbody>
                            <?php					
									 $idp = $_SESSION['idpwt'];
                                     $tampil=mysqli_query($conn, "SELECT *, riw_trx.id as idt, riw_trx.tglupdate as tglnew FROM riw_trx, pasien, namapkt, perawat, tb_user WHERE riw_trx.idpasien=pasien.id AND riw_trx.idpkt=namapkt.id AND riw_trx.idpwt=perawat.id AND riw_trx.iduser=tb_user.user_id AND riw_trx.idpasien='$idpasien'  order by riw_trx.id desc");    
									$no=1;
									while($data=mysqli_fetch_array($tampil)){ 
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo date("d-m-Y",strtotime($data['tgl'])); ?></td>
                                <td><?php echo $data['notrx']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['namapkt']; ?></td>
                                <td><?php echo $data['qtypkt']." ".$data['satuan']; ?></td>
                                <td><?php echo $data['namapwt']; ?></td>
                                <td><?php $stat = $data['status'];
                                          echo $stat; ?></td>
                                <td><?php echo date("d-m-Y H:i:s",strtotime($data['tglnew'])); ?></td>
                                <td><a href="detailsoap.php?idtrx=<?php echo $data['idt']; ?>"><button
                                            class="btn btn-primary btn-block">S.O.A.P</button></a>
                                    <br />
                                    <a target="_blank"
                                        href="../transaksi/invoicedone.php?idtrx=<?php echo $data['notrx']; ?>"><button
                                            class="btn btn-success"><i class="fa fa-dollar-sign"></i>
                                            Invoice</button></a>
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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pasien <?php echo $data1['nama'] ?> Sebelum Konsultasi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="inputriwpasien.php?idp=<?php echo $idpasien; ?>"><button class="btn btn-primary"><i
                                class="fa fa-plus"></i> Riwayat Sebelum Konsul</button></a>
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Jenis</th>
                                <th>TglUpdate</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT *,riw_pasien.foto as rfoto, riw_pasien.tglupdate as rtglupdate  from riw_pasien, pasien WHERE pasien.id='$idpasien' AND riw_pasien.idpasien=pasien.id ORDER BY rtglupdate");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){ 
                            ?>
                            <tr>
                                <!-- <td><?php echo $no;?></td> -->
                                <td><?php echo $data['deskripsi']; ?></td>
                                <?php if($data['rfoto']==""){?>
                                <td><a target="_blank"
                                        href="../attach/fotoriw/<?php echo $data['file']; ?>"><?php echo $data['file']; ?></a>
                                </td>
                                <?php }else{ ?>
                                <td>
                                    <form target="_blank" action="../componen/imagepreview.php" method="post">
                                        <input type="text" name="image" value="<?= $data['rfoto']; ?>" hidden>
                                        <button type="submit">Preview</button>
                                    </form>
                                </td>
                                <?php } ?>
                                <td><?php echo $data['jenis']; ?></td>
                                <td><?php echo $data['rtglupdate']; ?></td>
                                <td></td>
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