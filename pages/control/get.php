<?php
include "basisdata.php";
include "cek-login.php" ;
ini_set('date.timezone', 'Asia/Jakarta');
$mode = $_GET['mode'];
$iduser = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$timestamp	= date('Y-m-d h:m:s');

switch ($mode) {
    case 1:
        $idbrg = $_POST['id'];
        $query = mysqli_query($conn,"SELECT satuan from m_barang where id='$idbrg'");
        $data = mysqli_fetch_array($query);
        echo json_encode($data);
    break;
}?>