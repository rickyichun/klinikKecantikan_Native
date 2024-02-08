<?php 
include "../../control/basisdata.php" ;
include "../../control/cek-login.php" ;

$idtrx = $_GET['idtrx'];

$qtrx     = mysqli_query($conn, "SELECT * FROM riw_trx WHERE id='$idtrx'");
$trx      = mysqli_fetch_array($qtrx);
$idpas    = $trx['idpasien'];
$qdata     = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpas'");
$data      = mysqli_fetch_array($qdata);
$nama	   = $data['nama'];
$idpkt     = $trx['idpkt'];
$qpaket     = mysqli_query($conn, "SELECT * FROM namapkt WHERE id='$idpkt'");
$paket      = mysqli_fetch_array($qpaket);
$iddktr     = $trx['iddktr'];
$qdokter     = mysqli_query($conn, "SELECT * FROM dokter WHERE id='$iddktr'");
$dokter      = mysqli_fetch_array($qdokter);

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
    body {
        font-family: "Calibri", sans-serif !important;
    }

    h3 {
        font-size: 18px !important;
        text-decoration: underline;
    }

    p {
        font-size: 14px !important;
        text-align: justify;
    }

    tr p {
        text-align: center !important;
        margin-top: 50px;
    }
    </style>
</head>

<body>
    <h3 class="text-center mb-5 mt-4">SURAT PERNYATAAN</h3>
    <p class="ms-5 me-5">Dengan ini saya atas nama : <?php echo $nama; ?></p>
    <p class="ms-5 me-5">bersedia mengikuti prosedure<br>Tindakan : <?php echo $paket['namapkt']; ?></p>
    <!-- <p class="ms-4 me-4"></p> -->
    <p class="ms-5 me-5">Saya juga secara sadar, sehat dan tanpa paksaan menyetujui perihal pernyataan ini dengan klinik
        dr SUGI Aesthetic Center Surabaya </p>
    <p class="ms-5 me-5">Dengan ini saya berjanji tidak akan menuntut atau menimbulkan hal yang merugikan terhadap
        klinik baik secara materil ataupun inmateril. </p>
    <p class="ms-5 me-5">Tidak mengambil gambar / memvideo tindakan-tindakan selama proses tanpa persetujuan pihak
        klinik </p>
    <p class="ms-5 me-5">Dan apabila kedepannya timbul suatu perihal atas kelalaian saya maka saya bersedia dan
        bertanggung jawab penuh atas semua sangsi yang diberikan.</p>
    <p class="ms-5 me-5">Surabaya, <?php echo date("Y-m-d"); ?></p>
    <!-- <table class="ms-5 me-s5 w-80">
        <tr>
            <td>
                <p>TTD</p>
            </td>
            <td>
                <p>TTD</p>
            </td>
        </tr>

    </table> -->
    <table class="ms-5 me-5 w-80">
        <tr>
            <td>
                <img src="../<?php echo $trx['filepernyataan']; ?>" height="300" weight="100">
            </td>

            <!-- <td>
                <img src="../<?php echo $trx['filepernyataan']; ?>" height="300" weight="100">
            </td> -->
        </tr>
        <tr>
            <td>
                <p><?php echo $nama; ?>
                    <br />(Pasien)
                </p>
            </td>
            <td>
                <p><?php echo $dokter['namadktr']; ?>
                    <br />(Dokter Aesthetic)
                </p>
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