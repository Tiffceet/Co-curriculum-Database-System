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
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <!-- Page Title and icon -->
        <title>SMPK | Hapus</title>
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
            <a style="font-size:20px;"><u>Menghapus Data</u></a>
            <br>
            Pilih Data yang hendak dihapus
            <br>
            <form action="proc-hapus-pelajar.php" method="POST">
                <div style="padding: 12px 20px;overflow:auto;height:250px" id="in">
                    <center>
                        <table class="table-kemaskini">
                            <tr><th> </th><th>NoSek</th><th>Nama Murid</th><th>Nama Kelas</th></tr>
                            <?php
                            $query = $conn->query("SELECT pelajar.NoSek, pelajar.NamaPelajar, pelajar.KodKelas, kelas.NamaKelas FROM pelajar INNER JOIN kelas ON pelajar.KodKelas = kelas.KodKelas ORDER BY NamaKelas,NamaPelajar;");
                            while ($row = $query->fetch_assoc()) {
                                $noSek = $row['NoSek'];
                                $NamaPelajar = $row['NamaPelajar'];
                                $KodKelas = $row['KodKelas'];
                                $NamaKelas = $row['NamaKelas'];
                                echo "<tr>";

                                echo "<td><input type='checkbox' name='$noSek'></input></td>";
                                echo "<td><input value='$noSek' readonly></input></td>";
                                echo "<td><input value='$NamaPelajar' readonly></input></td>";

                                echo "<td><input readonly value='";
                                $query2 = $conn->query("SELECT NamaKelas FROM kelas WHERE KodKelas=$KodKelas");
                                while ($row = $query2->fetch_assoc()) {
                                    echo $row['NamaKelas'];
                                }
                                echo "'></input></td>";

                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </center>
                </div>

                <div style="padding: 15px 20px;overflow:hidden">
                    <!-- <button style="float:left;" class="btn" onclick="window.close();">Menu</button> -->
                    <!-- <input style="float:right;" class="btn" value="Mengemaskini" type="submit"></input> -->
                    <input style="float:right" class="btn" value="Menghapus" type="submit"></input>
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