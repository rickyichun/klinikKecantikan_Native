<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stok Barang Masuk</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=10" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Transaksi</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="tgl"
                                name="tgl" required>
                            <input type="hidden" class="form-control" value="<?php echo $_SESSION['user_id'] ?>"
                                id="iduser" name="iduser">
                        </div>
                        <?php 
                            if (isset($_GET['idreq'])){ 
                                $idereq = $_GET['idreq']; 
                                $qrequest=mysqli_query($conn, "SELECT * from reqbarang, m_barang WHERE reqbarang.idbrg=m_barang.id AND reqbarang.id='$idereq'");
                                $request=mysqli_fetch_array($qrequest);
                                $noreq = $request['noreq']; 
                                ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Request</label>
                            <input type="text" class="form-control"
                                value="<?php echo $noreq." - ".$request['namabrg']; ; ?>" readonly="readonly">
                            *Qty Request = <?php echo $request['qty'] ; ?>
                            <input type="hidden" class="form-control" id="noreq" name="noreq"
                                value="<?php echo $idereq; ?>">
                            <input type="hidden" class="form-control" id="idbrg" name="idbrg"
                                value="<?php echo $request['idbrg']; ?>">
                        </div>
                        <?php } else { ?>
                        <select class="form-control selectize" id="noreq" name="noreq">
                            <?php					
                                    $tampil4=mysqli_query($conn, "SELECT *, reqbarang.id as idreq from reqbarang, m_barang WHERE reqbarang.idbrg=m_barang.id AND reqbarang.status='aprv' order by reqbarang.id desc");
                                    while($data4=mysqli_fetch_array($tampil4)){
                                ?>
                            <option value="<?php echo $data4['idreq'];?>"><?php echo $data4['noreq'];?> -
                                <?php echo $data4['namabrg'];?></option>
                            <?php } ?>
                            <option value="tnp_request">Tanpa Request</option>
                        </select>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>

                            <select class="form-control selectize" id="idbrg" name="idbrg">
                                <?php					
                                            $tampil3=mysqli_query($conn, "SELECT * from m_barang order by id desc");
                                            while($data3=mysqli_fetch_array($tampil3)){
                                        ?>
                                <option value="<?php echo $data3['id'];?>"><?php echo $data3['namabrg'];?> /
                                    <?php echo $data3['satuan'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" id="qty" name="qty"
                                        placeholder="Quantity">
                                </div>
                                <div class="col-md-9">
                                    <label for="exampleInputEmail1"> </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan">
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
                Riwayat Stok Barang Masuk
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nomor Request</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Oleh</th>
                            <th>Keterangan</th>
                            <!-- <th>Tindakan</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php					
									$tampil=mysqli_query($conn, "SELECT * from riw_qtymasuk, m_barang, tb_user WHERE riw_qtymasuk.idbarang=m_barang.id AND tb_user.user_id=riw_qtymasuk.iduser order by riw_qtymasuk.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data['tgltrx']; ?></td>
                            <td>
                                <?php 
                                      $cekR = substr($data['noreq'],0,1);
                                      if($cekR=='R'){
                                        echo $data['noreq'];
                                      } else {
                                        $idreq = $data['noreq'];
                                        $qreq=mysqli_query($conn, "SELECT * from reqbarang WHERE id='$idreq'");
                                        $req=mysqli_fetch_array($qreq);
                                        echo $req['noreq'];
                                      } 
                                ?>
                            </td>
                            <td><?php echo $data['namabrg']; ?></td>
                            <td><?php echo $data['qtyin']; ?></td>
                            <td><?php echo $data['satuan']; ?></td>
                            <td><?php echo $data['fullname']; ?></td>
                            <!-- <td><?php echo $data['ket']; ?></td> -->
                            <td>
                                <!-- <a href="#"><button class="btn btn-warning"><i class="fa fa-pen"></i>
                                        Edit</button></a>
                                <a href="#"><button class="btn btn-danger"><i class="fa fa-trash"></i>
                                        Hapus</button></a> -->
                            </td>
                        </tr>
                        <?php $no++;
                                    } ?>
                    </tbody>

                </table>
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