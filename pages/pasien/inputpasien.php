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
                    <h3 class="card-title">Tambah Pasien Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../control/insert.php?mode=1" method="post">
                    <div class="card-body">
                        <?php   $jenis=$_GET['jns'];
                            if($jenis=='mkt'){
                                $idjdw = $_GET['idjdw'];
                                $tampil1=mysqli_query($conn, "SELECT * from jadwal WHERE id='$idjdw'");
                                $data1=mysqli_fetch_array($tampil1); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="hidden" class="form-control" id="idjdwl" name="idjdwl"
                                value="<?php echo $idjdw; ?>">
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $data1['nama'] ?>" required>
                        </div>
                        <?php } else { ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="hidden" class="form-control" id="idjdwl" name="idjdwl" value="0">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"
                                required>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control selectize" id="jk" name="jk">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No KTP/SIM</label>
                            <input type="number" class="form-control" id="noktp" name="noktp" placeholder="KTP/SIM">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempatlhr" name="tempatlhr"
                                placeholder="Tempat Lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgllahir" name="tgllahir"
                                placeholder="Tanggal Lahir" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" id="alamat" name="alamat"
                                placeholder="Masukkan Alamat ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telpon</label>
                            <input type="number" class="form-control" id="notlp" name="notlp" placeholder="No Telpon">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div> -->
                        <div class="form-group">
                            <label for="exampleInputFile">File foto
                                <br />
                                <i>*Wajib menambahkan foto (tombol ambil foto untuk kamera atau
                                    tombol browse untuk upload file)</i>
                            </label>
                            <div class="input-group" id="chooseFile">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="foto">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                &emsp;
                                <div onclick="camera_on()" data-toggle="modal" data-target="#fotoModal" id="ambilFoto"
                                    class="btn btn-sm btn-secondary"><i class="fas fa-camera"></i> Ambil foto</div>
                            </div>
                        </div>
                        <!-- ambil foto -->
                        <input hidden type="image" id="gambar" style="width:30%;width:30%"><br>
                        <input hidden type="text" id="imgText" name="foto2">

                        <div id="hapus" onclick="hapus()" hidden class="btn btn-sm btn-danger"><i
                                class="fas fa-trash fa-sm"></i> Buang</div>

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