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
$NamaPengguna = $_SESSION['login_user'];
$file = "../../htdocs/sistem/$NamaPengguna-Pendaftaran.sql";
$file2 = "../../htdocs/sistem/$NamaPengguna-Pengguna.sql";
$file3 = "../../htdocs/sistem/$NamaPengguna-kelas.sql";
$file4 = "../../htdocs/sistem/$NamaPengguna-kelab.sql";
$file5 = "../../htdocs/sistem/$NamaPengguna-pelajar.sql";
$outputFile = "$NamaPengguna-out.export";
mysqli_query($conn,"SELECT * INTO OUTFILE '$file' FROM pendaftaran")or die(mysqli_error($conn));
mysqli_query($conn,"SELECT * INTO OUTFILE '$file2' FROM pengguna")or die(mysqli_error($conn));
mysqli_query($conn,"SELECT * INTO OUTFILE '$file3' FROM kelas")or die(mysqli_error($conn));
mysqli_query($conn,"SELECT * INTO OUTFILE '$file4' FROM `kelab dan persatuan`")or die(mysqli_error($conn));
mysqli_query($conn,"SELECT * INTO OUTFILE '$file5' FROM pelajar")or die(mysqli_error($conn));
$zip = new ZipArchive;
$zip->open($outputFile, ZipArchive::CREATE);
$zip->addFile("$NamaPengguna-Pendaftaran.sql");
$zip->addFile("$NamaPengguna-Pengguna.sql");
$zip->addFile("$NamaPengguna-kelas.sql");
$zip->addFile("$NamaPengguna-kelab.sql");
$zip->addFile("$NamaPengguna-pelajar.sql");
$zip->close();
unlink("$NamaPengguna-Pendaftaran.sql");
unlink("$NamaPengguna-Pengguna.sql");
unlink("$NamaPengguna-kelas.sql");
unlink("$NamaPengguna-kelab.sql");
unlink("$NamaPengguna-pelajar.sql");

header('Content-type: application/octet-stream');
header('Content-Disposition: inline; filename="' . $outputFile . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
ob_clean();
flush();
if(readfile($outputFile)){
    unlink($outputFile);
}


