<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah User Baru</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="../control/insert.php?mode=20" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Username untuk login" required>
                        </div>
                        <?php 
                        if(isset($_GET['name'])){
                            $namah = $_GET['name'];
                            $idp = $_GET['idp'];
                        ?>
                        <input type="hidden" class="form-control" id="idp" name="idp" value="<?php echo $idp; ?>">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                value="<?php echo $namah; ?>" required>
                        </div>
                        <?php } else { ?>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                placeholder="Nama Lengkap" required>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select type="select" class="form-control selectize" id="role" name="role" required>
                                <!-- <option value="admin">Master</option> -->
                                <option value="kasir">Admin</option>
                                <option value="perawat">Perawat</option>
                                <option value="dokter">Dokter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password"></input>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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