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
if (!empty($_POST['nama']) && !empty($_POST['nosek'])) {
    $namaMurid = trim($_POST['nama']);
    $noSek = $_POST['nosek'];
    $kodKelas = $_POST['kelas'];
    $kodKelab = $_POST['kelab'];
    $user = $_SESSION['login_user'];
    $kP = -1;
    
    // checks whether this pelajar alrdy registred this kelab
    $test = $conn->query("SELECT * FROM pendaftaran WHERE NoSek='$noSek' AND KodKelab=$kodKelab");
    if($test->num_rows > 0){
        echo "<script>alert('Pelajar ini telah menyertai kelab tersebut');window.location.replace('menu_utama.php');</script>";
        return;
    }
    
    if ($kodKelab == -1 || $kodKelas == -1) {
        echo "<script>alert('Sila pilih kelas/kelab');window.location.replace('menu_utama.php');</script>";
        return;
    }
    $row = $conn->query("SELECT * FROM pelajar WHERE NoSek='$noSek';")->num_rows;
    if ($row == 0) {
        mysqli_query($conn, "INSERT INTO pelajar VALUES('$noSek', '$namaMurid', '$kodKelas');");
    }

    $query = $conn->query("SELECT KodPengguna FROM pengguna WHERE NamaPengguna='$user'");
    while ($row = $query->fetch_assoc()) {
        $kP = $row['KodPengguna'];
    }

    $query2 = "INSERT INTO `pendaftaran` (TarikhPendaftaran, KodPengguna, KodKelab, NoSek) VALUES(now(), $kP, $kodKelab, '$noSek')";
    mysqli_query($conn, $query2)or die(mysqli_error($conn));
    $_SESSION['openTambah'] = 1;
    echo "<script>alert('Tamabahan Data Berjaya');window.location.replace('menu_utama.php');</script>";
    
} else {
    header('Location: menu_utama.php');
}
