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

function getkP_and_kelab($str) {
    $arr = [];
    $arr[0] = strstr($str, "_", true);
    $arr[1] = ltrim(strstr($str, "_"), '_');
    return $arr;
}

for ($a = 0; $a < sizeOf($_kodPendaftaran); $a++) {
    $name = $_kodPendaftaran[$a] . "_kelab"; 
    $kpAndKelab = $_POST[$name];
    $kP = getkP_and_kelab($kpAndKelab)[0];
    $kelab = getkP_and_kelab($kpAndKelab)[1];
    $query = "UPDATE pendaftaran SET KodKelab=$kelab WHERE KodPendaftaran=$kP";
    mysqli_query($conn,$query)or die(mysqli_error($conn));
}
echo "<script>alert('Mengemaskini Berjaya!');window.location.replace('form-kemaskini.php');</script>";
