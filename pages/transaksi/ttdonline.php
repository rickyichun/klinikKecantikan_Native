<!DOCTYPE html>
<html>

<head>
    <title>Tanda Tangan Touch Screen HTML</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="../../dist/js/jquery.signature.min.js"></script>
    <script type="text/javascript" src="../../dist/js/jquery.ui.touch-punch.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../dist/css/jquery.signature.css">

    <style>
    .kbw-signature {
        width: 400px;
        height: 400px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
    </style>

</head>

<body>
    <?php    
        $idtrx = $_GET['idtrx'];
    ?>
    <div class="container">

        <form method="POST" action="../control/update.php?mode=18">
            <input type="hidden" class="form-control" name='idtrx' value="<?php echo $idtrx; ?>">

            <h1>Tanda Tangan Persetujuan / Pernyataan</h1>

            <div class="col-md-12">
                <label class="" for="">Tanda Tangan:</label>
                <br />
                <div id="sig"></div>
                <br />
                <button id="clear">Hapus Tanda Tangan</button>
                <textarea id="signature64" name="signed" style="display: none"></textarea>
            </div>

            <br />
            <button class="btn btn-success">Submit</button>
        </form>

    </div>

    <script type="text/javascript">
    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
    </script>
</body>

</html>