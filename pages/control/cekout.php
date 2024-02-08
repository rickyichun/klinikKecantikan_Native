<?php
error_reporting(0);
session_start();
include "basisdata.php";
$foto2		= $_POST['foto2'];
$foto       = $_FILES['foto']['name'];
$tmp        = $_FILES['foto']['tmp_name'];

$idus = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$iduser = $_SESSION['user_id'];
$timestamp	= date('Y-m-d H:i:s');

unset($_SESSION['checkin']);
$dat   = mysqli_query($conn, "SELECT * from tb_user WHERE user_id='$idus'");
$data  = mysqli_fetch_array($dat);
$idabs = $data['idcekin'];
//cektgl cekin
$tglcekin = date("Y-m-d",strtotime($data['timestamp']));
$tglnow = date("Y-m-d");

$fotobaru = "abs_out_". $foto;
$path = "../attach/absen/" . $fotobaru;

if($foto2 == "") {
    if (move_uploaded_file($tmp, $path)) {
        $poto = $fotobaru;
    }
} else {
    $poto = $foto2;
}
//ambil absen
$dat   = mysqli_query($conn, "SELECT * from absensi WHERE id='$idabs'");
$data2  = mysqli_fetch_array($dat);
$cekin = date("Y-m-d",strtotime($data2['waktuin']));
if($cekin==$tglnow){
    $wktuabsen = $timestamp;
} else {
    $thncekin = substr($cekin,0,4);
    $blncekin = substr($cekin,5,2);
    $tglcekin = substr($cekin,8,2);
    $jamplg = mktime(17,0,0,$blncekin,$tglcekin,$thncekin);
    $wktuabsen = date("Y-m-d H:i:s",$jamplg);
}
$update = mysqli_query($conn, "UPDATE absensi SET waktuout='$wktuabsen', fotoout='$poto' WHERE id='$idabs'");
$update2 = mysqli_query($conn, "UPDATE tb_user SET status='checkout' WHERE user_id='$idus'");

$tgljamnow =  date("Y-m-d H:i:s");
//simpanLog
$keter = $fullname." melakkukan Checkout pada : ".$tgljamnow ; 
$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
VALUES ('$keter','$iduser','$timestamp')");

if ($update){
    if ($tglcekin==$tglnow){
        $_SESSION['checkin'] = "Anda Sudah Checkout";
    } else {
        $_SESSION['checkin'] = "Anda Belum Checkin";
    }

    echo "<script>window.location = '../main/dashboard.php'</script>";
    $_SESSION['alert'] = "berhasil";
    $_SESSION['pesan'] = "Anda berhasil Checkout!";	
} else {
    echo "<script>window.location = '../main/dashboard.php'</script>";
    $_SESSION['alert'] = "gagal";
    $_SESSION['pesan'] = "Anda gagal Checkout";	
}

?>