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

// get data from pelajar for menambah data form
$count = 0;
$_NoSek = [];
$_NamaPelajar = [];
$_KodKelas = [];
$r = $conn->query("SELECT * FROM pelajar");
while ($row = $r->fetch_assoc()) {
    $_NoSek[$count] = $row['NoSek'];
    $_NamaPelajar[$count] = $row['NamaPelajar'];
    $_KodKelas[$count] = $row['KodKelas'];
    $count++;
}
$size = $count + 1;
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SMPK | Menu Utama</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/login.png?v=2" />
        <link rel="stylesheet" type="text/css" href="css/menu.css">
    </head>
    <body>
    <center>
        <div><img style="border:10px solid rgba(255,255,255,0.5);border-radius:50%;" src="image/IndexLogo.JPG" alt="Logo" style="width:200px;height:250px;"></div>
    </center>
    <br>
    <center>
        <div class="menu">
            <div id="title" class="sistem">
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>
            </div>
            <br>
            <a style="font-size:20px !important;"><u>Menu</u></a>
            <br>
            <br>
            <div class="left-align">
                <button class="btn" id="tambah-data">Pendaftaran</button>
                <button class="btn" style="float:right;" id="hapus-btn">Menghapus Data</button>
                <br><br>
            </div>
            <div class="left-align">
                <button class="btn" id="kemaskini-btn">Mengemaskini</button>
                <button class="btn" style="float:right;" id="report-btn">Report</button>
                <br><br>
            </div>

            <div class="left-align">
                <center><a id='import-btn' onclick="alert('Think about it. If export doesnt exist, how does one import?');" style="cursor:pointer;float:contour;color:blue;pointer:cursor;"><u>Import Data?</u></a></center>
                <!-- <center><a onclick="window.location.replace('proc-export.php');" style="cursor:pointer;float:contour;color:blue;pointer:cursor;"><u>Export Data?</u></a></center> -->
                <center><a id="export-btn" style="cursor:pointer;float:contour;color:blue;pointer:cursor;"><u>Export Data?</u></a></center>
                <a href="logout.php"><button class="btn" style="float:right;">Log Keluar</button></a>
                <br><br>
            </div>
        </div>
    </center>

    <!-- Menambah Data -->
    <div class="box-kun" id="tambah-data-box">
        <div class="box-content">
            <div class="sistem">
                <span class="close" id="tambah-data-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>            
            </div>
            <br>
            <a style="font-size:20px;"><u>Menambah Data</u></a>
            <br>
            <br>
            <form action="proc-tambahData.php" method="POST">
                NamaMurid
                <input type="text" name="nama" placeholder="XXX XXX XXX" id="NamaPelajar" onkeyup="nameChk();"></input>

                NoSek
                <input type="number" placeholder="XXXXX" name="nosek" id="NoSek"></input>

                NamaKelas
                <select name="kelas" id="KodKelas">
                    <option value="-1">Pilih Kelas</option>
                    <?php
                    $q = $conn->query('SELECT * FROM kelas');
                    while ($row = $q->fetch_assoc()) {
                        echo "<option value='", $row['KodKelas'], "'>", $row['NamaKelas'], "</option>";
                    }
                    ?>
                </select>

                Kelab yang Disertai
                <select name="kelab">
                    <option value="-1">Pilih Kelab</option>
                    <?php
                    $q = $conn->query('SELECT * FROM `kelab dan persatuan`');
                    while ($row = $q->fetch_assoc()) {
                        echo "<option value='", $row['KodKelab'], "'>", $row['NamaKelab'], "</option>";
                    }
                    ?>
                </select>
                <br>
                <a id="KelasBaharu-btn" style="cursor:pointer;color:blue;"><u>Kelas Atau Kelab Baharu?</u></a>
                <br>
                <input type="submit" value="Menambah"></input>
            </form>
        </div>
    </div>

    <!-- New Class or Kelab -->
    <div class="box-kun" id="KelasBaharu">
        <div class="box-content">
            <div class="sistem">
                <span class="close" id="KelasBaharu-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>    
            </div>

            <br>
            <a style="font-size:20px;"><u>Menambah Kelas / Kelab</u></a>
            <br>
            <br>

            <form action="proc-addClass.php" method="POST">
                Kelas Baharu:
                <br>
                <input name="Kelas" type="text"></input>
                <br>
                Kelab Baharu:
                <br>
                <input name="Kelab" type="text"></input>
                <br>
                *Jika banyak data perlu ditambahkan, gunakan simbol ',' untuk asingkan
                <br><br>
                <input type="submit" value="Tambah"></input> 
            </form>

        </div>
    </div>

    <!-- KemasKini Box-->
    <div class="box-kun" id="kemaskini-box">
        <div class="box-content" id="kemaskini">
            <div class="sistem">
                <span class="close" id="kemaskini-box-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>    
            </div>
            <br>
            <button class="btn" id="kemaskini-kelab">Mengemaskini Kelab yang disertai pelajar</button>
            <br><br>
            <button class="btn" id="kemaskini-pelajar">Mengemaskini Maklumat Pelajar</button>
            <br><br>
            <button class="btn" id="kemaskini-kelas">Mengemaskini Maklumat Kelas & Kelab</button>
            <br>

        </div>
    </div>

    <!-- Hapus Data Box -->
    <div class="box-kun" id="hapus-box">
        <div class="box-content" id="kemaskini">
            <div class="sistem">
                <span class="close" id="hapus-box-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>    
            </div>
            <br>
            <button class="btn" id="hapus-kelab">Menghapus Kelab yang disertai pelajar</button>
            <br><br>
            <button class="btn" id="hapus-pelajar">Menghapus Maklumat Pelajar</button>
            <br><br>
            <button class="btn" id="hapus-kelas">Menghapus Maklumat Kelas & Kelab</button>
            <br>

        </div>
    </div>

    <!-- Report Box -->
    <div class="box-kun" id="report-box">
        <div class="box-content" id="report">
            <div class="sistem">
                <span class="close" id="report-box-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>    
            </div>
            <br>
            <center><u style='font-size: 20px;'>Report</u></center>
            <br>
            <form action="Report.php" method="POST" id='reportForm'>
                Kelas:
                <select class='smaller' name='KodKelas' id="kelas" onchange="document.getElementById('kelab').selectedIndex = 0;">
                    <option value="-1">Pilih Kelas</option>
                    <?php
                    $r2 = $conn->query("SELECT * FROM kelas");
                    while ($row = $r2->fetch_assoc()) {
                        $KodKelas = $row['KodKelas'];
                        $NamaKelas = $row['NamaKelas'];
                        echo "<option value='$KodKelas'>$NamaKelas</option>";
                    }
                    ?>
                </select>
                <br>
                <center><a style="font-size:20px;">ATAU</a></center>
                Kelab & Persatuan:
                <select class='smaller' name='KodKelab' id="kelab" onchange="document.getElementById('kelas').selectedIndex = 0;">
                    <option value="-1">Pilih Kelab atau Persatuan</option>
                    <?php
                    $r2 = $conn->query("SELECT * FROM `kelab dan persatuan`");
                    while ($row = $r2->fetch_assoc()) {
                        $KodKelab = $row['KodKelab'];
                        $NamaKelab = $row['NamaKelab'];
                        echo "<option value='_$KodKelab'>$NamaKelab</option>";
                    }
                    ?>
                </select>

                <div style="padding: 15px 20px;overflow:hidden">
                    <input type='submit' style="float:right;" class="btn" value='Papar Laporan'  id="report-form-submit-btn"></input>
                    <button type='button' style="float:left;text-align:center;" class="btn" id="report-box-close2">Menu</button>
                </div>
            </form>
            <br>

        </div>
    </div>

    <!-- Import Box -->
    <div class="box-kun" id="import-box">
        <div style="width:500px;height:350px;animation: popout-350px .75s;" class="box-content" id="import">
            <div class="sistem">
                <span class="close" id="import-box-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>    
            </div>
            <br>
            <center><u style='font-size: 20px;'>Import Data</u></center>
            <br>
            <form action="import-V2.php" method="POST" enctype='multipart/form-data'>
                Nama Fail:
                <input name="fileName" readonly style="width:40%;" type="text" id="fileName"></>
                <input name="actualFile" style="opacity:0;position:absolute;z-index:-1;" name="file" type="file" id="importFile"></>
                <label for="importFile" class="btn">Browse...</label>
                <br>
                <input type="submit" value="Import"></input>
            </form>
            <br>

        </div>
    </div>

    <!-- Export Box -->
    <div class="box-kun" id="export-box">
        <div style="width:500px;height:350px;animation: popout-350px .75s;" class="box-content" id="export">
            <div class="sistem">
                <span class="close" id="export-box-close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>    
            </div>
            <br>
            <center><u style='font-size: 20px;'>Export Data</u></center>
            <br>
            <form action="proc-Export.php" method="POST">
                Pilih Data
                <select name="tableToExport" style="width:40%;" type="text" id="fileName">
                    <option value="kelas">kelas</option>
                    <option value="`kelab dan persatuan`">kelab</option>
                    <option value="pelajar">pelajar</option>
                </select>

                <br>
                <input type="submit" value="Export"></input>
            </form>
            <br>

        </div>
    </div>

    <script src="js/menu.js"></script>
    <?php
    // Reopens Tambah Data form if user added a new entry and encounterd a refresh
    if (isset($_SESSION['openTambah'])) {
        echo "<script>opensTambah();</script>";
        unset($_SESSION['openTambah']);
    }
    ?>
</body>
<script>
                    document.getElementById('fileName').value = "";
                    document.getElementById('importFile').value = "";
                    document.getElementById('title').scrollIntoView();
</script>
<script>
    function nameChk() {
        console.log('function ran');
        var size = <?php echo $size; ?>;
        var name = document.getElementById("NamaPelajar").value;
        var NoSek = <?php echo json_encode($_NoSek); ?>;
        var NamaPelajar = <?php echo json_encode($_NamaPelajar); ?>;
        var KodKelas = <?php echo json_encode($_KodKelas); ?>;
        for (i = 0; i < size; i++) {
            // console.log("Name: " + name + " NamaPelajar: " + NamaPelajar[i] + " Result: " + name.localeCompare(NamaPelajar[i]));
            if (name.localeCompare(NamaPelajar[i]) === 0) {
                document.getElementById("NamaPelajar").setAttribute('value', NamaPelajar[i]);
                document.getElementById("NoSek").setAttribute('value', NoSek[i]);
                document.getElementById("KodKelas").value = KodKelas[i];
                break;
            }
        }
        return true;
    }
</script>
</html>
