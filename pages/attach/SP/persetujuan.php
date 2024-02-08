<?php 
include "../../control/basisdata.php" ;
include "../../control/cek-login.php" ;

$idtrx = $_GET['idtrx'];

$qtrx     = mysqli_query($conn, "SELECT * FROM riw_trx 
                                left join pasien on pasien.id=riw_trx.idpasien 
                                left join namapkt on namapkt.id=riw_trx.idpkt 
                                left join dokter on dokter.id=riw_trx.iddktr 
                                WHERE riw_trx.id='$idtrx'");
$trx      = mysqli_fetch_array($qtrx);
$tgllahir = new DateTime($trx['tgllahir']);
$today  = new DateTime();
$umur   = $today->diff($tgllahir)->y;


// $idpas    = $trx['idpasien'];
// $qdata     = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpas'");
// $data      = mysqli_fetch_array($qdata);
// $nama	   = $data['nama'];
// $idpkt     = $trx['idpkt'];
// $qpaket     = mysqli_query($conn, "SELECT * FROM namapkt WHERE id='$idpkt'");
// $paket      = mysqli_fetch_array($qpaket);
// $iddktr     = $trx['iddktr'];
// $qdokter     = mysqli_query($conn, "SELECT * FROM dokter WHERE id='$iddktr'");
// $dokter      = mysqli_fetch_array($qdokter);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    .underline {
        text-decoration: underline;
    }

    h3 {
        font-size: 18px !important;
    }

    p {
        font-size: 12px;
        text-align: justify;
    }

    /* tr{
        text-align: center;
    } */
    table tr td .form {
        margin-bottom: 0px !important;
        margin-left: 20px !important;
    }
    </style>
</head>

<body>
    <h3 class="text-center mb-5 mt-4">
        PERSETUJUAN TINDAKAN MEDIS<br>( INFORMED CONSENT)
    </h3>
    <p class="ms-5 me-5">Yang bertanda tangan dibawah ini :</p>
    <table class="ms-5 me-5 mb-2">
        <tr>
            <td>
                <p class="form">Nama</p>
            </td>
            <td>
                <p class="form">: <?= $trx['nama']?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">Umur</p>
            </td>
            <td>
                <p class="form">: <?= $umur?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">Alamat</p>
            </td>
            <td>
                <p class="form">: <?= $trx['alamat']?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">Pekerjaan</p>
            </td>
            <td>
                <p class="form">: </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">KTP / SIM No.</p>
            </td>
            <td>
                <p class="form">: <?php echo $trx['noktp']; ?></p>
            </td>
        </tr>
    </table>
    <p class="ms-5 me-5">Dengan ini menyatakan sesungguhnya telah memberikan :</p>
    <h3 class="text-center underline ">
        Persetujuan
    </h3>
    <p class="ms-5 me-5">Untuk dilakukan Tindakan medis :</p>
    <table class="ms-5 me-5 mb-2">
        <tr>
            <td>
                <p class="form">Terhadap</p>
            </td>
            <td>
                <p class="form">: <b>Diri sendiri </b></p>
            </td>
            <td>
                <p class="form">Istri</p>
            </td>
            <td>
                <p class="form">Suami</p>
            </td>
            <td>
                <p class="form">Orang Tua</p>
            </td>
            <td>
                <p class="form">Lain nya</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">Yang Bernama</p>
            </td>
            <td>
                <p class="form">: <?= $trx['nama']?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">Umur / Kelamin</p>
            </td>
            <td>
                <p class="form">: <?= $umur." / ".$trx['jeniskelamin']?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="form">Alamat</p>
            </td>
            <td>
                <p class="form">: <?= $trx['alamat']?></p>
            </td>
        </tr>
    </table>
    <p class="ms-5 me-5">Yang sifat dan tujuan, besarnya menfaat, serta cara kerja Tindakan medis tersebut diatas serta
        kemungkinan timbulnya resiko beserta segala akibat-akibatnya telah dijelaskan sebelumnya oleh dokter yang
        menangani dan telah saya mengerti seluruhnya.
        Saya juga menyatakan memberikan persetujuan untuk dilakukan anestesi dan/atau obat/bahan medis lainnya/ yang di
        perlukan untuk dapat dilakukan Tindakan medis tersebut.
        Demikian pernyataan persetujuan ini saya buat dengan sebenarnya, dalam keadaan sadar dan tanpa paksaan.
    </p>
    <p class="ms-5 me-5">Surabaya, <?php echo date("d F Y"); ?></p>
    <table class="ms-3 w-100 text-center">
        <tr>
            <td>
                <p class="text-center">Dokter yang menangani</p>
            </td>
            <td>
                <p class="text-center">Yang memberi persetujuan</p>
            </td>
            <td>
                <p class="text-center">Saksi 1</p>
            </td>
            <td>
                <p class="text-center">Saksi 2</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="text-center pt-3"><?= $trx['namadktr']?></p>
            </td>
            <td>
                <img src="../<?php echo $trx['filepernyataan']; ?>" height="300" weight="100">
                <p class="text-center pt-3"><?= $trx['nama']?></p>
            </td>
            <td>
                <p class="text-center pt-3">(TTD /Nama Jelas)</p>
            </td>
            <td>
                <p class="text-center pt-3">(TTD /Nama Jelas)</p>
            </td>
        </tr>
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script>
window.print()
</script>

</html>