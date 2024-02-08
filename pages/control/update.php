<?php
include "basisdata.php";
include "cek-login.php" ;
ini_set('date.timezone', 'Asia/Jakarta');
$mode = $_GET['mode'];
$iduser = $_SESSION['user_id'];
$idpwt = $_SESSION['idpwt'];
$fullname = $_SESSION['fullname'];
$timestamp	= date('Y-m-d h:m:s');
$rolee = $_SESSION['role'];

switch ($mode) {
	case 1:
	//Upload file pernyataan
		$idtrx		 = $_POST['idtrx'];
		$foto        = $_FILES['filee']['name'];
        $tmp         = $_FILES['filee']['tmp_name'];
		$foto2        = $_FILES['filee2']['name'];
        $tmp2         = $_FILES['filee2']['tmp_name'];

		$filee = "pernya_".$idtrx."_" . $foto;
		$filee2 = "perset_".$idtrx."_" . $foto2;
        $path = "../attach/SP/" . $filee;
		$path2 = "../attach/SP/" . $filee2;
		if (move_uploaded_file($tmp, $path)) {
			if (move_uploaded_file($tmp2, $path2)) {
				$query1 = mysqli_query($conn, "UPDATE riw_trx SET filepernyataan='$filee', filepersetujuan='$filee2', tglupdate='$timestamp' WHERE id='$idtrx'");
				
				if ($query1){
					$query = mysqli_query($conn, "UPDATE riw_trx SET status='tindakan'  WHERE id='$idtrx'");
					
					echo "<script>window.location = '../transaksi/history_trx.php'</script>";
					$_SESSION['alert']="berhasil";	
					$_SESSION['pesan']="Data transaksi Berhasil dimasukan!";	
				} else {
					echo "<script>window.location = '../transaksi/history_trx'</script>";	
					$_SESSION['alert']="gagal";	
					$_SESSION['pesan']="Data transaksi Gagal dimasukan!";
				}
			}
		}else {
			echo "<script>window.history.go(-1)</script>";	
			$_SESSION['alert']="warning";	
			$_SESSION['pesan']='File '.$jf.' belum ditambahkan!';
		}
			
		break;
	
	case 2:
		//Upload selesai tindakan
			$idtrx		 = $_POST['idtrx'];
			$foto2		 = $_POST['foto2'];
			$foto        = $_FILES['foto']['name'];
			$tmp         = $_FILES['foto']['tmp_name'];
	
			$filee = "afr_". $idtrx  . $foto;
			$path = "../attach/transaksi/" . $filee;
			if($foto2 == "") {
				if (move_uploaded_file($tmp, $path)) {

					$query = mysqli_query($conn, "UPDATE riw_trx SET foto_afr='$filee', tglupdate='$timestamp' WHERE id='$idtrx'");

					if ($query) {
						echo "<script>window.location = '../transaksi/history_trx.php'</script>";
						$_SESSION['alert'] = "berhasil";
						$_SESSION['pesan'] = "Foto After Berhasil dimasukan!";
					} else {
						echo "<script>window.location = '../transaksi/history_trx.php'</script>";
						$_SESSION['alert'] = "gagal";
						$_SESSION['pesan'] = "Foto After Gagal dimasukan!";
					}
				}else{
					echo "<script>window.history.go(-1)</script>";
					$_SESSION['alert'] = "warning";
					$_SESSION['pesan'] = "Foto belum ditambahkan!";
				}
			}else{
				$query = mysqli_query($conn, "UPDATE riw_trx SET foto2_afr='$foto2', tglupdate='$timestamp' WHERE id='$idtrx'");

					if ($query) {
						echo "<script>window.location = '../transaksi/history_trx.php'</script>";
						$_SESSION['alert'] = "berhasil";
						$_SESSION['pesan'] = "Foto After Berhasil dimasukan!";
					} else {
						echo "<script>window.location = '../transaksi/history_trx.php'</script>";
						$_SESSION['alert'] = "gagal";
						$_SESSION['pesan'] = "Foto After Gagal dimasukan!";
					}
			}
				
			break;
	
	case 3:
		//update dosis paket pasien
		$idtrx    	= $_POST['idtrx'];
		$qtypkt	 	= $_POST['qty'];
		$idpkt		= $_POST['idpkt'];
		
		$qtrans	=	mysqli_query($conn, "SELECT * FROM riw_trx WHERE id='$idtrx'");
		$trans = mysqli_fetch_array($qtrans);
		$notrx	= $trans['notrx'];
		
		//cek upload file
		$qcekfile	=	mysqli_query($conn, "SELECT * FROM riw_trx WHERE filepernyataan!='' AND notrx='$notrx'");
		$cekfile = mysqli_num_rows($qcekfile);
		if($cekfile>0){
			$query = mysqli_query($conn, "UPDATE riw_trx SET qtypkt='$qtypkt', status='tindakan' WHERE id='$idtrx'");
		} else {
			$query = mysqli_query($conn, "UPDATE riw_trx SET qtypkt='$qtypkt', status='pratindakan' WHERE id='$idtrx'");
		}
			//simpanLog
			$keter = $fullname." menambahkan dosis pada transaksi ".$idtrx ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");
		
		if ($query){
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Dosis Berhasil dimasukan!";	
		} else {
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Dosis Gagal dimasukan!";	
		}
		
		break;

	case 4:
		//update jadwal cancel
		$idjdw    	= $_GET['idjdw'];

		$query = mysqli_query($conn, "UPDATE jadwal SET status='cancel' WHERE id='$idjdw'");
			//simpanLog
			$keter = $fullname." melakukan cancel jadwal pasien ".$idjdw ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			echo "<script>window.location = '../jadwal/masterjadwal.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Jadwal Berhasil dicancel!";	
		} else {
			echo "<script>window.location = '../jadwal/masterjadwal.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Jadwal Gagal dicancel!";	
		}
		
		break;

	case 5:
		//update master request
		$idreq    	= $_GET['idreq'];
		$tindakan	= $_GET['tindak'];

		if($tindakan=='aprv'){
			$query = mysqli_query($conn, "UPDATE reqbarang SET status='aprv' WHERE id='$idreq'");
		} else {
			$query = mysqli_query($conn, "UPDATE reqbarang SET status='reject' WHERE id='$idreq'");
		}
			//simpanLog
			$keter = $fullname." melakukan aprv/reject request barang ".$idreq ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			echo "<script>window.location = '../barang/masterreq.php'</script>";
			$_SESSION['alert'] = "berhasil";
			if($tindakan=='aprv'){
				$_SESSION['pesan'] = "Pengajuan barang berhasil diterima!";	
			} else {
				$_SESSION['pesan'] = "Pengajuan barang berhasil ditolak!";	
			}
			
		} else {
			echo "<script>window.location = '../barang/masterreq.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Pengajuan barang gagal diubah!";	
		}
		
		break;

	case 6:
		//update master user
		$userid     	= $_POST['userid'];
		$fullnam    	= $_POST['fullname'];
		$usernam    	= $_POST['username'];
		$role    		= $_POST['role'];

		if($_POST['password']==NULL){
			$query = mysqli_query($conn, "UPDATE tb_user SET username='$usernam', fullname='$fullnam', role='$role' WHERE user_id='$userid'");
		} else {
			$pass = md5($_POST['password']);
			$query = mysqli_query($conn, "UPDATE tb_user SET username='$usernam', fullname='$fullnam', role='$role', password='$pass' WHERE user_id='$userid'");
		}
		
			//simpanLog
			$keter = $fullname." melakukan edit user ".$usernam ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			
			$_SESSION['alert'] = "berhasil";
			if($_SESSION['role']=='admin'){
				$_SESSION['pesan'] = "Data $fullnam berhasil dirubah!";
				echo "<script>window.location = '../user/masterusr.php'</script>";	
			} else {
				$_SESSION['pesan'] = "Data user anda berhasil dirubah! Silahkan melakukan Login Ulang";	
				echo "<script>window.location = '../control/logout.php'</script>";
			}
			
		} else {
			echo "<script>window.location = '../main/dashboard.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data user gagal diubah!";	
		}
		
		break;
	
	case 7:
		//update master marketing
		$ide	    = $_POST['ide'];
		$nama    	= $_POST['nama'];
		$jk	 		= $_POST['jk'];
		$tempatlhr	= $_POST['tempatlhr'];
		$tgllahir	= $_POST['tgllahir'];
		$alamat		= $_POST['alamat'];
		$notlp		= $_POST['notlp'];

		$query = mysqli_query($conn, "UPDATE marketing SET nama='$nama', jeniskelamin='$jk', alamat='$alamat', tempatlahir='$tempatlhr', tgllahir='$tgllahir', notlp='$notlp', tglupdate='$timestamp' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit marketing ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data marketing berhasil dirubah!";	
			echo "<script>window.location = '../marketing/mastermkt.php'</script>";
			
		} else {
			echo "<script>window.location = '../marketing/mastermkt.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data marketing gagal diubah!";	
		}
		
		break;

	case 8:
		//update master perawat
		$ide	    = $_POST['ide'];
		$nama    	= $_POST['nama'];
		$jk	 		= $_POST['jk'];
		$tempatlhr	= $_POST['tempatlhr'];
		$tgllahir	= $_POST['tgllahir'];
		$alamat		= $_POST['alamat'];
		$notlp		= $_POST['notlp'];
		$jabatan	= $_POST['jabatan'];

		$query = mysqli_query($conn, "UPDATE perawat SET namapwt='$nama', jeniskelamin='$jk', alamat='$alamat', tempatlahir='$tempatlhr', tgllahir='$tgllahir', notlp='$notlp', idjab='$jabatan', tglupdate='$timestamp' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit data perawat ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data perawat berhasil dirubah!";	
			echo "<script>window.location = '../perawat/masterpwt.php'</script>";
			
		} else {
			echo "<script>window.location = '../perawat/masterpwt.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data perawat gagal diubah!";	
		}
		
		break;

	case 9:
		//update master dokter
		$ide	    = $_POST['ide'];
		$nama    	= $_POST['nama'];
		$jk	 		= $_POST['jk'];
		$tempatlhr	= $_POST['tempatlhr'];
		$tgllahir	= $_POST['tgllahir'];
		$alamat		= $_POST['alamat'];
		$notlp		= $_POST['notlp'];

		$query = mysqli_query($conn, "UPDATE dokter SET namadktr='$nama', jeniskelamin='$jk', alamat='$alamat', tempatlahir='$tempatlhr', tgllahir='$tgllahir', notlp='$notlp', tglupdate='$timestamp' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit data Dokter ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data dokter berhasil dirubah!";	
			echo "<script>window.location = '../perawat/masterdktr.php'</script>";
			
		} else {
			echo "<script>window.location = '../perawat/masterdktr.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data dokter gagal diubah!";	
		}
		
		break;

	case 10:
		//update master pasien
		$ide	    = $_POST['ide'];
		$nama    	= $_POST['nama'];
		$noktp    	= $_POST['noktp'];
		$jk	 		= $_POST['jk'];
		$tempatlhr	= $_POST['tempatlhr'];
		$tgllahir	= $_POST['tgllahir'];
		$alamat		= $_POST['alamat'];
		$notlp		= $_POST['notlp'];

		$query = mysqli_query($conn, "UPDATE pasien SET nama='$nama', noktp='$noktp', jeniskelamin='$jk', alamat='$alamat', tempatlahir='$tempatlhr', tgllahir='$tgllahir', notlp='$notlp', tglupdate='$timestamp' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit data Pasien ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data pasien berhasil dirubah!";	
			echo "<script>window.location = '../pasien/masterpasien.php'</script>";
			
		} else {
			echo "<script>window.location = '../pasien/masterpasien.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data pasien gagal diubah!";	
		}
		
		break;
	
	case 11:
		//update master barang
		$ide	    = $_POST['ide'];
		$nama    	= $_POST['nama'];
		$satuan	 	= $_POST['satuan'];
		$minstok	= $_POST['minstok'];
		$ket		= $_POST['ket'];
		$stok		= $_POST['stok'];

		$query = mysqli_query($conn, "UPDATE m_barang SET namabrg='$nama', satuan='$satuan', stok='$stok', minstok='$minstok', ket='$ket', tglupdate='$timestamp' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit data barang ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data barang berhasil dirubah!";	
			echo "<script>window.location = '../barang/masterbrg.php'</script>";
			
		} else {
			echo "<script>window.location = '../barang/masterbrg.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data barang gagal diubah!";	
		}
		
		break;
	
	case 12:
		//update master jabata
		$ide	    = $_POST['ide'];
		$nama    	= $_POST['nama'];
		$gapok	 	= $_POST['gapok'];
		$lembur	 	= $_POST['lembur'];
		
		$query = mysqli_query($conn, "UPDATE jabatan SET namajab='$nama', gapok='$gapok', lembur='$lembur' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit data jabatan ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data jabatan berhasil dirubah!";	
			echo "<script>window.location = '../perawat/masterjabatan.php'</script>";
			
		} else {
			echo "<script>window.location = '../perawat/masterjabatan.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data jabatan gagal diubah!";	
		}
		
		break;

	case 13:
		//update master paket
		$ide	   		= $_POST['ide'];
		$nama    		= $_POST['nama'];
		$jp	 			= $_POST['jp'];
		$satuan	 		= $_POST['satuan'];
		$harga	 		= $_POST['harga'];
		$jenis	 		= $_POST['jenis'];
		$basic	 		= $_POST['basic'];
		
		$query = mysqli_query($conn, "UPDATE namapkt SET namapkt='$nama', jenispkt='$jp', satuan='$satuan', harga='$harga', idbasic='$basic', idjenis='$jenis' WHERE id='$ide'");
		
			//simpanLog
			$keter = $fullname." melakukan edit data jabatan ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data paket berhasil dirubah!";	
			echo "<script>window.location = '../paket/masterpkt.php'</script>";
			
		} else {
			echo "<script>window.location = '../paket/masterpkt.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data paket gagal diubah!";	
		}
		
		break;

	case 14:
		//update detail paket
		$idpkt	   			= $_POST['idpkt'];
		$iddetpkt	   		= $_POST['iddetpkt'];
		$barang    			= $_POST['barang'];
		$qty	 			= $_POST['qty'];
		$keterangan	 		= $_POST['keterangan'];
		
		$query = mysqli_query($conn, "UPDATE detailpkt SET idbrg='$barang', qty='$qty', idpkt='$idpkt', ket='$keterangan' WHERE id='$iddetpkt'");
		
			//simpanLog
			$keter = $fullname." melakukan edit Detail Paket ".$barang ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data Detail paket berhasil dirubah!";	
			echo "<script>window.location = '../paket/inputdetpkt.php?idpkt=$idpkt'</script>";
			
		} else {
			echo "<script>window.location = '../paket/masterpkt.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data Detail paket gagal diubah!";	
		}
		
		break;

	case 15:
		//update SOAP
		$keluhan	= $_POST['keluhan'];
		$tensi	   	= $_POST['tensi'];
		$idtrx    	= $_POST['idtrx'];
		$idpwttrx 	= $_POST['idpwt'];

		if(($idpwttrx!=$idpwt)AND($rolee!='admin')){
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Anda bukan perawat yg ditunjuk!";
		}else {
			$query = mysqli_query($conn, "UPDATE riw_trx SET keluhan='$keluhan', tensi='$tensi' WHERE id='$idtrx'");
			
				//simpanLog
				$keter = $fullname." melakukan tambah data keluhan dan tensi ".$idtrx ; 
				$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
				VALUES ('', '$keter','$iduser','$timestamp')");
			
			if ($query){
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Data Detail Keluhan berhasil dirubah!";	
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				
			} else {
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Data Detail Keluhan gagal diubah!";	
			}
		}
		
		break;

	case 16:
		//update jenis paket
		$idjns	   = $_POST['idjns'];
		$nama	   = $_POST['nama'];
		$komisi    = $_POST['komisi'];
		
		$query = mysqli_query($conn, "UPDATE jenispkt SET namajenis='$nama', komisi='$komisi' WHERE id='$idjns'");
		
			//simpanLog
			$keter = $fullname." melakukan edit jenis paket ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (id, keterangan, iduser, tanggal)
			VALUES ('', '$keter','$iduser','$timestamp')");
		
		if ($query){
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data jenis paket berhasil dirubah!";	
			echo "<script>window.location = '../paket/masterjnspkt.php'</script>";
			
		} else {
			echo "<script>window.location = '../paket/masterjnspkt.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data jenis paket gagal diubah!";	
		}
		
		break;
		
	case 17:
	//Hapus Checkout Absen
		$idabs	= $_GET['idabs'];
		$query	= mysqli_query($conn, "UPDATE absensi SET waktuout='0000-00-00 00:00:00' WHERE id='$idabs'");

		//simpanLog
		$keter = $fullname." melakkukan Hapus Absensi ID Absen = ".$idabs ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");
		
		if ($query){
			echo "<script>window.location = '../user/absensi.php'</script>";
			$_SESSION['alert']="berhasil";	
			$_SESSION['pesan']="Data Checkout Berhasil dihapus!";	
		} else {
			echo "<script>window.location = '../user/absensi.php'</script>";	
			$_SESSION['alert']="gagal";	
			$_SESSION['pesan']="Data Absen Gagal dihapus!";
		}	
		break;

	case 18:
		//Upload TTD
		$folderPath = "../attach/ttd/";
		$idtrx = $_POST['idtrx'];
		
		if(empty($_POST['signed'])){
			echo "Kosong";
		} else {
			$image_parts = explode(";base64,", $_POST['signed']); 
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			$file = $folderPath . uniqid() . '.'.$image_type;
			$namafile = uniqid() . '.'.$image_type;
			file_put_contents($file, $image_base64);
			// echo $namafile;
			$query = mysqli_query($conn, "UPDATE riw_trx SET filepernyataan='$file', filepersetujuan='$file' WHERE id='$idtrx'");
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";	
			$_SESSION['alert']="berhasil";	
			$_SESSION['pesan']="TTD Berhasil ditambahkan!";
		}		
		break;
	
	case 19:
		//lanjut tindakan
		$idtrx = $_GET['idtrx'];
		
		$query = mysqli_query($conn, "UPDATE riw_trx SET status='tindakan'  WHERE id='$idtrx'");
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";	
			$_SESSION['alert']="berhasil";	
			$_SESSION['pesan']="Berhasil lanjut tindakan!";

		break;
	
	case 20 :
		//ganti paket
		$idtrx		= $_POST['idtrx'];
		$idpwt		= $_POST['perawat'];
		$idpkt    	= $_POST['paket'];
			//ambildata TRX 
			$query2        = mysqli_query($conn, "SELECT * FROM riw_trx WHERE id='$idtrx'");
			$datah         = mysqli_fetch_array($query2);

		$notrx   	= $datah['notrx'];
		$idjdwl    	= $datah['idjdwl'];
		$idpas    	= $datah['idpasien'];
		$tgl    	= $datah['tgl'];
		$iddktr    	= $datah['iddktr'];
		$iduser    	= $datah['iduser'];
		$fotobfr   	= $datah['foto_bfr'];
		$foto2bfr  	= $datah['foto2_bfr'];

		if($idpkt==46) {
			$setatus = 'tindakan';
		} else {
			$setatus = 'pemeriksaan';
		}
		// $query = mysqli_query($conn, "INSERT INTO riw_trx (notrx, idjdwl, idpasien, tgl, idpkt, idpwt, iddktr, iduser, foto_bfr, foto2_bfr, status, tglupdate) VALUES ('$notrx', '$idjdwl', '$idpas', '$tgl', '$idpkt', '$idpwt', '$iddktr', '$iduser', '$fotobfr', '$foto2bfr', '$setatus', '$timestamp')");
		$query = mysqli_query($conn, "UPDATE riw_trx SET idpkt='$idpkt', idpwt='$idpwt'  WHERE id='$idtrx'");
		
		//simpanLog
		$keter = $fullname." merubah paket " .$notrx. " pada transaksi ".$notrx ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");		

		if ($query){
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Ganti paket Berhasil!";	
		} else {
			echo "<script>window.location = ../transaksi/history_trx.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Ganti paket Gagal!";	
		}
	
		break;

	
}
?>