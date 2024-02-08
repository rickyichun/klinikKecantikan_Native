<?php
//lanjutkan session yang sudah dibuat sebelumnya
session_start();

//hapus session yang sudah dibuat
$_SESSION['username'] = '';
unset($_SESSION['username']);
session_unset();
session_destroy();
//redirect ke halaman login
header('location:../main/login.php?error=3');
?>