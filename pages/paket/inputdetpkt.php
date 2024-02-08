<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php   $idpkt = $_GET['idpkt']; 
                    $tampil1 = mysqli_query($conn, "SELECT * from namapkt WHERE id='$idpkt'");
                    $data1   = mysqli_fetch_array($tampil1);
            ?>

            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Detail Paket <?php echo $data1['namapkt']; ?></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=5" method="post">
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="idpkt" name="idpkt" value="<?php echo $idpkt; ?>">
                        <div class="form-group">
                            <label>Pilih Barang</label>
                            <select id="barang" name="barang" class="form-control selectize" required>
                                <option></option>
                                <?php
                                    $query1 = mysqli_query($conn, "SelECT * FROM m_barang");
                                    while ($data1  = mysqli_fetch_array($query1)) { ?>
                                <option value="<?php echo $data1['id']; ?>">
                                    <?php echo $data1['namabrg']; ?> - <?php echo $data1['satuan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Qty</label>
                            <input type="number" class="form-control" id="qty" name="qty" placeholder="Jumlah" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" rows="3" id="keterangan" name="keterangan"
                                placeholder=" ................"></textarea>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php					
									$tampil=mysqli_query($conn, "SELECT *, detailpkt.id as iddet from detailpkt, m_barang WHERE detailpkt.idpkt='$idpkt' AND detailpkt.idbrg=m_barang.id");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){ 
                            ?>
                        <tr>
                            <!-- <td><?php echo $no;?></td> -->
                            <td><?php echo $data['namabrg']; ?></td>
                            <td><?php echo $data['qty']; ?></td>
                            <td><?php echo $data['satuan']; ?></td>
                            <td><?php if($role=='admin' || $role=='dokter'){ ?>
                                <a href="editdetpkt.php?ide=<?php echo $data['iddet']; ?>&idp=<?php echo $idpkt; ?>"><button
                                        class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $no++;
                                    } ?>
                    </tbody>

                </table>
            </div>
            <div class="card-footer">
                <a href="masterpkt.php"><button type="submit" class="btn btn-warning">Master Paket</button></a>
            </div>
            <!-- /.card-body -->
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