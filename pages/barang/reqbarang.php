<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.card-header -->
            <!-- /.card-header -->
            <!-- form start -->
            <!-- <form enctype="multipart/form-data" action="../control/insert.php?mode=15" method="post"> -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Request Barang</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Request</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="tgl" name="tgl"
                            value="<?php date("d-m-Y",strtotime($data['tgltrx']));?>" readonly="readonly">
                    </div>
                </div>
            </div>
            <button class="mb-2 ml-2 btn btn-sm btn-primary" id="minus" onclick="minus()" disabled><i
                    class="fas fa-minus"></i></button>
            <button class="mb-2 ml-2 btn btn-sm btn-primary" id="plus" onclick="plus()"><i
                    class="fas fa-plus"></i></button>
            <input type="text" id="count" value="0">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" id="ct">Barang</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Nama Barang</label>
                            <select class="form-control selectize" onchange="get_satuan()" id="idbrg0" name="idbrg">
                                <option value disabled selected>Nama Barang</option>
                                <?php
                                        $tampil1=mysqli_query($conn, "SELECT * from m_barang");
                                        while($data1=mysqli_fetch_array($tampil1)){
                                        ?>
                                <option value="<?php echo $data1['id']?> "><?php echo $data1['namabrg']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="number" class="form-control" id="qty0" name="qty0" placeholder="Quantity">
                        </div>
                        <div class="col-md-1">
                            <label for="">Satuan</label>
                            <input type="text" id="satuan0" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <input type="text" class="form-control" id="ket0" name="ket0" placeholder="Keterangan">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- </form> -->
            <!-- /.card -->
            <!-- /.content -->
            <?php for($i=0;$i<20;$i++){?>
            <div id="destination<?=$i?>"></div>
            <?php } ?>
            <div class="card-footer">
                <button type="submit" onclick="submitall()" class="btn btn-primary">Submit</button>
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

<script>
function get_satuan() {
    var idbrg = document.getElementById('idbrg0').value;
    $(document).ready(function() {
        $.ajax({
            dataType: 'json',
            method: 'post',
            async: true,
            url: 'http://localhost/klinik/pages/control/get.php?mode=1',
            data: {
                id: idbrg
            },
            success: function(data) {
                // console.log(data.satuan);
                document.getElementById('satuan0').placeholder = data.satuan;
            }
        })
    })
}

function plus() {
    var count = document.getElementById("count").value
    var i = Number(count) + 1;
    document.getElementById("destination" + count).innerHTML =
        '<div class="card"><div class="card-header"><h3 class="card-title">Barang ' + Number(i + 1) +
        '</h3></div><div class="card-body"><div class="form-group row"><div class="col-md-6"><label for="exampleInputEmail1">Nama Barang</label><select class="form-control selectize" id="idbrg' +
        i + '" name="idbrg' + i +
        '"><option value disabled selected>Nama Barang</option><?php $tampil1=mysqli_query($conn, "SELECT * from m_barang");while($data1=mysqli_fetch_array($tampil1)){?><option value="<?php echo $data1['id']?> "><?php echo $data1['namabrg']?></option><?php } ?></select></div><div class="col-md-5"><label for="exampleInputEmail1">Quantity</label><input type="number" class="form-control" id="qty' +
        i + '" name="qty' + i +
        '"placeholder="Quantity"></div><div class="col-md-1"><label for="">Satuan</label><input type="text" id="satuan' +
        i +
        '" class="form-control" readonly></div></div><div class="form-group"><label for="exampleInputEmail1">Keterangan</label><input type="text" class="form-control" id="ket' +
        i + '" name="ket' + i + '" placeholder="Keterangan"></div></div><!-- /.card-body --></div>';
    $(document).ready(function() {
        $("#idbrg" + i).selectize();
    });
    document.getElementById('count').value = Number(i);
    document.getElementById('ct').innerHTML = "Barang 1";
    if (count == 18) {
        document.getElementById('plus').disabled = true;
    }
    document.getElementById('minus').disabled = false;

    $(document).ready(function() {
        $("#idbrg" + i).change(function() {
            // console.log(document.getElementById('idbrg'+i).value);
            var idbrg = document.getElementById('idbrg' + i).value;
            $.ajax({
                dataType: 'json',
                method: 'post',
                async: true,
                url: 'http://localhost/klinik/pages/control/get.php?mode=1',
                data: {
                    id: idbrg
                },
                success: function(data) {
                    // console.log(data.satuan);
                    document.getElementById('satuan' + i).placeholder = data.satuan;
                }
            })
        });
    });
}

function minus() {
    var count = document.getElementById('count').value
    var i = Number(count) - 1;
    var d = document.getElementById("destination" + i);
    document.getElementById('count').value = parseInt(i);
    d.innerHTML = null;
    document.getElementById('plus').disabled = false;
    if (i <= 0) {
        document.getElementById('minus').disabled = true;
        document.getElementById('ct').innerHTML = "Barang"
    }
}

function submitall() {
    var count = document.getElementById('count').value;
    var tgl = document.getElementById('tgl').value;
    var barang = [];
    var qty = []
    var ket = [];
    var status = true
    for (let i = 0; i <= count; i++) {
        barang[i] = document.getElementById('idbrg' + i).value;
        qty[i] = document.getElementById('qty' + i).value;
        ket[i] = document.getElementById('ket' + i).value;
        if (barang[i] == "" || qty[i] == "") {
            status = false;
        }
    }
    if (status == false) {
        Swal.fire({
            icon: 'warning',
            title: '<h3>Peringatan!</h3>',
            html: '<h5>Mohon untuk melengkapi data</h5>',
            showConfirmButton: true,
            confirmButtonText: 'Kembali'
        })
    } else {
        $.ajax({
            dataType: "json",
            method: "post",
            async: true,
            url: 'http://localhost/klinik/pages/control/insert.php?mode=15',
            data: {
                count: count,
                tgl: tgl,
                qty: qty,
                idbrg: barang,
                ket: ket
            },
            success: function(data) {
                console.log(data);
                if (data == "berhasil" || data == "gagal") {
                    window.location = 'http://localhost/sikdemo/pages/barang/masterbrg.php';
                }
            }
        })
    }
}
</script>