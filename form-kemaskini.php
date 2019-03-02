<?php
session_start();
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
}
if (!isset($_SESSION['login_user']) || time() - $_SESSION['time'] > 1800) {
    header("Location:logout.php");
}
$_SESSION['time'] = time();
include('conn.php');
include('getData.php');
?>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <!-- Page Title and icon -->
        <title>SMPK | Kemaskini</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/login.png?v=2" />

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/kemaskini.css">

        <!-- // Dirty Credit 
        <div>
                Icons made by <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
        </div>
        -->
    </head>

    <body>
    <center>
        <div><img style="border:10px solid rgba(255,255,255,0.5);border-radius:50%;" src="image/IndexLogo.JPG" alt="Logo" style="width:200px;height:250px;"></div>
    </center>
    <br>
    <center>
        <div class="menu">
            <div class="sistem" id="title">
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>
            </div>
            <br>
            <a style="font-size:20px;"><u>Mengemaskini Data</u></a>
            <br>
			Pilih Attribut yang hendak dikemaskini
            <br>
            <form action="proc-kemaskini.php" method="POST">
                <!-- padding to center the block -->
                <!-- overflow to display more data -->
                <div style="padding: 12px 20px;overflow:auto;height:250px;" id="in">
                    <center>
                        <table class="table-kemaskini">
                            <tr><th>NoSek</th><th>Nama Murid</th><th>Nama Kelas</th><th>Kelab Yang Disertai</th></tr>



                            <?php
                            for ($i = 0; $i < sizeOf($_noSek); $i++) {
                                $kodPendaftaran = $_kodPendaftaran[$i];
                                $noSek = $_noSek[$i];
                                $namaMurid = $_namaMurid[$i];
                                $kodKelas = $_kodKelas[$i];
                                $namaKelas = $_namaKelas[$i];
                                $kodKelab = $_kodKelab[$i];
                                $kelab = $_kelabDisertai[$i];
                                echo "<tr>"
                                . "<td><input readonly name='$noSek' value='$noSek'></input></td>"
                                . "<td><input readonly name='' value='$namaMurid'></input></td>"
                                . "<td><input readonly name='$kodKelas' value='$namaKelas'></input></td>";

                                echo "<td><select name='$kodPendaftaran", "_kelab'>";
                                $q = $conn->query('SELECT * FROM `kelab dan persatuan`');
                                while ($row = $q->fetch_assoc()) {
                                    if (strcmp($row['KodKelab'], $kodKelab) == 0) {
                                        echo "<option value='$kodPendaftaran", "_", $row['KodKelab'], "'selected>", $row['NamaKelab'], "</option>";
                                    } else {
                                        echo "<option value='$kodPendaftaran", "_", $row['KodKelab'], "'>", $row['NamaKelab'], "</option>";
                                    }
                                }
                                echo "</td></tr>";
                            }
                            ?>
                        </table>
                    </center>
                </div>



                <br>
                <div style="padding: 12px 20px;overflow:hidden" >
                    <input style="float:right;" class="btn" value="Mengemaskini" type="submit"></input>
                    <button style="float:left;" class="btn" onclick="window.close();">Menu</button>
                </div>
            </form>
        </div>
    </center>
</body>
<script>
    document.getElementById('title').scrollIntoView();
</script>
</html>