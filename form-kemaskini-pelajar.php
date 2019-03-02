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


$lowerB = 0;
$upperB = 50;
if(isset($_GET['page'])){
    $page = $_GET['page'];
    $lowerB = (($page - 1) * 50);
    $upperB = $lowerB + 49;
}
?>
<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <!-- Page Title and icon -->
        <title>SMPK | Kemaskini</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/login.png?v=2" />

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/kemaskini.css">
        <link rel="stylesheet" type="text/css" href="css/table.css">

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
            <form action="proc-kemaskini-pelajar.php?page=<?php echo $page; ?>" method="POST">
                <div style="padding: 12px 20px;overflow:auto;height:250px" id="in">
                    <center>
                        <table class="table-kemaskini">
                            <tr><th>NoSek</th><th>Nama Murid</th><th>Nama Kelas</th></tr>
                            <?php
                            $TESTquery = $conn->query("SELECT pelajar.NoSek, pelajar.NamaPelajar, pelajar.KodKelas, kelas.NamaKelas FROM pelajar INNER JOIN kelas ON pelajar.KodKelas = kelas.KodKelas");
                            $dataCount = $TESTquery->num_rows;
                            $query = $conn->query("SELECT pelajar.NoSek, pelajar.NamaPelajar, pelajar.KodKelas, kelas.NamaKelas FROM pelajar INNER JOIN kelas ON pelajar.KodKelas = kelas.KodKelas LIMIT $lowerB, $upperB");
                            $dataLimitPerPage = 50;
                            while ($row = $query->fetch_assoc()) {
                                $noSek = $row['NoSek'];
                                $NamaPelajar = $row['NamaPelajar'];
                                $KodKelas = $row['KodKelas'];
                                $NamaKelas = $row['NamaKelas'];
                                echo "<tr>";
                                echo "<td><input type='number' class='edit' name='_$noSek' value='$noSek'></input></td>";
                                echo "<td><input class='edit' name='$NamaPelajar' value='$NamaPelajar'></input></td>";

                                echo "<td><select name='__$noSek'>";
                                $query2 = $conn->query("SELECT * FROM kelas");
                                while ($row = $query2->fetch_assoc()) {
                                    $temp = $row['KodKelas'];
                                    $temp2 = $row['NamaKelas'];
                                    if (strcmp($temp, $KodKelas) == 0) {
                                        echo "<option value='$temp' selected>" . $temp2 . "</option>";
                                    } else {
                                        echo "<option value='$temp'>" . $temp2 . "</option>";
                                    }
                                }
                                echo "</select></td>";

                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </center>
                </div>

                <div style="text-align:right;padding:20px 10px;">
                    (Total Entry: <?php echo $dataCount; ?>) Pages: 
                    <?php
                    for ($a = 1; $a < ($dataCount / $dataLimitPerPage)+1; $a++) {
                        echo "<a href='form-kemaskini-pelajar.php?page=$a'>$a </a>";
                    }
                    ?>
                </div>

                <div style="padding: 15px 20px;overflow:hidden">
                    <!-- <button style="float:left;" class="btn" onclick="window.close();">Menu</button> -->
                    <!-- <input style="float:right;" class="btn" value="Mengemaskini" type="submit"></input> -->
                    <input style="float:right" class="btn" value="Mengemaskini" type="submit"></input>
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
