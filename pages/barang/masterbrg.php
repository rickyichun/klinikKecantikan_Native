<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar STOK barang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if($role=='kasir'|| $role=='perawat'){ ?>
                    <a href="inputbrg.php"><button class="btn btn-primary"><i class="fa fa-box"></i>
                            Nama Barang Baru</button></a>
                    <a href="masterreq.php"><button class="btn btn-info"><i class="fa fa-book"></i>
                            Daftar Request Barang</button></a>
                    <?php } if($role=='admin' || $role=='dokter'){ 
								if($role=='admin'){ ?>
                    <a href="inputbrg.php"><button class="btn btn-primary"><i class="fa fa-box"></i>
                            Nama Barang Baru</button></a>
                    <?php } ?>
                    <a href="masterreq.php"><button class="btn btn-info"><i class="fa fa-book"></i>
                            Daftar Request Barang</button></a>
                    <a href="brgmsuk.php"><button class="btn btn-secondary"><i class="fa fa-plus"></i>
                            Stok Masuk</button></a>
                    <a href="history_msk.php"><button class="btn btn-warning"><i class="fa fa-search"></i>
                            Riwayat Pembelian</button></a>
                    <?php } ?>
                    <div class="col-md-12 mb-4"></div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Min Stok</th>
                                <th>Satuan</th>
                                <th>Stat Req</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT * from m_barang order by id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            if($data['stok']<$data['minstok']){
                            ?>
                            <tr style="background-color:indianred;color:white;border-color:black;font-size:larger">
                                <?php } else { ?>
                            <tr> <?php } ?>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['namabrg']; ?></td>
                                <td><?php echo $data['stok']; ?></td>
                                <td><?php echo $data['minstok']; ?></td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td>
                                    <?php
                                        $idbrg=$data['id'];
                                        $qreq=mysqli_query($conn, "SELECT * from reqbarang WHERE idbrg='$idbrg' AND status!='done_qty'");
                                        $cekreq=mysqli_num_rows($qreq);
                                        $req=mysqli_fetch_array($qreq);
                                        if($cekreq>0){
                                            $idusr=$req['iduser'];
                                            $qusr=mysqli_query($conn, "SELECT * from tb_user WHERE user_id='$idusr'");
                                            $usr=mysqli_fetch_array($qusr); 
                                            echo "<a href='../barang/masterreq.php'>Req by ".$usr['fullname']."</a>";
                                        } else {
                                            echo "-";
                                        }
                                    ?>
                                </td>
                                <td><?php if($role=='admin' || $role=='dokter'){ ?>
                                    <a href="editbrg.php?ide=<?php echo $data['id']; ?>"><button
                                            class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                                    <?php } ?>
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