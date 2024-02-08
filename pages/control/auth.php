<?php

session_start();

include "basisdata.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$dat = mysqli_query($conn, "SELECT * from tb_user where username='$username' and password='$password'");
$data = mysqli_fetch_array($dat);
$cek  = mysqli_num_rows($dat);
$iduser = $data['user_id'];
$fullname = $data['fullname'];
 
if($cek > 0){
	// kalau username dan password sudah terdaftar di database
	// buat session dengan nama username dengan isi nama user yang login
   
	$_SESSION['username'] = $username;
	$_SESSION['role']  	  = $data['role'];
	$_SESSION['idpwt']    = $data['idpwt'];
	$_SESSION['user_id']  = $iduser;
	$_SESSION['fullname'] = $fullname;
	$_SESSION['cekmasuk'] = "Masukk";
	$statusmsk = $data['status'];

	//simpanLog
	$timestamp	= date('Y-m-d H:i:s');
	$keter = $fullname." melakukan login" ; 
	$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
	VALUES ('$keter','$iduser','$timestamp')");
	
	//cektgl cekin
	$tglcekin = date("Y-m-d",strtotime($data['timestamp']));
	$tglnow = date("Y-m-d");
	if($statusmsk=='checkin'){	
		if ($tglcekin==$tglnow){
			header('location:../main/dashboard.php');
			$_SESSION['checkin'] = $data['timestamp'];
		} else {
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Anda Belum Checkout Kemarin!";
				echo "<script>window.location = '../control/cekout.php'</script>";
		}
	} else {
		if ($tglcekin==$tglnow){
			echo "<script>window.location = '../main/dashboard.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Anda sudah Checkout Hari ini!";
			$_SESSION['checkin'] = "Anda Sudah Checkout";
		} else {
			echo "<script>window.location = '../main/dashboard.php'</script>";
			$_SESSION['alert'] = "checkin";
			$_SESSION['pesan'] = "Silahkan melakukan Checkin/Absen!";
			$_SESSION['checkin'] = "Anda Belum Checkin";
		}
	}	
} else {
	// kalau username ataupun password tidak terdaftar di database
	
	header('location:../main/login.php?error=1');
}
?>