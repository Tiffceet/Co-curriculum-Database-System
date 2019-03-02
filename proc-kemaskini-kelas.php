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

$result = $conn->query('SELECT * from kelas');
while ($row = $result->fetch_assoc()) {
    $kodKelas = $row['KodKelas'];
    $new_NamaKelas = $_POST[$kodKelas];
    $q = "UPDATE kelas SET NamaKelas='$new_NamaKelas' WHERE KodKelas=$kodKelas";
    mysqli_query($conn,$q)or die(mysqli_error($conn));
}

$result = $conn->query('SELECT * from `kelab dan persatuan`');
while ($row = $result->fetch_assoc()) {
    $originalKodKelab=$row['KodKelab'];
    $kodKelab = "_" . $row['KodKelab'];
    $new_NamaKelab = $_POST[$kodKelab];
    $q = "UPDATE `kelab dan persatuan` SET NamaKelab='$new_NamaKelab' WHERE KodKelab=$originalKodKelab";
    mysqli_query($conn,$q)or die(mysqli_error($conn));
}
echo "<script>alert('Mengemaskini Berjaya!');window.location.replace('form-kemaskini-kelas.php');</script>";