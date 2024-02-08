<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Request Barang Masuk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a href="reqbarang.php"><button class="btn btn-info"><i class="fa fa-plus"></i>
                            Request Barang</button></a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NoRequest</th>
                                <th>Nama barang</th>
                                <th>Qty Request</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php					
									$tampil=mysqli_query($conn, "SELECT *, reqbarang.id as idr from reqbarang, m_barang WHERE reqbarang.idbrg=m_barang.id order by reqbarang.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                                    $stat = $data['status'];
                            if($stat=='done_qty'){
                            ?>
                            <tr style="background-color:lightgreen;border-color:black">
                                <?php } else if($stat=='reject'){
                            ?>
                            <tr style="background-color:indianred;border-color:black">
                                <?php } else {?>
                            <tr>
                                <?php } ?>
                                <td><?php echo $no;?></td>
                                <td><?php echo $data['noreq']; ?></td>
                                <td><?php echo $data['namabrg']; ?></td>
                                <td><?php echo $data['qty']; ?></td>
                                <td><?php echo $stat;
                                          if($stat=='done_qty'){
                                            $noreq = $data['noreq'];
                                            $idbrg = $data['idbrg'];
                                            $qreq=mysqli_query($conn, "SELECT * from riw_qtymasuk WHERE noreq='$noreq' AND idbarang='$idbrg'");
                                            $req=mysqli_fetch_array($qreq);
                                                $cekR=substr($req['noreq'],0,1);
                                                if($cekR!='R'){
                                                    $idreq = $data['idr'];
                                                    $qreq1=mysqli_query($conn, "SELECT * from riw_qtymasuk WHERE noreq='$idreq' AND idbarang='$idbrg'");
                                                    $req1=mysqli_fetch_array($qreq1);
                                                    echo " = ".$req1['qtyin'];
                                                } else {
                                                    echo " = ".$req['qtyin'];
                                                }
                                          }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                            if($role=='admin' || $role=='dokter'){
                                                if($stat=='req') {
                                    ?>
                                    <a
                                        href="../control/update.php?mode=5&idreq=<?php echo $data['idr']; ?>&tindak=aprv"><button
                                            class="btn btn-success"><i class="fa fa-check"></i>
                                            Approve</button></a>
                                    <a href="../control/update.php?mode=5&idreq=<?php echo $data['idr']; ?>&tindak=rej"><button
                                            class="btn btn-danger"><i class="fa fa-dash"></i>
                                            Reject</button></a>
                                    <?php } else if ($stat=='aprv'){ ?>
                                    <a href="pembelianbrg.php"><button class="btn btn-warning"><i
                                                class="fa fa-shopping-cart"></i>
                                            Pembelian Brg</button></a>
                                    <?php
                                            }
                                    } else if($stat=='aprv'&&($role=='admin' || $role=='kasir')) {?>
                                    <a href="brgmsuk.php?idreq=<?php echo $data['idr']; ?>"><button
                                            class="btn btn-info"><i class="fa fa-plus"></i>
                                            input brg</button></a>
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