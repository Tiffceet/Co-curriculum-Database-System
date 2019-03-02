<style>
    @font-face {
        font-family:"Jose";
        src:url("fonts/JosefinSlab-Bold.ttf");
    }



    /* Fade in Animation */
    @keyframes fadein {
        from {opacity: 0;}
        to   {opacity: 1;}
    }

    @keyframes popout {
        from {height: 1px;}
        to   {height: 600px;}
    }

    @keyframes popout-400px {
        from {height: 1px;}
        to   {height: 400px;}
    }

    @keyframes popout-350px {
        from {height: 1px;}
        to   {height: 350px;}
    }

    /* Pop-up box*/
    .box-kun {
        display: none;  /* Hidden by default */
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Enable scrolling if needed */
        background-color: rgba(0,0,0,0.8);
    }

    /* Pop up Box content*/
    .box-content{
        background-color: rgba(255,255,255,0.5);
        margin: 1% auto;
        text-align:center;
        height: 600px;
        width: 400px; /* Could be more or less, depending on screen size */
        animation: popout .75s;
        border-radius:10px;
    }

    /* Overwrite box-content for sake of Report */
    #report {
        text-align: right;
    }

    /* Overwrite kemaskini box-content */
    #kemaskini {
        height: 400px;
        animation: popout-400px .75s;
    }

    .close{
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor:pointer;
    }

    /* User input box */
    input[type=password], input[type=text], input[type=number], select {
        text-align:center;
        width: 90%;
        padding: 12px 20px;
        margin: 8px 0;
        border-top:white; 
        /* border-color:white; */
        /* border-bottom-color:rgba(0,0,0,0.2); */
        border-top-color:rgba(0,0,0,0.2); 
        box-sizing: border-box; 
        box-shadow: 0 1px 1px 1px rgba(0,0,0,0.2);
        border-radius:10px;
    }

    /* Overwrite width for smaller width */
    /* Used on: Report, Import */
    input.smaller, select.smaller {
        width:60%;
    }

    /* Login Box - Title */
    .sistem {
        text-align:center;
        font-family:Segoe Print !important;
        background-color:green;
        padding: 20px 10px;
        border-radius:10px;
    }

    .sistem u{
        font-family:Segoe Print !important;
        font-size:20px !important;
    }

    /* Glow when user select any input box */
    input[type=password]:focus, input[type=text]:focus, input[type=number]:focus, select.focus {
        outline:none;
        box-shadow: 0 0 3pt 2pt grey;
    }

    input[type=password].daftar:focus, input[type=text].daftar:focus {
        outline:none;
        box-shadow: 0 0 3pt 2pt blue;
    }

    /* Submit Button */
    input[type=submit] {
        background-color: blue;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 0 5px 0 rgba(0,0,0,0.2);
        position:relative;
    }

    /* Lower Box-shadow to have button pressed effect */
    input[type=submit]:active {
        box-shadow: 0 3px 0 rgba(0,0,0,0.2);
        top:3px;
    }

    button.btn, label.btn{
        background-color: blue;
        width: 150px;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 0 5px 0 rgba(0,0,0,0.2);
        position:relative;
    }

    button.btn:active, label.btn:active {
        box-shadow: 0 3px 0 rgba(0,0,0,0.2);
        top:3px;
    }

    .left-align {
        text-align: left;
        padding: 12px 40px;
    }


</style>
<!-- Menambah Data -->
<div class="box-kun" id="tambah-data-box">
    <div class="box-content" id="tambah-data-box-content">
        <div class="sistem">
            <span class="close highest" id="tambah-data-close">&times;</span>
            <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>            
        </div>
        <br>
        <a style="font-size:20px;"><u>Menambah Data</u></a>
        <br>
        <br>
        <form action="proc-tambahData.php" method="POST">
            NamaMurid
            <input type="text" name="nama" id="NamaPelajar" onkeyup="nameChk();"></input>

            NoSek
            <input type="number" name="nosek" id="NoSek"></input>

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
            <span class="close highest" id="KelasBaharu-close">&times;</span>
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
            <span class="close highest" id="kemaskini-box-close">&times;</span>
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
            <span class="close highest" id="hapus-box-close">&times;</span>
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
            <span class="close highest" id="report-box-close">&times;</span>
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
            <span class="close highest" id="import-box-close">&times;</span>
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
            <span class="close highest" id="export-box-close">&times;</span>
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