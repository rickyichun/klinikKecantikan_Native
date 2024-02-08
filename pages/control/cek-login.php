<?php 
error_reporting(0);
session_start();

$logged_in = false;

//jika session username belum dibuat, atau session username kosong
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {	
	//redirect ke halaman login
	header('location:../main/login.php?error=2');
	
} else {
	$logged_in = true;
}
?>