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

$kelas = $_POST['Kelas'];
$kelab = $_POST['Kelab'];
$kelab = ltrim($kelab, ',');
$kelab = rtrim($kelab, ',');
$kelas = ltrim($kelas, ',');
$kelas = rtrim($kelas, ',');
if(empty($kelas) && empty($kelab)){
    echo "<script>alert('Both field cant be empty');window.location.replace('menu_utama.php');</script>";
}

$_kelas = explode(",", $kelas);
$_kelab = explode(",", $kelab);
if (!empty($kelas)) {
    for ($i = 0; $i < sizeOf($_kelas); $i++) {
        $temp = trim($_kelas[$i]);
        $query = "INSERT INTO kelas(NamaKelas) VALUES('$temp')";
        mysqli_query($conn, $query)or die(mysqli_error($conn));
    }
}
if (!empty($kelab)) {
    for ($i = 0; $i < sizeOf($_kelab); $i++) {
        $temp = $_kelab[$i];
        $query = "INSERT INTO `kelab dan persatuan`(NamaKelab) VALUES('$temp')";
        mysqli_query($conn, $query)or die(mysqli_error($conn));
    }
}

echo "<script>alert('Kelas dan Kelab ditambah');window.location.replace('menu_utama.php');</script>";


