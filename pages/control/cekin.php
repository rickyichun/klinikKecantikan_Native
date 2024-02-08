<?php

session_start();

include "basisdata.php";

$foto2		= $_POST['foto2'];
$foto       = $_FILES['foto']['name'];
$tmp        = $_FILES['foto']['tmp_name'];

$idus = $_SESSION['user_id'];
$tglnow = date("Y-m-d");
$fullname = $_SESSION['fullname'];
$tgljamnow =  date("Y-m-d H:i:s");
$iduser = $_SESSION['user_id'];
$timestamp	= date('Y-m-d H:i:s');

$dat = mysqli_query($conn, "SELECT * from tb_user where user_id='$idus' and status='checkin'");
$cek  = mysqli_num_rows($dat);
$dat2 = mysqli_query($conn, "SELECT * from absensi where iduser='$idus'");
$absen = "belumAbsen";
while($data2  = mysqli_fetch_array($dat2)){
	$tglabs = date("Y-m-d",strtotime($data2['waktuin']));
	if($tglnow==$tglabs){
		$absen = "Absen";
	}
}

//simpanLog
$keter = $fullname." melakkukan Checkin pada : ".$tgljamnow ; 
$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
VALUES ('$keter','$iduser','$timestamp')");

if($cek>0){
	echo "<script>window.location = '../main/dashboard.php'</script>";
	$_SESSION['alert'] = "gagal";
	$_SESSION['pesan'] = "Anda Sudah Checkin Hari ini!";
} else if($absen=='Absen') {
	echo "<script>window.location = '../main/dashboard.php'</script>";
	$_SESSION['alert'] = "gagal";
	$_SESSION['pesan'] = "Anda Sudah Checkin Hari ini!";
} else {
	$fotobaru = "abs_in_". $foto;
	$path = "../attach/absen/" . $fotobaru;

	if($foto2 == "") {
		if (move_uploaded_file($tmp, $path)) {
			$poto = $fotobaru;
		}
	} else {
		$poto = $foto2;
	}
	$query = mysqli_query($conn, "INSERT INTO absensi (iduser, waktuin, fotoin)
			VALUES ('$idus', '$datetime','$poto')");
	$dat   = mysqli_query($conn, "SELECT * from absensi ORDER BY id DESC LIMIT 1");
	$data  = mysqli_fetch_array($dat);
	$idabs = $data['id'];
	unset($_SESSION['checkin']);
	$_SESSION['checkin']=$datetime;
	$update = mysqli_query($conn, "UPDATE tb_user SET idcekin='$idabs', status='checkin' WHERE user_id='$idus'");

	if ($update) {
		echo "<script>window.location = '../main/dashboard.php'</script>";
		$_SESSION['alert'] = "berhasil";
		$_SESSION['pesan'] = "Checkin berhasil!!";
	} else {
		echo "<script>window.location = '../main/dashboard.php'</script>";
		$_SESSION['alert'] = "gagal";
		$_SESSION['pesan'] = "Checkin Gagal dimasukan!";
	}
}
?>