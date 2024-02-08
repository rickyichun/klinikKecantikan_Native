<?php 
    include "../control/basisdata.php" ;
    include "../control/cek-login.php" ;
    $fullname = $_SESSION['fullname'];
    ini_set('date.timezone', 'Asia/Jakarta'); 
    $role= $_SESSION['role'];

    $start=$_POST['start'];
    $end=$_POST['end'];
    $report=[];
    $salawal=[];
    $result=[];

    $query=mysqli_query($conn, "SELECT * from saldo_klrmsk 
                                WHERE tgltrx BETWEEN '$start' AND '$end'
                                order by tgltrx desc");

    $saldoawal=mysqli_query($conn, "SELECT sum(hrgin) as masuk, sum(hrgout) as keluar from saldo_klrmsk 
                                WHERE tgltrx < '$start'");
    
    foreach($query as $q){
        $report["transaksi"][]=[
            'tanggal'=>$q['tgltrx'],
            'deskripsi'=>$q['deskripsi'],
            'masuk'=>$q['hrgin'],
            'keluar'=>$q['hrgout'],
            'ket'=>$q['ket'],
        ];
    }
    
    foreach($saldoawal as $s){
        $salawal["saldoawal"][]=[
            'masuk'=>$s['masuk'],
            'keluar'=>$s['keluar'],
        ];
    }

    $result=[$report,$salawal];

    echo json_encode($result);
?>