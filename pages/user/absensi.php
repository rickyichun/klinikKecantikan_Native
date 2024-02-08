<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Absensi Karyawan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="../saldokas/lembur.php"><button class="btn btn-warning" style="margin-bottom:10px;"><i
                                class="fa fa-clock"></i>
                            Daftar Lembur diproses</button>
                    </a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Waktu Cekin</th>
                                <th>Waktu Cekout</th>
                                <th>Waktu Kerja</th>
                                <th>Foto</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from absensi, tb_user WHERE absensi.iduser=tb_user.user_id order by absensi.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                                    $uid = $data['iduser'];                                        
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php $wktin = strtotime($data['waktuin']);
                                            echo date("d-F-Y H:i:s",$wktin); ?></td>
                                <td><?php $wktout = strtotime($data['waktuout']);
                                          if($wktout==-62170009632){
                                            echo "Belum CheckOut";
                                          } else {
                                            echo date("d-F-Y H:i:s",$wktout);
                                          }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $htnglembur = false;
                                        $diff = $wktout-$wktin;
                                        $jam   = floor($diff / 3600);
                                        $menit = $diff - $jam * (3600);
                                            $tglin = strtotime(date("Y-m-d",$wktin));
                                            $tglout = strtotime(date("Y-m-d",$wktout));
                                        if($wktout==-62170009632){
                                            echo "Belum CheckOut";
                                        } else if ($tglin!=$tglout) {
                                            echo "Tanggal CheckIn & CheckOut Berbeda";
                                        }
                                        else {
                                            echo 'Waktu Kerja : ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';
                                            $jam5 = strtotime("17:00:00");
                                            $jamplg = strtotime(date("H:i:s",$wktout));
                                                $lembur = $jamplg-$jam5;
                                                $jaml   = floor($lembur / 3600);
                                                $menitl = $lembur - $jaml * (3600);
                                                // echo strtotime(date("17:00:00"));
                                            if ($lembur > 0 && $lembur < 3600) {
                                                echo "<br/>Tidak Terhitung Lembur!";
                                            } else if($lembur>3600){
                                                if($tglin==$tglout){
                                                    $htnglembur = true;
                                                    echo "<br/>Lembur : ". $jaml .  ' jam, ' . floor( $menitl / 60 ) . ' menit';
                                                } else {
                                                    echo "<br/>Tidak Terhitung Lembur!";
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                            $foto =  $data['fotoin'];
                                            if ($foto!=""){
                                    ?>
                                    <form target="_blank" action="../componen/imagepreview.php" method="post">
                                        <input type="text" name="image" value="<?php echo $data['fotoin'] ?>" hidden>
                                        <button type="submit">Checkin</button>
                                    </form>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                            $fotoout =  $data['fotoout'];
                                            if ($fotoout!=""){
                                    ?>
                                    <form target="_blank" action="../componen/imagepreview.php" method="post">
                                        <input type="text" name="image" value="<?php echo $data['fotoout'] ?>" hidden>
                                        <button type="submit">Checkout</button>
                                    </form>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($htnglembur==true){
                                        $tanggal = date("Y-m-d",$wktout);
                                        $qcekl = mysqli_query($conn, "SELECT * from lembur WHERE tgl='$tanggal' AND userid='$uid'");
                                        $cekl = mysqli_num_rows($qcekl); 
                                        if($cekl>0){ 
                                            echo "Lembur sudah diproses";
                                        } else {?>

                                    <a href="../control/update.php?mode=17&idabs=<?php echo $data['id']; ?>"
                                        onclick="javascript: return confirm('Anda yakin Hapus Absen ? Absen tidak akan dapat kembali !')"><button
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button></a>

                                    <a href="../control/insert.php?mode=23&idabs=<?php echo $data['id']; ?>"><button
                                            class="btn btn-primary"><i class="fas fa-clock"></i></button></a>
                                    <?php }
                                    } else if($wktout!=-62170009632){ ?>
                                    <a href="../control/update.php?mode=17&idabs=<?php echo $data['id']; ?>"
                                        onclick="javascript: return confirm('Anda yakin Hapus Absen ? Absen tidak akan dapat kembali !')"><button
                                            class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                                    <?php 
                                    } ?>
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