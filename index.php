<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <!-- Page Title and icon -->
        <title>SMPK | Login</title>
        <link rel="shortcut icon" type="image/x-icon" href="image/login.png?v=2" />

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/index.css">

        <!-- // Dirty Credit 
        <div>
                Icons made by <a href="https://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel perfect</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
        </div>
        -->
    </head>
    <body>
        <?php
        session_start();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $log = fopen("others/server_log.txt", "a");
        $txt = date("Y/m/d") . " " . date("h:i:sa") . " " . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
        fwrite($log, $txt);
        fclose($log);
        if (isset($_SESSION['login_user'])) {
            header("Location: menu_utama.php");
        }
        ?>
        <br>

        <br>
    <center>
        <center>
            <div><img style="border:10px solid rgba(255,255,255,0.5);border-radius:50%;" src="image/IndexLogo.JPG" alt="Logo" style="width:200px;height:250px;"></div>
        </center>
        <div class="login">
            <div class="sistem" id="title">
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>
            </div>
            <br>
            <form action="login-processing.php" method="post">
                Nama Pengguna
                <br>
                <input placeholder="Masukkan NamaPengguna" name="login-name" type="text" onkeypress="return onlyAlphabets(event, this);" required></input>
                <br>
                Kata Laluan
                <br>
                <input placeholder="Masukkan Kod Laluan" name="login-pwd" type="password" required></input>
                <br>
                <a id="register" style="cursor:pointer;color:blue;"><u>Pengguna Baharu?</u></a>
                <br><br>
                <input type="submit" value="Log Masuk"></input> 
            </form>
        </div>
    </center>

    <!-- The hidden box-kun -->
    <div class="registerKun">
        <div class="registerKun-content">
            <div class="sistem">
                <span class="close">&times;</span>
                <h3><u>Sistem Maklumat Pendaftaran Kelab dan Persatuan</u></h3>
            </div>
            <br>
            <form action="registeration.php" method="post" onsubmit="return validate(event);">
                NamaPengguna
                <br>
                <input name="daftar-name" class="daftar" type="text" onkeypress="return onlyAlphabets(event, this);" required></input>
                <br>
                Kata Laluan
                <br>
                <input name="daftar-pwd" class="daftar" type="password" required></input>
                <br>
                <br>
                <input type="submit" value="Mendaftar"></input> 
            </form>
        </div>
    </div>
    <script src="js/index.js"></script>
    <script>
                    document.getElementById('title').scrollIntoView();
    </script>
</body>
</html>