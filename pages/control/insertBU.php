	<?php
include "basisdata.php";
include "cek-login.php" ;
ini_set('date.timezone', 'Asia/Jakarta');
date_default_timezone_set('Asia/Jakarta');
$mode = $_GET['mode'];
$iduser = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$timestamp	= date('Y-m-d H:i:s');

switch ($mode) {
	case 1:
		//insert master pasien
			$nama    	= $_POST['nama'];
			$noktp		= $_POST['noktp'];
			$jk	 		= $_POST['jk'];
			$tempatlhr	= $_POST['tempatlhr'];
			$tgllahir	= $_POST['tgllahir'];
			$alamat		= $_POST['alamat'];
			$notlp		= $_POST['notlp'];
			$foto2		= $_POST['foto2'];
			$noktp		= $_POST['noktp'];
			
			if($foto2 == "") {
				$foto        = $_FILES['foto']['name'];
				$tmp         = $_FILES['foto']['tmp_name'];

				$fotobaru = date('dmyHi') . $foto;
				$path = "../attach/foto/" . $fotobaru;
				if (move_uploaded_file($tmp, $path)) {
					//upload FOTO
					$query = mysqli_query($conn, "INSERT INTO pasien (nama, noktp, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idadmin, tglupdate, foto, foto2)
							VALUES ('$nama', '$noktp', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$iduser', '$timestamp','$fotobaru','')");

					//simpanLog
					$keter = $fullname." menambahkan pasien BARU ".$nama ;
					$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
							VALUES ('$keter','$iduser','$timestamp')");
					
					if ($query) {
						$tampil1=mysqli_query($conn, "SELECT * from pasien ORDER BY id DESC LIMIT 1");
						$data1=mysqli_fetch_array($tampil1);
						$idpas = $data1['id'];

						if(isset($_POST['idjdwl'])) {
							$idjdwl=$_POST['idjdwl'];
							$updatestat = mysqli_query($conn, "UPDATE jadwal SET status='proses' WHERE id='$idjdwl'");
							echo "<script>window.location = '../transaksi/inputtrxpasien.php?idpas=$idpas&idjdwl=$idjdwl'</script>";
							$_SESSION['alert']="berhasil";
							$_SESSION['pesan']="Data pasien Berhasil dimasukan!";
						} else {
							echo "<script>window.location = '../transaksi/inputtrxpasien.php?idpas=$idpas&idjdwl='</script>";
							$_SESSION['alert']="berhasil";
							$_SESSION['pesan']="Data pasien Berhasil dimasukan!";
						}
						
					} else {
						echo "<script>; window.location = '../pasien/masterpasien.php'</script>";
						$_SESSION['alert']="gagal";
						$_SESSION['pesan']="Data pasien Gagal dimasukan!";
					}
				} else{
					//Tanpa Foto
					$query = mysqli_query($conn, "INSERT INTO pasien (nama, noktp, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idadmin, tglupdate, foto, foto2)
							VALUES ('$nama', '$noktp', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$iduser', '$timestamp','','')");

					//simpanLog
					$keter = $fullname." menambahkan pasien BARU ".$nama ;
					$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
							VALUES ('$keter','$iduser','$timestamp')");

					if ($query) {
						$tampil1=mysqli_query($conn, "SELECT * from pasien ORDER BY id DESC LIMIT 1");
						$data1=mysqli_fetch_array($tampil1);
						$idpas = $data1['id'];

						if(isset($_POST['idjdwl'])) {
							$idjdwl=$_POST['idjdwl'];
							$updatestat = mysqli_query($conn, "UPDATE jadwal SET status='proses' WHERE id='$idjdwl'");
							echo "<script>window.location = '../transaksi/inputtrxpasien.php?idpas=$idpas&idjdwl=$idjdwl'</script>";
							$_SESSION['alert']="berhasil";
							$_SESSION['pesan']="Data pasien Berhasil dimasukan!";
						} else {
							echo "<script>window.location = '../transaksi/inputtrxpasien.php?idpas=$idpas&idjdwl='</script>";
							$_SESSION['alert']="berhasil";
							$_SESSION['pesan']="Data pasien Berhasil dimasukan!";
						}
					} else {
						echo "<script>window.location = '../pasien/masterpasien.php'</script>";
						$_SESSION['alert']="gagal";
						$_SESSION['pesan']="Data pasien Gagal dimasukan!";
					}
				}
			} else{
				//Foto dari kamera
				$query = mysqli_query($conn, "INSERT INTO pasien (nama, noktp jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idadmin, tglupdate, foto, foto2)
					VALUES ('$nama', '$noktp', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$iduser', '$timestamp', '', '$foto2')");

					//simpanLog
					$keter = $fullname." menambahkan pasien BARU ".$nama ; 
					$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
					VALUES ('$keter','$iduser','$timestamp')");
					
					if ($query){
						$tampil1=mysqli_query($conn, "SELECT * from pasien ORDER BY id DESC LIMIT 1");
						$data1=mysqli_fetch_array($tampil1);
						$idpas = $data1['id'];

						if(isset($_POST['idjdwl'])) {
							$idjdwl=$_POST['idjdwl'];
							$updatestat = mysqli_query($conn, "UPDATE jadwal SET status='proses' WHERE id='$idjdwl'");
							echo "<script>window.location = '../transaksi/inputtrxpasien.php?idpas=$idpas&idjdwl=$idjdwl'</script>";
							$_SESSION['alert']="berhasil";
							$_SESSION['pesan']="Data pasien Berhasil dimasukan!";
						} else {
							echo "<script>window.location = '../transaksi/inputtrxpasien.php?idpas=$idpas&idjdwl='</script>";
							$_SESSION['alert']="berhasil";
							$_SESSION['pesan']="Data pasien Berhasil dimasukan!";
						}
					} else {
						echo "<script>window.location = '../pasien/masterpasien.php'</script>";	
						$_SESSION['alert']="gagal";
						$_SESSION['pesan']="Data pasien Gagal dimasukan!";
					}
			}
			
		break;

	case 2:
		//insert Riwayat pasien
			$idpas    	= $_POST['idpas'];
			$riwayat	= $_POST['riwayat'];
			$foto2		= $_POST['foto2'];
			$foto        = $_FILES['foto']['name'];
			$tmp         = $_FILES['foto']['tmp_name'];
			$fotobaru = date('dmyHi') . $foto;
			$path = "../attach/fotoriw/" . $fotobaru;
			//choose file
			if($foto2 == "") {
				//upload foto
				if (move_uploaded_file($tmp, $path)) {
					$query = mysqli_query($conn, "INSERT INTO riw_pasien (idpasien, deskripsi, file,foto, jenis, tglupdate)
					VALUES ('$idpas', '$riwayat', '$fotobaru','', 'lama', '$timestamp')");
					//simpanLog
					$keter = $fullname." menambahkan riwayat pasien BARU id=".$idpas ;
					$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
					VALUES ('$keter','$iduser','$timestamp')");
					if ($query) {
						echo "<script>window.location = '../pasien/detailpasien.php?idpasien=$idpas'</script>";
						$_SESSION['alert'] = "berhasil";
						$_SESSION['pesan'] = "Data pasien Berhasil dimasukan!";
					} else {
						echo "<script>window.location = '../pasien/detailpasien.php?idpasien=$idpas'</script>";
						$_SESSION['alert'] = "gagal";
						$_SESSION['pesan'] = "Data pasien Gagal dimasukan!";
					}
				}
				//tanpa foto
				else {
					echo "<script>window.history.go(-2)</script>";
					$_SESSION['alert'] = "berhasil";
					$_SESSION['pesan'] = "Berhasil disimpan, tanpa menambahkan foto!";
					$query = mysqli_query($conn, "INSERT INTO riw_pasien (idpasien, deskripsi, file,foto, jenis, tglupdate)
					VALUES ('$idpas', '$riwayat', '','', 'lama', '$timestamp')");
				}
			}
			//Foto dari kamera
			else{
				$query = mysqli_query($conn, "INSERT INTO riw_pasien (idpasien, deskripsi, file,foto, jenis, tglupdate)
						VALUES ('$idpas', '$riwayat', '','$foto2', 'lama', '$timestamp')");
						//simpanLog
						$keter = $fullname." menambahkan riwayat pasien BARU id=".$idpas ;
						$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
						VALUES ('$keter','$iduser','$timestamp')");
						if ($query) {
							echo "<script>window.location = '../pasien/detailpasien.php?idpasien=$idpas'</script>";
							$_SESSION['alert'] = "berhasil";
							$_SESSION['pesan'] = "Data pasien Berhasil dimasukan!";
						} else {
							echo "<script>window.location = '../pasien/detailpasien.php?idpasien=$idpas'</script>";
							$_SESSION['alert'] = "gagal";
							$_SESSION['pesan'] = "Data pasien Gagal dimasukan!";
						}
			}
			
				
			break;

	case 3:
		//insert master perawat
		$nama    	= $_POST['nama'];
		$jk	 		= $_POST['jk'];
		$tempatlhr	= $_POST['tempatlhr'];
		$tgllahir	= $_POST['tgllahir'];
		$alamat		= $_POST['alamat'];
		$notlp		= $_POST['notlp'];
		$jabatan	= $_POST['jabatan'];
		
		$query = mysqli_query($conn, "INSERT INTO perawat (namapwt, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idjab, tglupdate)
		VALUES ('$nama', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$jabatan', '$timestamp')");

		//simpanLog
		$keter = $fullname." menambahkan perawat BARU ".$nama ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");
		
		if ($query){
			$qperawat = mysqli_query($conn, "SELECT * from perawat order by id desc LIMIT 1");
			$perawat  = mysqli_fetch_array($qperawat);
			$idp = $perawat['id'];
			echo "<script>window.location = '../user/tambahusr.php?name=$nama&idp=$idp'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data perawat Berhasil dimasukan! Tamabahkan Sebagai User";	
		} else {
			echo "<script>window.location = '../perawat/inputpwt.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data perawat Gagal dimasukan!";	
		}
			
		break;

	case 4:
		//insert paket
		$nama    	= $_POST['nama'];
		$jp	 		= $_POST['jp'];
		$satuan	 	= $_POST['satuan'];
		$harga	 	= $_POST['harga'];
		$ket 		= $_POST['ket'];
		$jenis 		= $_POST['jenis'];
		$basic 		= $_POST['basic'];
		
		$query = mysqli_query($conn, "INSERT INTO namapkt (namapkt, jenispkt, satuan, harga, idjenis, idbasic, ket, tglupdate)
		VALUES ('$nama', '$jp', '$satuan', '$harga', '$jenis', '$basic', '$ket', '$timestamp')");

		//simpanLog
		$keter = $fullname." menambahkan paket BARU ".$nama ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");
		
		if($cek>0) {
			echo "<script>window.location = '../paket/masterpkt.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Nama paket sudah pernah dimasukan!";	
		} else {
			$query = mysqli_query($conn, "INSERT INTO namapkt (namapkt, jenispkt, satuan, harga, idjenis, idbasic, ket, tglupdate)
			VALUES ('$nama', '$jp', '$satuan', '$harga', '$jenis', '$basic', '$ket', '$timestamp')");

			//simpanLog
			$keter = $fullname." menambahkan paket BARU ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");
			
			if ($query){
				//ambil idpkt terbaru
				$tampil1 = mysqli_query($conn, "SELECT * from namapkt WHERE namapkt='$nama'");
				$data1   = mysqli_fetch_array($tampil1);
				$idpkt	 = $data1['id']; 
				echo "<script>window.location = '../paket/inputdetpkt.php?idpkt=$idpkt'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Data paket Berhasil dimasukan!";	
			} else {
				echo "<script>window.location = '../paket/masterpkt.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Data paket Gagal dimasukan!";	
			}
		}
			
		break;
	
	case 5:
		//insert detail paket
		$idpkt    	= $_POST['idpkt'];
		$idbrg	 	= $_POST['barang'];
		$qty		= $_POST['qty'];
		$ket		= $_POST['keterangan'];

		$cek = mysqli_query($conn,"SELECT * FROM detailpkt where idpkt='$idpkt' and idbrg='$idbrg'");
		if(mysqli_num_rows($cek) < 1) {
			$query = mysqli_query($conn, "INSERT INTO detailpkt (idpkt, idbrg, qty, ket)
				VALUES ('$idpkt', '$idbrg', '$qty', '$ket')");

			//simpanLog
			$keter = $fullname." menambahkan detailpaket pada paket ".$idpkt ;
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
				VALUES ('$keter','$iduser','$timestamp')");

			if ($query) {
				echo "<script>window.location = '../paket/inputdetpkt.php?idpkt=$idpkt'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Data detail paket Berhasil dimasukan!";
			} else {
				echo "<script>window.location = '../paket/masterpkt.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Data detail paket Gagal dimasukan!";
			}
		}else{
			echo "<script>window.history.go(-1)</script>";
				$_SESSION['alert'] = "warning";
				$_SESSION['pesan'] = "Barang sudah ada di dalam paket!";
		}
			
		break;
	
	case 6:
		//insert barang baru
		$nama    	= $_POST['nama'];
		$satuan	 	= $_POST['satuan'];
		$stok		= $_POST['stok'];
		// $harga		= $_POST['harga'];
		$minstok	= $_POST['minstok'];
		$ket		= $_POST['ket'];
		
		//Cek nama sama
		$query3       = mysqli_query($conn, "SELECT * FROM m_barang WHERE namabrg='$nama'");
		$ceknama      = mysqli_num_rows($query3);
		if($ceknama > 0){
			echo "<script>window.location = '../barang/masterbrg.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Nama barang sudah ada!";	
		} else {
			$query = mysqli_query($conn, "INSERT INTO m_barang (namabrg, satuan, stok, minstok, tglupdate, ket)
			VALUES ('$nama', '$satuan', '$stok', '$minstok', '$timestamp', '$ket')");

			//simpanLog
			$keter = $fullname." menambahkan barang  baru dengan nama ".$nama ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");
			
			if ($query){
				echo "<script>window.location = '../barang/masterbrg.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Data barang Berhasil dimasukan!";	
			} else {
				echo "<script>window.location = '../barang/masterbrg.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Data barang Gagal dimasukan!";	
			}
		}
			
		break;
	
	case 7:
		//insert transaksi
		$pasien    	= $_POST['pasien'];
		$paket	 	= $_POST['paket'];
		$perawat	= $_POST['perawat'];
		$tanggal	= $_POST['tgltrx'];
		$dokter		= $_POST['dokter'];
		$foto2		= $_POST['foto2'];
		$foto       = $_FILES['foto']['name'];
		$tmp        = $_FILES['foto']['tmp_name'];
		$idjdwl		= $_POST['idjdwl'];

		if($idjdwl!=0){
			$updatestat = mysqli_query($conn, "UPDATE jadwal SET status='proses' WHERE id='$idjdwl'");
		}

			//membuat no transaksi
			$query2        = mysqli_query($conn, "SELECT * FROM riw_trx ORDER BY id DESC LIMIT 1");
			$datah         = mysqli_fetch_array($query2);
			$noLm          = $datah['notrx'];
			$bln           = date('m');
			$thn           = date('y');
			$tgl           = sprintf("%02s", date('d'));
			$blnTkt        = sprintf("%02s", (int) substr($noLm, 3, 2));
			$ThnTkt        = sprintf("%02s", (int) substr($noLm, 0, 2));
				if ($blnTkt == $bln && $ThnTkt == $thn) {
					$noU       = (int) substr($noLm, 9, 3);
				} else {
					$noU       = 0;
				}
			$noUrut        = (int) $noU + 1;
			$notrx         = $thn."-". $bln .$tgl."-".sprintf("%03s", $noUrut);

			//Cek no invoice Double
			$query3        = mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx'");
			$ceknoinv      = mysqli_num_rows($query3);
			if($ceknoinv > 0){
				$noSama = $noUrut+1;
				$notrx = $thn."-". $bln .$tgl."-".sprintf("%03s", $noSama); 
			}
			
		//rename foto	
		$fotobaru = "bfr_". $notrx . $foto;
		$path = "../attach/transaksi/" . $fotobaru;

		if($foto2 == "") {
			if (move_uploaded_file($tmp, $path)) {
				$query = mysqli_query($conn, "INSERT INTO riw_trx (notrx, idjdwl, idpasien, tgl, idpkt, idpwt, iddktr, iduser, foto_bfr, foto2_bfr, status, tglupdate)
					VALUES ('$notrx', '$idjdwl', '$pasien', '$tanggal', '$paket', '$perawat', '$dokter', '$iduser','$fotobaru','', 'pemeriksaan', '$timestamp')");
					//simpanLog
			$keter = $fullname." menambahkan transaksi baru dengan notrx ".$notrx ;
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
					VALUES ('$keter','$iduser','$timestamp')");

			if ($query) {
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Transaksi Berhasil dimasukan!";
			} else {
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Transaksi Gagal dimasukan!";
				// echo $paket;
			}
			}else{
				echo "<script>window.history.go(-1)</script>";
					$_SESSION['alert'] = "warning";
					$_SESSION['pesan'] = "Foto belum ditambahkan!";
			}
		}else{
			$query = mysqli_query($conn, "INSERT INTO riw_trx (notrx, idjdwl, idpasien, tgl, idpkt, idpwt,  iddktr, iduser, foto_bfr,foto2_bfr, status, tglupdate)
							VALUES ('$notrx', '$idjdwl', '$pasien', '$tanggal', '$paket', '$perawat', '$dokter',  '$iduser', '','$foto2', 'pemeriksaan', '$timestamp')");
			//simpanLog
			$keter = $fullname." menambahkan transaksi baru dengan notrx ".$notrx ;
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
							VALUES ('$keter','$iduser','$timestamp')");

			if ($query) {
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Transaksi Berhasil dimasukan!";
			} else {
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Transaksi Gagal dimasukan!";
				// echo $paket;
			}
		}
		break;		
	case 8:
		//insert selesai transaksi
		$idtrx    	= $_GET['idtrx'];

		$qtrans	=	mysqli_query($conn, "SELECT * FROM riw_trx WHERE id='$idtrx'");
		$trans = mysqli_fetch_array($qtrans);
		$notrx = $trans['notrx'];

		$query2     = mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx'");
		$datah      = mysqli_fetch_array($query2);
		$qcekfoto  =  mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx' AND (foto_afr!='' OR foto2_afr!='')");
        $cekfoto   =  mysqli_num_rows($qcekfoto);
		if ($cekfoto==0) {
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Foto Selesai Tindakan belum di tambahkan";

		} else {
			$idpaket	= $datah['idpkt'];
			$qtypkt 	= $datah['qtypkt'];
			$notrx 		= $datah['notrx'];
			$tgltrx 	= $datah['tgl'];
				$qpaket     = mysqli_query($conn, "SELECT * FROM namapkt WHERE id='$idpaket'");
				$paket      = mysqli_fetch_array($qpaket);
				$hargapkt	= $paket['harga'];

			
			$query = mysqli_query($conn, "UPDATE riw_trx SET status='slse_tindakan', tglupdate='$timestamp' WHERE id='$idtrx'");
				
			//simpanLog
				$keter = $fullname." menyelesaikan perawatan dengan idtrx ".$idtrx ; 
				$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
				VALUES ('$keter','$iduser','$timestamp')");

			if ($query){
				echo "<script>window.location = '../transaksi/history_trx.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Perawatan Berhasil diselesaikan!";
			} else {
				echo "<script>window.location = '../transaksi/history_trx'</script>";
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Perawatan Gagal diselesaikan!";	
			}
		}
		
		break;

	case 9:
		//insert jadwal
		$idpas    	= $_POST['idpas'];
		$nama    	= $_POST['nama'];
		$tgldatang  = $_POST['tgldtg'];
		$mkt    	= $_POST['mkt'];
		$dp    		= $_POST['dp'];

			//membuat no Booking
			$query2        = mysqli_query($conn, "SELECT * FROM jadwal ORDER BY id DESC LIMIT 1");
			$datah         = mysqli_fetch_array($query2);
			$cekk          = mysqli_num_rows($query2);
			$bln           = date('m');
			$thn           = date('y');
			$noLm          = $datah['nobook'];
				if ($cekk>0) {
					$noU      = sprintf("%04s", (int) substr($noLm, 3, 4));
				} else {
					$noU      = 0;
				}
			$noUrut        = (int) $noU + 1;
			$notrx         = "B-".sprintf("%04s", $noUrut);
			//Cek no booking Double
			$query3        = mysqli_query($conn, "SELECT * FROM jadwal WHERE nobook='$notrx'");
			$ceknoinv      = mysqli_num_rows($query3);
			if($ceknoinv > 0){
				$noSama = $noUrut+1;
				$notrx  = "B-".sprintf("%04s", $noSama);
			}
		
		$query = mysqli_query($conn, "INSERT INTO jadwal (nobook, tgl, nama, idpasien, idmkt, status, dp, tglupdate) 
		VALUES ('$notrx','$tgldatang','$nama', '$idpas','$mkt','booked', '$dp','$timestamp')");
		//simpanLog
		$keter = $fullname." menambahkan transaksi baru dengan notrx ".$notrx ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");

		if ($query){
			echo "<script>window.location = '../jadwal/masterjadwal.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Booking jadwal Berhasil diselesaikan!";	
		} else {
			echo "<script>window.location = '../jadwal/masterjadwal.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Booking jadwal Gagal diselesaikan!";	
		}
		
		break;
	
	case 10:
		//insert QTY barang masuk
		$tgltrx    	= $_POST['tgl'];
		$idbrg	 	= $_POST['idbrg'];
		$qty		= $_POST['qty'];
		$ket		= $_POST['ket'];
		$noreq		= $_POST['noreq'];
		$iduser		= $_POST['iduser'];
		
			// datastok
			$query2        = mysqli_query($conn, "SELECT * FROM m_barang WHERE id='$idbrg'");
			$datah         = mysqli_fetch_array($query2);
			$stok		   = $datah['stok'];
			$stokakhr	   = $stok + $qty;
		
		$query = mysqli_query($conn, "INSERT INTO riw_qtymasuk (noreq, tgltrx, idbarang, qtyin, ket, iduser, tglupdate)
		VALUES ('$noreq', '$tgltrx', '$idbrg', '$qty', '$ket', '$iduser', '$timestamp')");
		$query3 = mysqli_query($conn, "UPDATE m_barang SET stok='$stokakhr', tglupdate='$timestamp' WHERE id='$idbrg'");
		
		if($noreq!='tnp_request'){
			$query4 = mysqli_query($conn, "UPDATE reqbarang SET status='done_qty', tglupdate='$timestamp' WHERE noreq='$noreq'");
		}
		
		//simpanLog
		$keter = $fullname." menambahkan qty barang masuk pada barang ".$datah['namabrg']." sejumlah".$qty ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");
		
		if ($query){
			if($_SESSION['role']=='kasir'){
				echo "<script>window.location = '../barang/masterreq.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Qty Barang masuk Berhasil! Silahkan cari request lain!";	
			} else {
				echo "<script>window.location = '../barang/brgmsuk.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Qty Barang masuk Berhasil dimasukan!";
			}	
		} else {
			echo "<script>window.location = '../barang/masterbrg.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Qty Barang masuk Gagal dimasukan!";	
		}
			
		break;
	
	case 11:
		//insert master marketing
			$nama    	= $_POST['nama'];
			$jk	 		= $_POST['jk'];
			$tempatlhr	= $_POST['tempatlhr'];
			$tgllahir	= $_POST['tgllahir'];
			$alamat		= $_POST['alamat'];
			$notlp		= $_POST['notlp'];
			$foto2		= $_POST['foto2'];
		if($foto2 == "") {
			$foto        = $_FILES['foto']['name'];
			$tmp         = $_FILES['foto']['tmp_name'];

			$fotobaru = "MKT".date('dmyHi') . $foto;
			$path = "../attach/foto/" . $fotobaru;
			if (move_uploaded_file($tmp, $path)) {
				$query = mysqli_query($conn, "INSERT INTO marketing (nama, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idadmin, tglupdate, foto, foto2)
						VALUES ('$nama', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$iduser', '$timestamp','$fotobaru','')");

				//simpanLog
				$keter = $fullname." menambahkan marketing BARU ".$nama ;
				$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
						VALUES ('$keter','$iduser','$timestamp')");

				if ($query) {
					echo "<script>alert('Data marketing Berhasil dimasukan!'); window.location = '../marketing/mastermkt.php'</script>";
					$_SESSION['alert'] = "berhasil";
					$_SESSION['pesan'] = "Data marketing Berhasil dimasukan!";
				} else {
					echo "<script>alert('Data marketing Gagal dimasukan!'); window.location = '../marketing/mastermkt.php'</script>";
					$_SESSION['alert'] = "gagal";
					$_SESSION['pesan'] = "Data marketing Gagal dimasukan!";
				}
			}else{
				$query = mysqli_query($conn, "INSERT INTO marketing (nama, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idadmin, tglupdate, foto, foto2)
						VALUES ('$nama', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$iduser', '$timestamp','','')");

				//simpanLog
				$keter = $fullname." menambahkan marketing BARU ".$nama ;
				$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
						VALUES ('$keter','$iduser','$timestamp')");

				if ($query) {
					echo "<script>window.location = '../marketing/mastermkt.php'</script>";
					$_SESSION['alert'] = "berhasil";
					$_SESSION['pesan'] = "Data marketing Berhasil dimasukan!";
				} else {
					echo "<script>window.location = '../marketing/mastermkt.php'</script>";
					$_SESSION['alert'] = "gagal";
					$_SESSION['pesan'] = "Data marketing Gagal dimasukan!";
				}
			}
		}else{
			$query = mysqli_query($conn, "INSERT INTO marketing (nama, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, idadmin, tglupdate, foto, foto2)
				VALUES ('$nama', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$iduser', '$timestamp', '', '$foto2')");

				//simpanLog
				$keter = $fullname." menambahkan marketing BARU ".$nama ; 
				$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
				VALUES ('$keter','$iduser','$timestamp')");
				
				if ($query){
					echo "<script>window.location = '../marketing/mastermkt.php'</script>";
					$_SESSION['alert'] = "berhasil";
					$_SESSION['pesan'] = "Data marketing Berhasil dimasukan!";
				} else {
					echo "<script>window.location = '../marketing/mastermkt.php'</script>";
					$_SESSION['alert'] = "gagal";
					$_SESSION['pesan'] = "Data marketing Gagal dimasukan!";	
					// echo("Error description: " . mysqli_error($conn));
				}
		}
			
		break;

	case 12:
		//insert pembelian barang
		$tgltrx    	= $_POST['tgl'];
		$idbrg	 	= $_POST['idbrg'];
		$qty		= $_POST['qty'];
		$harga		= $_POST['harga'];
		$suplier	= $_POST['suplier'];
		$ket		= $_POST['ket'];

		//membuat no transaksi
			$bln           = date('m');
			$thn           = date('y');
			$tgl           = date('d');
			$notrx         = "BMSK".$thn. $bln .$tgl;
			
		$desk ="pembelian barang untuk stok dengan notrx ".$notrx ; 
		
		
		$query = mysqli_query($conn, "INSERT INTO riw_brgmasuk (notrx, tgltrx, idbarang, qtyin, hargabeli, suplier, iduser, ket, tglupdate)
		VALUES ('$notrx', '$tgltrx', '$idbrg', '$qty', '$harga', '$suplier', '$iduser', '$ket', '$timestamp')");
		$qupdatebrg = mysqli_query($conn, "UPDATE m_barang SET harga='$harga' WHERE id='$idbrg'");

		//Cek trx sebelumnya
		$query2       = mysqli_query($conn, "SELECT * FROM saldo_klrmsk WHERE notrx='$notrx'");
		$cektrx       = mysqli_num_rows($query2);
		
		if($cektrx > 0){
			$qjumlah = mysqli_query($conn, "SELECT * FROM riw_brgmasuk WHERE notrx='$notrx'");
			while($jumlah = mysqli_fetch_array($qjumlah)){
				$total[] = $jumlah['hargabeli'] * $jumlah['qtyin'];
			}
			$totalan = array_sum($total);
			$query3 = mysqli_query($conn, "UPDATE saldo_klrmsk SET hrgout='$totalan', tgltrx='$tgltrx', tglupdate='$timestamp' WHERE notrx='$notrx'");
		} else {
			$query3 = mysqli_query($conn, "INSERT INTO saldo_klrmsk (notrx, tgltrx, deskripsi, hrgin, hrgout, ket, tglupdate)
			VALUES ('$notrx', '$tgltrx', '$desk', 0, '$harga' , '$ket', '$timestamp')");
		}
		//simpanLog
		$keter = $fullname." menambahkan pembelian barang masuk pada barang ".$idbrg." sejumlah".$harga ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");
		
		if ($query){
			echo "<script>window.location = '../barang/pembelianbrg.php'</script>";
			$_SESSION['alert']="berhasil";
			$_SESSION['pesan']="Pembelian Barang masuk Berhasil dimasukan!";	
		} else {
			echo "<script>window.location = '../barang/history_msk.php'</script>";
			$_SESSION['alert']="gagal";
			$_SESSION['pesan']="Pembelian Barang masuk paket Gagal dimasukan!";	
		}
			
		break;

	case 13:
		//insert master Dokter
		$nama    	= $_POST['nama'];
		$jk	 		= $_POST['jk'];
		$tempatlhr	= $_POST['tempatlhr'];
		$tgllahir	= $_POST['tgllahir'];
		$alamat		= $_POST['alamat'];
		$notlp		= $_POST['notlp'];
		
		$query = mysqli_query($conn, "INSERT INTO dokter (namadktr, jeniskelamin, alamat, tempatlahir, tgllahir, notlp, tglupdate)
		VALUES ('$nama', '$jk', '$alamat', '$tempatlhr', '$tgllahir', '$notlp', '$timestamp')");

		//simpanLog
		$keter = $fullname." menambahkan Dokter BARU ".$nama ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");
		
		if ($query){
			echo "<script>window.location = '../user/tambahusr.php?name=$nama'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Data Dokter Berhasil dimasukan! Tambahkan sebagai user";	
		} else {
			echo "<script>window.location = '../perawat/inputdktr.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Data Dokter Gagal dimasukan!";	
		}
			
		break;

	case 14:
		//insert pembayaran selesai
		$idtrx    	= $_GET['idtrx'];

		$query2     = mysqli_query($conn, "SELECT * FROM riw_trx WHERE id='$idtrx'");
		$datah      = mysqli_fetch_array($query2);
		$idpaket	= $datah['idpkt'];
		$qtypkt 	= $datah['qtypkt'];
		$notrx 		= $datah['notrx'];
		$tgltrx 	= $datah['tgl'];
		$idjdwl 	= $datah['idjdwl'];
			$qpaket     = mysqli_query($conn, "SELECT * FROM namapkt WHERE id='$idpaket'");
			$paket      = mysqli_fetch_array($qpaket);
			$hargapkt	= $paket['harga'];

		$query = mysqli_query($conn, "UPDATE riw_trx SET status='done', tglupdate='$timestamp' WHERE id='$idtrx'");
		if($idjdwl!=0){
			$qjdwal = mysqli_query($conn, "UPDATE jadwal SET status='done', tglupdate='$timestamp' WHERE id='$idjdwl'");
		}
		//simpan tb saldo utk report
		$desk = 'Transaksi dengan no : '.$notrx;
		$query5 =  mysqli_query($conn, "INSERT INTO saldo_klrmsk (notrx, tgltrx, deskripsi, hrgin, ket, tglupdate) VALUES ('$notrx','$tgltrx','$desk' ,'$hargapkt' ,'IN','$timestamp')");
			
		//simpanLog
			$keter = $fullname." menyelesaikan pembayaran dengan idtrx ".$idtrx ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");

		if ($query){
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Transaksi Berhasil diselesaikan!";
		} else {
			echo "<script>window.location = '../transaksi/history_trx'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Transaksi Gagal diselesaikan!";	
		}
		
		break;

		case 15:
			//insert request barang
			$timestamp  = $_POST['tgl'];
			$idbrg	 	= $_POST['idbrg'];
			$qty		= $_POST['qty'];
			$ket		= $_POST['ket'];
			
			// membuat no transaksi
				$query2        = mysqli_query($conn, "SELECT * FROM reqbarang ORDER BY id DESC LIMIT 1");
				$datah         = mysqli_fetch_array($query2);
				$noLm          = $datah['noreq'];
				$bln           = date('m');
				$thn           = date('y');
				$tgl           = sprintf("%02s", date('d'));
				$blnTkt        = sprintf("%02s", (int) substr($noLm, 5, 2));
				$ThnTkt        = sprintf("%02s", (int) substr($noLm, 3, 2));
					if ($blnTkt == $bln && $ThnTkt == $thn) {
						$noU       = (int) substr($noLm,8, 3);
					} else {
						$noU       = 0;
					}
				$noUrut        = (int) $noU + 1;
				$notrx         = "REQ".$thn. $bln . sprintf("%04s", $noUrut);
			
				for($i = 0;$i < count($idbrg);$i++) {
					$query=mysqli_query($conn, "INSERT INTO reqbarang (noreq,idbrg,qty,iduser,status,tglupdate) VALUES ('$notrx','$idbrg[$i]','$qty[$i]','$iduser','req','$timestamp')");
				}
	
			//simpanLog
			$keter = $fullname." Request barang baru dengan noreq ".$notrx ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");
			
			if ($query){
				// echo "<script>window.location = '../barang/masterbrg.php'</script>";
				echo json_encode("berhasil");
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Request barang Berhasil dimasukan!";	
			} else {
				// echo "<script>window.location = '../barang/masterbrg.php'</script>";
				echo json_encode("gagal");
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Request barang Gagal dimasukan!";	
			}	
			break;
	
	case 16 :
		//tambah paket
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
		$query = mysqli_query($conn, "INSERT INTO riw_trx (notrx, idjdwl, idpasien, tgl, idpkt, idpwt, iddktr, iduser, foto_bfr, foto2_bfr, status, tglupdate) VALUES ('$notrx', '$idjdwl', '$idpas', '$tgl', '$idpkt', '$idpwt', '$iddktr', '$iduser', '$fotobfr', '$foto2bfr', '$setatus', '$timestamp')");

		//simpanLog
		$keter = $fullname." menambah paket " .$notrx. " pada transaksi ".$notrx ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");		

		if ($query){
			echo "<script>window.location = '../transaksi/history_trx.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Tambah paket Berhasil dimasukan!";	
		} else {
			echo "<script>window.location = ../transaksi/history_trx.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Tambah paket Gagal dimasukan!";	
		}
	
		break;

	case 17 :
		//tambah pembayaran gaji
		$idpwt		= $_POST['perawat'];
		$bulan		= $_POST['bulan'];
		// $lembur		= (int) $_POST['lembur'];
		$insentif	= (int) $_POST['insentif'];
		$bpjs		= (int) $_POST['bpjs'];
		$bulangaji  = (int)substr($bulan,5,2);
		
		$querybulan = mysqli_query($conn, "SELECT * FROM gaji_perawat WHERE blnthn='$bulan' AND idpwt='$idpwt'");
		$cekbulan = mysqli_num_rows($querybulan);
		if ($cekbulan>0){
			echo "<script>window.location = '../saldokas/riw_gaji.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Pembayaran Gaji SUDAH dilakukan!";
		} else {
			//GajiPokok Perawat
			$query2     = mysqli_query($conn, "SELECT * FROM perawat, jabatan WHERE perawat.id='$idpwt' AND perawat.idjab=jabatan.id");
			$datah      = mysqli_fetch_array($query2);
			$gp 		= $datah['gapok'];
				//Komisi Transaksi
				$query3     = mysqli_query($conn, "SELECT * FROM riw_trx, perawat, namapkt, jenispkt WHERE perawat.id='$idpwt' AND riw_trx.idpwt=perawat.id AND riw_trx.idpkt=namapkt.id AND namapkt.idjenis=jenispkt.id AND month(riw_trx.tgl)='$bulangaji'");
				$cekfee = mysqli_num_rows($query3);
				if($cekfee>0){
					while($data3 = mysqli_fetch_array($query3)){
						$kom[] = $data3['qtypkt']*$data3['komisi'];
					}
					$fee 		= array_sum($kom);
				} else {
					$fee = 0;
				}
				//lembur
				$qceklbr = mysqli_query($conn, "SELECT * FROM lembur WHERE idpwt='$idpwt' AND month(lembur.tgl)='$bulangaji'");
				$ceklbr  = mysqli_num_rows($qceklbr);
				if($ceklbr>0){
					while($data4 = mysqli_fetch_array($qceklbr)){
						$lbr[] = $data4['nominal'];
					}
					$lembur 		= array_sum($lbr);
				} else {
					$lembur =0;
				}

			//simpan saldoklrmsk
				//membuat no transaksi
				$bln           = date('m');
				$thn           = date('y');
				$tgl           = date('d');
				$tglnow        = date('Y-m-d');
				$notrx         = "GAJ".$idpwt.$thn. $bulangaji .$tgl;
				$deskk = "Pembayaran gaji no ".$notrx." periode ".$bulan; 
				$gajinet = $gp + $fee + $insentif + $lembur - $bpjs;
				$querygj = mysqli_query($conn, "INSERT INTO saldo_klrmsk (notrx, tgltrx, deskripsi, hrgout, ket, tglupdate)
								VALUES ('$notrx', '$tglnow', '$deskk', '$gajinet', 'OUT', '$timestamp')");
			
			$query = mysqli_query($conn, "INSERT INTO gaji_perawat (nogaji, idpwt, gp, fee, lembur, insentif, bpjs, blnthn)
								VALUES ('$notrx', '$idpwt', $gp, $fee, '$lembur', '$insentif', '$bpjs', '$bulan')");
			//simpanLog
			$keter = $fullname." melakkukan pembayaran gaji untuk " .$datah['namapwt']. " pada bulan ".$bulan ; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");	
			
			if ($query){
				echo "<script>window.location = '../saldokas/riw_gaji.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Pembayaran Gaji Berhasil dimasukan!";	
				// echo $bulangaji;
			} else {
				echo "<script>window.location = ../saldokas/riw_gaji.php'</script>";	
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Pembayaran Gaji Gagal dimasukan!";	
			} 
		}
	
		break;

	
	case 18 :
		//tambah pemasukan lain2
		$tgltrx		= $_POST['tgl'];
		$desk		= $_POST['desk'];
		$nominal	= $_POST['masuk'];
		
		// membuat no transaksi
			$query2        = mysqli_query($conn, "SELECT * FROM `saldo_klrmsk` WHERE left(notrx,3)='DEB' ORDER BY id DESC LIMIT 1;");
			$datah         = mysqli_fetch_array($query2);
			$noLm          = $datah['notrx'];
			$bln           = date('m');
			$thn           = date('y');
			$tgl           = sprintf("%02s", date('d'));
			$blnTkt        = sprintf("%02s", (int) substr($noLm, 5, 2));
			$ThnTkt        = sprintf("%02s", (int) substr($noLm, 3, 2));
				if ($blnTkt == $bln && $ThnTkt == $thn) {
					$noU       = (int) substr($noLm, 10, 3);
				} else {
					$noU       = 0;
				}
			$noUrut        = (int) $noU + 1;
			$notrx         = "DEB".$thn. $bln .$tgl."-".sprintf("%03s", $noUrut);
				//Cek no transaksi Double
				$query3        = mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx'");
				$ceknoinv      = mysqli_num_rows($query3);
				if($ceknoinv > 0){
					$noSama = $noUrut+1;
					$notrx  = "DEB".$thn. $bln .$tgl."-".sprintf("%03s", $noSama);
				}
				
		$deskripsi = "Pemasukan lain2 ".$desk. " dengan no trx ".$notrx;	
		$query = mysqli_query($conn, "INSERT INTO saldo_klrmsk (notrx, tgltrx, deskripsi, hrgin, ket, tglupdate)
							VALUES ('$notrx', '$tgltrx', '$deskripsi', '$nominal', 'IN', '$timestamp')");
		
		//simpanLog
		$keter = $fullname." input pemasukan dari " .$desk. " dengan nominal ".$nominal ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");	
		
		if ($query){
			echo "<script>window.location = '../saldokas/masterklrmsk.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Pemasukan lain-lain Berhasil dimasukan!";	
		} else {
			echo "<script>window.location = ../saldokas/masterklrmsk.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "pemasukan lain-lain Gagal dimasukan!";	
		}
	
		break;
	
	case 19 :
		//tambah pengeluaran lain2
		$tgltrx		= $_POST['tgl'];
		$desk		= $_POST['desk'];
		$nominal	= $_POST['masuk'];
		
		// membuat no transaksi
			$query2        = mysqli_query($conn, "SELECT * FROM `saldo_klrmsk` WHERE left(notrx,3)='KRE' ORDER BY id DESC LIMIT 1;");
			$datah         = mysqli_fetch_array($query2);
			$noLm          = $datah['notrx'];
			$bln           = date('m');
			$thn           = date('y');
			$tgl           = sprintf("%02s", date('d'));
			$blnTkt        = sprintf("%02s", (int) substr($noLm, 5, 2));
			$ThnTkt        = sprintf("%02s", (int) substr($noLm, 3, 2));
				if ($blnTkt == $bln && $ThnTkt == $thn) {
					$noU       = (int) substr($noLm, 10, 3);
				} else {
					$noU       = 0;
				}
			$noUrut        = (int) $noU + 1;
			$notrx         = "KRE".$thn. $bln .$tgl."-".sprintf("%03s", $noUrut);
				//Cek no transaksi Double
				$query3        = mysqli_query($conn, "SELECT * FROM riw_trx WHERE notrx='$notrx'");
				$ceknoinv      = mysqli_num_rows($query3);
				if($ceknoinv > 0){
					$noSama = $noUrut+1;
					$notrx  = "KRE".$thn. $bln .$tgl."-".sprintf("%03s", $noSama);
				}
				
		$deskripsi = "Pengeluaran lain2 ".$desk. " dengan no trx ".$notrx;	
		$query = mysqli_query($conn, "INSERT INTO saldo_klrmsk (notrx, tgltrx, deskripsi, hrgout, ket, tglupdate)
							VALUES ('$notrx', '$tgltrx', '$deskripsi', '$nominal', 'OUT', '$timestamp')");
		
		//simpanLog
		$keter = $fullname." input pengeluaran dari " .$desk. " dengan nominal ".$nominal ; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");	
		
		if ($query){
			echo "<script>window.location = '../saldokas/masterklrmsk.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Pengeluaran lain-lain Berhasil dimasukan!";	
		} else {
			echo "<script>window.location = ../saldokas/masterklrmsk.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Pengeluaran lain-lain Gagal dimasukan!";	
		}
	
		break;

	case 20 :
		//tambah master user
		$usernamen 	= $_POST['username'];
		$fullnamen	= $_POST['fullname'];
		$rolen		= $_POST['role'];
		$passwordn	= md5($_POST['password']);

		$qcek =mysqli_query($conn, "SELECT * from tb_user WHERE username='$usernamen'");
		$cek=mysqli_num_rows($qcek);
		if($cek>0){
			echo "<script>window.location = '../user/masterusr.php'</script>";
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "username sudah pernah ditambahkan!";	
		} else {
			if(isset($_POST['idp'])){
				$idp = $_POST['idp'];
				$query = mysqli_query($conn, "INSERT INTO tb_user (username, idpwt, fullname, password, role) 
				values('$usernamen','$idp','$fullnamen','$passwordn','$rolen')");	
			} else {
			$query = mysqli_query($conn, "INSERT INTO tb_user (username,fullname,password,role) 
			values('$usernamen','$fullnamen','$passwordn','$rolen')");
			}
			//simpanLog
			$keter = $fullname." Menambahkan pengguna " .$rolen. " Baru"; 
			$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
			VALUES ('$keter','$iduser','$timestamp')");

			if ($query){
				echo "<script>window.location = '../user/masterusr.php'</script>";
				$_SESSION['alert'] = "berhasil";
				$_SESSION['pesan'] = "Pengguna baru berhasil ditambahkan!";	
			} else {
				echo "<script>window.location = ../user/masterusr.php'</script>";	
				$_SESSION['alert'] = "gagal";
				$_SESSION['pesan'] = "Pengguna baru gagal ditambahkan!";	
			}
		}
	break;

	case 21 :
		//tambah jabatan
		$nama 	= $_POST['nama'];
		$gapok	= $_POST['gapok'];
		
		$query = mysqli_query($conn, "INSERT INTO jabatan (namajab, gapok) 
		values('$nama','$gapok')");

		//simpanLog
		$keter = $fullname." Menambahkan jabatan " .$nama. " Baru"; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");

		if ($query){
			echo "<script>window.location = '../perawat/masterjabatan.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Jabatan baru berhasil ditambahkan!";	
		} else {
			echo "<script>window.location = ../perawat/masterjabatan.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Jabatan baru gagal ditambahkan!";	
		}

	break;

	case 22 :
		//tambah Jenis paket
		$nama 	= $_POST['nama'];
		$komisi	= $_POST['komisi'];
		
		$query = mysqli_query($conn, "INSERT INTO jenispkt (namajenis, komisi) 
		values('$nama','$komisi')");

		//simpanLog
		$keter = $fullname." Menambahkan Jenis paket " .$nama. " Baru"; 
		$querylog = mysqli_query($conn, "INSERT INTO daf_log (keterangan, iduser, tanggal)
		VALUES ('$keter','$iduser','$timestamp')");

		if ($query){
			echo "<script>window.location = '../paket/masterjnspkt.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Jenis paket baru berhasil ditambahkan!";	
		} else {
			echo "<script>window.location = ../paket/masterjnspkt.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Jenis paket gagal ditambahkan!";	
		}

	break;

	case 23 :
		//tambah Lembur
		$idabs	= $_GET['idabs'];
		
		$tampil=mysqli_query($conn, "SELECT * from absensi WHERE id=$idabs");
		$data=mysqli_fetch_array($tampil);
			$tanggal= date("Y-m-d",strtotime($data['waktuout']));
			$pulang = date("H:i:s",strtotime($data['waktuout']));
			$idusr  = $data['iduser'];
			$jam5   = strtotime("17:00:00");
			$jamplg = strtotime($pulang);
			$lembur = $jamplg-$jam5;
		$qcek = mysqli_query($conn, "SELECT * from tb_user WHERE user_id=$idusr");
		$cek = mysqli_fetch_array($qcek);
		$idper = $cek['idpwt'];
		if($idper==0){
			$qjab =mysqli_query($conn, "SELECT * from jabatan WHERE id=5");
			$jabatan=mysqli_fetch_array($qjab);
				$perjam = $jabatan['lembur'];
		} else {
			$qusr =mysqli_query($conn, "SELECT * from tb_user, perawat, jabatan WHERE tb_user.user_id='$idusr' AND tb_user.idpwt=perawat.id AND perawat.idjab=jabatan.id ");
			$user=mysqli_fetch_array($qusr);
				$perjam = $user['lembur'];
		}
			$permenit = floor($perjam / 60);
				$nominal = floor(($lembur/60) * $permenit);
				//pembulatan hargajual
				$nominal =ceil($nominal);
				if (substr($nominal,-2)>49){
					$nominal=round($nominal,-2);
				} else {
					$nominal=round($nominal,-2)+100;
				}

		$query = mysqli_query($conn, "INSERT INTO lembur (userid, idpwt, tgl, durasi, nominal, updateby) 
		values('$idusr','$idper','$tanggal','$lembur','$nominal','$iduser')");
		// echo $idusr."<br/>";
		// echo $tanggal."<br/>";
		// echo $lembur."<br/>";
		// echo $nominal."<br/>";
		// echo $iduser."<br/>";

		if ($query){
			echo "<script>window.location = '../user/absensi.php'</script>";
			$_SESSION['alert'] = "berhasil";
			$_SESSION['pesan'] = "Lembur berhasil ditambahkan!";	
		} else {
			echo "<script>window.location = ../user/absensi.php'</script>";	
			$_SESSION['alert'] = "gagal";
			$_SESSION['pesan'] = "Lembur gagal ditambahkan!";	
		}

	break;


}
?>