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

for ($a = 0; $a < sizeOf($_kodPendaftaran); $a++) {
    if(isset($_POST[$_kodPendaftaran[$a]])){
        $kP = $_kodPendaftaran[$a];
        $q = "DELETE FROM pendaftaran WHERE KodPendaftaran=$kP";
        mysqli_query($conn,$q)or die(mysqli_error($conn));
    }
}
echo "<script>alert('Data Berjaya Dihapuskan');window.location.replace('form-hapus.php');</script>";


