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

$KodKelas = $_POST['KodKelas'];
$KodKelab = $_POST['KodKelab'];
$real_KodKelab = ltrim($KodKelab, "_");
if ($KodKelab == -1 && $KodKelas == -1 || $KodKelab != -1 && $KodKelas != -1) {
    echo "<script>alert('Sila pilih kelas / kelab');window.close();</script>";
    return;
}
$title = "undefined";
if ($KodKelas != -1) {
    $table_3rdElement = "NamaKelab";
    $r2 = $conn->query("SELECT NamaKelas FROM kelas WHERE KodKelas=$KodKelas");
    while ($row2 = $r2->fetch_assoc()) {
        $title = "Kelas " . $row2['NamaKelas'];
    }
    $r = $conn->query("SELECT pendaftaran.NoSek,pelajar.NamaPelajar,kelas.KodKelas,kelas.NamaKelas,`kelab dan persatuan`.NamaKelab FROM pendaftaran INNER JOIN pelajar ON pendaftaran.NoSek=pelajar.NoSek INNER JOIN kelas ON pelajar.KodKelas=kelas.KodKelas INNER JOIN `kelab dan persatuan` ON pendaftaran.KodKelab=`kelab dan persatuan`.KodKelab WHERE kelas.KodKelas=$KodKelas");
    $count = 0;
    $_NoSek = array();
    $_NamaPelajar = array();
    $_NamaKelab = array();
    while ($row = $r->fetch_assoc()) {
        $_NoSek[$count] = $row['NoSek'];
        $_NamaPelajar[$count] = $row['NamaPelajar'];
        $_NamaKelab[$count] = $row['NamaKelab'];
        $count++;
    }
    /*
    for($a = 0;$a < sizeOf($_NoSek);$a++){
        echo " NoSek ".$_NoSek[$a];
        echo " NamaPelajar ".$_NamaPelajar[$a];
        echo " NamaKelab ".$_NamaKelab[$a];
        echo "<br>";
    }
    */
    $initSize = sizeOf($_NoSek);
    for ($a = 0; $a < $initSize; $a++) {
        for ($b = 0; $b < $initSize; $b++) {
            if ($a != $b && isset($_NoSek[$a]) && isset($_NoSek[$b])) {
                if (strcmp($_NoSek[$a], $_NoSek[$b]) == 0) {
                    $_NamaKelab[$b] = $_NamaKelab[$b].",".$_NamaKelab[$a];
                    unset($_NoSek[$a]);
                    unset($_NamaPelajar[$a]);
                    unset($_NamaKelab[$a]);
                }
            }
        }
    }
} else if ($KodKelab != -1) {
    $_NoSek = array();
    $_NamaPelajar = array();
    $_NamaKelas = array();
    $table_3rdElement = "NamaKelas";
    $r2 = $conn->query("SELECT NamaKelab FROM `kelab dan persatuan` WHERE KodKelab=$real_KodKelab");
    while ($row2 = $r2->fetch_assoc()) {
        $title = $row2['NamaKelab'];
    }

    $r = $conn->query("SELECT pendaftaran.NoSek, pelajar.NamaPelajar, pendaftaran.KodKelab, `kelab dan persatuan`.NamaKelab, kelas.NamaKelas FROM pendaftaran INNER JOIN pelajar ON pendaftaran.NoSek=pelajar.NoSek INNER JOIN kelas ON pelajar.KodKelas=kelas.KodKelas INNER JOIN `kelab dan persatuan` ON pendaftaran.KodKelab=`kelab dan persatuan`.`KodKelab` WHERE pendaftaran.KodKelab=$real_KodKelab;");
    $count = 0;
    while ($row = $r->fetch_assoc()) {
        $_NoSek[$count] = $row['NoSek'];
        $_NamaPelajar[$count] = $row['NamaPelajar'];
        $_NamaKelas[$count] = $row['NamaKelas'];
        $count++;
    }
}
?>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <!-- Page Title and icon -->
        <title>SMPK | <?php echo $title; ?> </title>
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
            <div class="sistem">
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>
            </div>
            <br>
            <a style="font-size:20px;"><u>Laporan <?php echo $title; ?></u></a>
            <br>
            <br>
            <div style="padding: 12px 20px;overflow:auto;height:250px" id="in">
                <center>
                    <table class="table">
                        <tr><th>NoSek</th><th>NamaPelajar</th><th><?php echo $table_3rdElement; ?></th></tr>
                        <?php
                        if ($KodKelas != -1) {
                            for ($a = 0; $a < $initSize; $a++) {
                                if (isset($_NoSek[$a])) {
                                    echo "<tr>";
                                    echo "<td>$_NoSek[$a]</td><td>$_NamaPelajar[$a]</td><td>$_NamaKelab[$a]</td>";
                                    echo "</tr>";
                                }
                            }
                        } else if ($KodKelab != -1) {
                            for ($a = 0; $a < sizeOf($_NoSek); $a++) {
                                echo "<tr>";
                                echo "<td>$_NoSek[$a]</td><td>$_NamaPelajar[$a]</td><td>$_NamaKelas[$a]</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </table>
					<center><button onclick="print();">Print</button></center>

                </center>
            </div>
        </div>

    </center>
</html>
