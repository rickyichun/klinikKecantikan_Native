<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="../main/dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <?php 
        if($role=='marketing'){ ?>
        <li class="nav-item" style="background-color:purple;color:white;border-color:black;font-size:larger">
            <a href="../jadwal/calendar.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Jadwal
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../marketing/mastermkt.php" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                    Master Marketing
                </p>
            </a>
        </li>
        <?php } else if($role=='kasir'){ ?>
        <li class="nav-item">
            <a href="../jadwal/calendar.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Jadwal
                </p>
            </a>
        </li>
        <li class="nav-item" style="background-color:purple;color:white;border-color:black;font-size:larger">
            <a href="../transaksi/history_trx.php" class="nav-link">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                    Tindakan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../barang/masterbrg.php" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>
                    STOK
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../perawat/masterpwt.php" class="nav-link">
                        <i class="nav-icon fas fa-ambulance"></i>
                        <p>
                            Master Perawat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../pasien/masterpasien.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Pasien
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <?php } else if($role=='perawat'){ ?>

        <!-- <li class="nav-item">
            <a href="../jadwal/calendar.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Jadwal
                </p>
            </a>
        </li> -->
        <li class=" nav-item" style="background-color:purple;color:white;border-color:black;font-size:larger">
            <a href="../transaksi/history_trx.php" class="nav-link">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                    Tindakan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../barang/masterbrg.php" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>
                    STOK
                </p>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a href="../perawat/masterpwt.php" class="nav-link">
                <i class="nav-icon fas fa-ambulance"></i>
                <p>
                    Master Perawat
                </p>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="../pasien/masterpasien.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Master Pasien
                </p>
            </a>
        </li>
        <?php } else if($role=='dokter'){ ?>

        <li class="nav-item">
            <a href="../jadwal/calendar.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Jadwal
                </p>
            </a>
        </li>
        <li class=" nav-item" style="background-color:purple;color:white;border-color:black;font-size:larger">
            <a href="../transaksi/history_trx.php" class="nav-link">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                    Tindakan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../perawat/masterpwt.php" class="nav-link">
                        <i class="nav-icon fas fa-ambulance"></i>
                        <p>
                            Master Perawat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../pasien/masterpasien.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Pasien
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../marketing/mastermkt.php" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Master Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../perawat/masterdktr.php" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>
                            Master Dokter
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../user/absensi.php" class="nav-link">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>
                            Master Absensi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../barang/masterbrg.php" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Master Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../paket/masterpkt.php" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Master Paket
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="../saldokas/masterklrmsk.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                    Saldo Kas
                </p>
            </a>
        </li>


        <?php } else { ?>
        <!-- ALL MENU -->
        <li class="nav-item">
            <a href="../jadwal/calendar.php" class="nav-link">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Jadwal
                </p>
            </a>
        </li>
        <li class="nav-item" style="background-color:purple;color:white;border-color:black;font-size:larger">
            <a href="../transaksi/history_trx.php" class="nav-link">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>
                    Tindakan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Master
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="../perawat/masterpwt.php" class="nav-link">
                        <i class="nav-icon fas fa-ambulance"></i>
                        <p>
                            Master Perawat
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../pasien/masterpasien.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Pasien
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../marketing/mastermkt.php" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Master Marketing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../perawat/masterdktr.php" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>
                            Master Dokter
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../barang/masterbrg.php" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Master Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../paket/masterpkt.php" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Master Paket
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../perawat/masterjabatan.php" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Master Jabatan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../user/masterusr.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master User
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="../saldokas/masterklrmsk.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                    Saldo Kas
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../user/absensi.php" class="nav-link">
                <i class="nav-icon fas fa-fingerprint"></i>
                <p>
                    Master Absensi
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../main/history_log.php" class="nav-link">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                    History Log
                </p>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>