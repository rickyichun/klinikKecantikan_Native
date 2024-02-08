<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat kas keluar-masuk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label>Date range:</label>
                                </div>
                                <div class="col-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="date" id="date"
                                            value="">
                                        <input type="hidden" name="start" id="start">
                                        <input type="hidden" name="end" id="end">
                                    </div>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-primary" type="submit" onclick="find()">
                                Apply
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div id="tabelreport"></div>
                    </div>

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
<script>
// $('#date').daterangepicker({
//     locale: {
//         format: 'DD MMMM YYYY'
//     }
// })

$(function() {
    $('input[name="date"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'DD MMMM YYYY'
        }
    }, function(start, end, label) {
        var startdate = start.format('YYYY-MM-DD'),
            enddate = end.format('YYYY-MM-DD');

        document.getElementById('start').value = startdate;
        document.getElementById('end').value = enddate;
        console.log(startdate, enddate)
    });

    $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD MMMM YYYY') + ' - ' + picker.endDate.format(
            'DD MMMM YYYY'));
    });

    $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
});

function find() {
    var start = document.getElementById('start').value,
        end = document.getElementById('end').value,
        date = document.getElementById('date').value;
    $.ajax({
        type: 'POST',
        url: "../report/cari_data_report.php",
        data: {
            start: start,
            end: end,
        },
        success: function(data) {

            var datareport = JSON.parse(data),
                no = 1,
                summasuk = 0,
                sumkeluar = 0,
                str = '';
            console.log(datareport);
            var saldoawal = datareport[1].saldoawal[0].masuk - datareport[1].saldoawal[0].keluar;
            // var param = 'printarea';
            str += '<button class="btn btn-secondary btn-sm" onclick="printDiv()">print</button>';
            str += '<div id="printarea">';
            str += '<div class="text-center mb-2">';
            str += 'Riwayat Kas Keluar Masuk <br> tanggal : <b>' + date + '</b>';
            str += '</div>';
            str += '<table id="example1" class="table table-bordered table-striped">';
            str += '    <thead>';
            str += '        <tr>';
            str += '            <th>No</th>';
            str += '            <th>Tanggal</th>';
            str += '            <th>Deskripsi</th>';
            str += '            <th>Masuk</th>';
            str += '            <th>Keluar</th>';
            str += '        </tr>';
            str += '        <tr>';
            str += '            <th></th>';
            str += '            <th></th>';
            str += '            <th>Saldo Awal</th>';
            str += '            <th>' + saldoawal + '</th>';
            str += '            <th></th>';
            str += '        </tr>';
            str += '    </thead>';
            str += '    <tbody>';
            for (let i = 0; i < datareport[0].transaksi.length; i++) {
                var masuk = Number(datareport[0].transaksi[i].masuk),
                    keluar = Number(datareport[0].transaksi[i].keluar);
                summasuk += masuk;
                sumkeluar += keluar;
                str += '        <tr>';
                str += '            <td>' + no++ + '</td>';
                str += '            <td>' + datareport[0].transaksi[i].tanggal + '</td>';
                str += '            <td>' + datareport[0].transaksi[i].deskripsi + '</td>';
                str += '            <td>' + datareport[0].transaksi[i].masuk + '</td>';
                str += '            <td>' + datareport[0].transaksi[i].keluar + '</td>';
                str += '        </tr>';
            }
            var valuemasuk = saldoawal + summasuk,
                value = valuemasuk - sumkeluar;
            str += '    </tbody>';
            str += '    <tfoot>';
            str += '        <tr>';
            str += '            <td></td>';
            str += '            <td></td>';
            str += '            <td><b>Totalan</b></td>';
            str += '            <td><b>' + valuemasuk + '</td>';
            str += '            <td><b>' + sumkeluar + '</td>';
            str += '        </tr>';
            str += '        <tr>';
            str += '            <td></td>';
            str += '            <td></td>';
            str += '            <td><b>Value</b></td>';
            str += '            <td colspan="2" class="text-center"><b>' + value + '</td>';
            str += '        </tr>';
            str += '    </tfoot>';
            str += '</table>';
            str += '</div>';

            document.getElementById('tabelreport').innerHTML = str;
            console.log()
        }
    });
}

function printDiv() {
    var printContents = document.getElementById('printarea').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>

</html>