<?php
include "basisdata.php";
include "cek-login.php" ;
ini_set('date.timezone', 'Asia/Jakarta');
date_default_timezone_set('Asia/Jakarta');
$timestamp	= date('Y-m-d H:i:s');

$query2        = mysqli_query($conn, "SELECT * FROM saldo_keluar ORDER BY id DESC LIMIT 1");
$datah         = mysqli_fetch_array($query2);
$noLm          = $datah['notrx'];
$bln           = date('m');
$thn           = date('y');
$tgl           = sprintf("%02s", date('d'));
$blnTkt        = sprintf("%02s", (int) substr($noLm, 5, 2));
$ThnTkt        = sprintf("%02s", (int) substr($noLm, 3, 2));
    if ($blnTkt == $bln && $ThnTkt == $thn) {
        $noU       = (int) substr($noLm, 9, 3);
    } else {
        $noU       = 0;
    }
$noUrut        = (int) $noU + 1;
$notrx         = "KRE".$thn. $bln .$tgl."-".sprintf("%03s", $noUrut);
echo $ThnTkt;
//Cek no transaksi Double
$query3        = mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx'");
$ceknoinv      = mysqli_num_rows($query3);
if($ceknoinv > 0){
    $noSama = $noUrut+1;
    $notrx  = "KRE".$thn. $bln .$tgl."-".sprintf("%03s", $noSama);
}


?>