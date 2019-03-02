<?php
require_once('conn.php');
?>
<html>
    <head>
        <title>Debug Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/debug.css">
        <script src="js/jquery-3.3.1.min.js"></script>
    </head>

    <body>

        <div class="realbody">
            dofidhldafladljadljasaskdasaksaskasdlkdaslfdafdaadadasd
            <br><br>sdofdlaelealii<br><br>asdjshsaldhsadjl
        </div>
        <div class="nav-bar">
            <span id="nav-item-container">
                <img id="nav_tambah" class="icon" src="image/TambahData.png" alt="TambahData" title="Pendaftaran">
                <span class="tooltiptext">Pendaftaran</span>
            </span>
            <span id="nav-item-container"><img id="nav_kemaskini" class="icon" src="image/KemasKini Data.png" alt="KemaskiniData" title="Kemaskini Data">
                <span class="tooltiptext">Kemaskini Data</span>
            </span>
            <span id="nav-item-container">
                <img id="nav_hapus" class="icon" src="image/hapusData.png" alt="HapusData" title="Hapus Data">
                <span class="tooltiptext">Hapus Data</span>
            </span>
            <span id="nav-item-container">
                <img id="nav_report" class="icon" src="image/Report.png" alt="Laporan">
                <span class="tooltiptext">Laporan</span>
            </span>
        </div>

    </body>
    <?php include('hiddenBoxes.php'); ?>
    <script src="js/navBar.js"></script>
</html>