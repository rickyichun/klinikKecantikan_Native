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
                    <h3 class="card-title">Pembayaran Gaji Perawat</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=17" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Perawat</label>
                            <select id="perawat" name="perawat" class="form-control selectize" required>
                                <option></option>
                                <?php
                                    $query3 = mysqli_query($conn, "SelECT * FROM perawat");
                                    while ($data3  = mysqli_fetch_array($query3)) { ?>
                                <option value="<?php echo $data3['id']; ?>">
                                    <?php echo $data3['namapwt']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control selectize" id="jk" name="jk">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bulan - Tahun</label>
                            <input type="month" class="form-control" id="bulan" name="bulan" placeholder="Bulan"
                                required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Lembur</label>
                            <input type="number" class="form-control" id="lembur" name="lembur" placeholder="Lembur">
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Insentif</label>
                            <input type="number" class="form-control" id="insentif" name="insentif"
                                placeholder="Insentif">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bpjs</label>
                            <input type="number" class="form-control" id="bpjs" name="bpjs" placeholder="BPJS">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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

    <div class="modal fade" id="fotoModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                </div>
                <div class="modal-body">
                    <video autoplay="true" id="player" width="100%"></video><br>
                </div>
                <div class="modal-footer">
                    <label>Pilih Kamera:</label>
                    <select id="video-source"></select>
                    <button onclick="takeSnapshot()">Ambil Gambar</button>
                    <button type="button" id="stop" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
function camera_on() {
    document.getElementById("chooseFile").hidden = true;
    let videoSourcesSelect = document.getElementById("video-source");
    let videoPlayer = document.getElementById("player");
    let stopVideoButton = document.getElementById("stop");

    videoSourcesSelect.onchange = function() {
        MediaStreamHelper.requestStream().then(function(stream) {
            MediaStreamHelper._stream = stream;
            videoPlayer.srcObject = stream;
        });
    };

    stopVideoButton.onclick = function(stream) {
        if (document.getElementById("imgText").value == "") {
            document.getElementById("chooseFile").hidden = false;
        } else {
            document.getElementById("hapus").hidden = false;
        }
        var track = videoPlayer.srcObject.getTracks();
        track[0].stop();
        // console.log(track[0]);
    };

    // Create Helper to ask for permission and list devices
    let MediaStreamHelper = {
        // Property of the object to store the current stream
        _stream: null,
        // This method will return the promise to list the real devices
        getDevices: function() {
            return navigator.mediaDevices.enumerateDevices();
        },
        // Request user permissions to access the camera and video
        requestStream: function() {
            if (this._stream) {
                this._stream.getTracks().forEach(track => {
                    track.stop();
                });
            }
            const videoSource = videoSourcesSelect.value;
            const constraints = {
                video: {
                    deviceId: videoSource ? {
                        exact: videoSource
                    } : undefined
                }
            };

            return navigator.mediaDevices.getUserMedia(constraints);
        }
    };
    // Request streams (audio and video), ask for permission and display streams in the video element
    MediaStreamHelper.requestStream().then(function(stream) {
        console.log(stream);
        // Store Current Stream
        MediaStreamHelper._stream = stream;

        videoSourcesSelect.selectedIndex = [...videoSourcesSelect.options].findIndex(option => option.text ===
            stream.getVideoTracks()[0].label);

        // Play the current stream in the Video element
        videoPlayer.srcObject = stream;

        // You can now list the devices using the Helper
        MediaStreamHelper.getDevices().then((devices) => {
            // Iterate over all the list of devices (InputDeviceInfo and MediaDeviceInfo)
            devices.forEach((device) => {
                let option = new Option();
                option.value = device.deviceId;

                // According to the type of media device
                switch (device.kind) {
                    // Append device to list of Cameras
                    case "videoinput":
                        option.text = device.label || `Camera ${videoSourcesSelect.length + 1}`;
                        videoSourcesSelect.appendChild(option);
                        break;
                }

                console.log(device);
            });
        }).catch(function(e) {
            console.log(e.name + ": " + e.message);
        });
    }).catch(function(err) {
        console.error(err);
    });
}

function takeSnapshot() {
    // buat elemen img
    var img = document.createElement('img');
    var context;

    // ambil ukuran video
    var width = document.getElementById("player").offsetWidth,
        height = document.getElementById("player").offsetHeight;

    // buat elemen canvas
    canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;

    // ambil gambar dari video dan masukan 
    // ke dalam canvas
    context = canvas.getContext('2d');
    context.drawImage(document.getElementById("player"), 0, 0, width, height);
    document.getElementById("gambar").hidden = false;
    document.getElementById("gambar").src = canvas.toDataURL('image/png');
    document.getElementById("imgText").value = canvas.toDataURL('image/png');
    document.getElementById("submit").hidden = false;
}

function hapus() {
    document.getElementById("imgText").value = "";
    document.getElementById("gambar").src = "";
    document.getElementById("gambar").hidden = true;
    document.getElementById("chooseFile").hidden = false;
    document.getElementById("hapus").hidden = true;
}
</script>