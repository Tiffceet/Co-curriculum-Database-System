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
            <form action="proc-hapus-kelas.php" method="POST" onsubmit="return check();">
                <div style="padding: 12px 20px;overflow:auto;height:250px" id="in">
                    <center>
                        <table class="table-kemaskini" style="float:left" >
                            <tr><th> </th><th>Senarai Kelas</th></tr>
                            <?php
                            $query = $conn->query("SELECT * FROM kelas");
                            while ($row = $query->fetch_assoc()) {

                                $KodKelas = $row['KodKelas'];
                                $NamaKelas = $row['NamaKelas'];
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='$KodKelas'></input></td>";
                                echo "<td>";
                                echo "<input value='$NamaKelas' readonly></input>";
                                echo "</td>";

                                echo "</tr>";
                            }
                            ?>
                        </table>

                        <table class="table-kemaskini" style="float:right" >
                            <tr><th> </th><th>Senarai Kelab</th></tr>
                            <?php
                            $query = $conn->query("SELECT * FROM `kelab dan persatuan`");
                            while ($row = $query->fetch_assoc()) {
                                $KodKelab = $row['KodKelab'];
                                $NamaKelab = $row['NamaKelab'];
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='_$KodKelab'></input></td>";
                                echo "<td>";
                                echo "<input value='$NamaKelab' readonly></input>";
                                echo "</td>";

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

                    <button type='button' style="float:left;" class="btn" onClick="window.close();">Menu</button>
                </div>
            </form>
        </div>

    </center>
    <script>
        function check() {
            if (confirm("This is going to remove all pelajar from kelas selected\nAnd remove all entries on kelab selected.\nContinue?")) {
                return true;
            } else {
                return false;
            }
        };
    </script>
    <script>
        document.getElementById('title').scrollIntoView();
    </script>
</html>