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
                    <h3 class="card-title">Pembelian Barang/ Barang Masuk</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=12" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Transaksi</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="tgl"
                                name="tgl">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <select class="form-control selectize" id="idbrg" name="idbrg">
                                <?php
                                $tampil1=mysqli_query($conn, "SELECT * from m_barang");
							    while($data1=mysqli_fetch_array($tampil1)){
                                ?>
                                <option value="<?php echo $data1['id']?> "><?php echo $data1['namabrg']?></option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity"
                                        required>
                                </div>
                                <div class="col-md-9">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga Beli</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Beli"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Suplier</label>
                            <input type="text" class="form-control" id="suplier" name="suplier" placeholder="Suplier">
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Keterangan</th>
                            <th>notrx</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php					
									$tampil=mysqli_query($conn, "SELECT *, riw_brgmasuk.notrx as notrans FROM riw_brgmasuk, m_barang WHERE riw_brgmasuk.idbarang=m_barang.id ORDER BY riw_brgmasuk.id desc");
									$no=1;
									while($data=mysqli_fetch_array($tampil)){
                            ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data['namabrg']; ?></td>
                            <td><?php echo $data['qtyin']; ?></td>
                            <td><?php echo $data['satuan']; ?></td>
                            <td><?php echo "Rp.".number_format($data['hargabeli'],0,',','.'); ?></td>
                            <td><?php echo $data['ket']; ?></td>
                            <td>
                                <?php echo $data['notrans']; ?>
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

    </div>
    <!-- /.card -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">

    </aside>

    <?php include('../componen/foot.php'); ?>
    </div>
    <?php include('../componen/script.php'); ?>
</body>

</html>