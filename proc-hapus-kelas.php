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
$r = $conn->query("SELECT * FROM kelas");
$r2= $conn->query("SELECT * FROM `kelab dan persatuan`");

while($row = $r->fetch_assoc()){
    $KodKelas = $row['KodKelas'];
    if(isset($_POST[$KodKelas])){
        $kelas_query = "SELECT * FROM pelajar WHERE KodKelas=$KodKelas";
        $kelas_result = $conn->query($kelas_query);
        while($row2 = $kelas_result->fetch_assoc()){
            $temp_nosek = $row2['NoSek'];
            $q = "DELETE FROM pendaftaran WHERE NoSek='$temp_nosek'";
            mysqli_query($conn,$q)or die(mysqli_error($conn));
        }
        $q2 = "DELETE FROM pelajar WHERE KodKelas=$KodKelas";
        $q3 = "DELETE FROM kelas WHERE KodKelas=$KodKelas";
        mysqli_query($conn,$q2)or die(mysqli_error($conn));
        mysqli_query($conn,$q3)or die(mysqli_error($conn));
    }
}

while($row = $r2->fetch_assoc()){
    $KodKelab = "_" . $row['KodKelab'];
    $real_KodKelab = ltrim($KodKelab, "_");
    if(isset($_POST[$KodKelab])){
        $q = "DELETE FROM pendaftaran WHERE KodKelab=$real_KodKelab";
        $q2 = "DELETE FROM `kelab dan persatuan` WHERE KodKelab=$real_KodKelab";
        mysqli_query($conn,$q)or die(mysqli_error($conn));
        mysqli_query($conn,$q2)or die(mysqli_error($conn));
    }
}

echo "<script>alert('Data Berjaya Dihapuskan');window.location.replace('form-hapus-kelas.php');</script>";
