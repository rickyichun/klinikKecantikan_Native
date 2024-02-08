<?php include('../componen/head.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include('../componen/sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="../control/update.php?mode=6" method="post">
                        <?php 
                            $uid = $_GET['uid'];
                            $tampil=mysqli_query($conn, "SELECT * from tb_user WHERE user_id='$uid'");
                            $data=mysqli_fetch_array($tampil);
                        ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                value="<?php echo $data['fullname']; ?>" required>
                            <input type="hidden" class="form-control" id="userid" name="userid"
                                value="<?php echo $uid; ?>">
                        </div>
                        <?php if ($_SESSION['role']=='admin'){ ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select type="select" class="form-control selectize" id="role" name="role" required>
                                <option value="kasir">Admin</option>
                                <option value="perawat">Perawat</option>
                                <option value="dokter">Dokter</option>
                            </select>
                        </div>
                        <?php } else { ?>
                        <input type="hidden" class="form-control" id="role" name="role"
                            value="<?php echo $_SESSION['role']; ?>">
                        <?php } ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="<?php echo $data['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password"></input>
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