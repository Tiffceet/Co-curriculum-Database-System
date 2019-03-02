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

$fileName = $_POST['fileName'];
if (strcmp(substr($fileName, -1), "t") != 0) {
    echo "<script>alert('Invalid File Format / Missing File');window.location.replace('menu_utama.php');</script>";
    return;
}
$user = $_SESSION['login_user'];
$info = pathinfo($_FILES['file']['name']);
$userFile = "others/" . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $userFile)) {
    echo $user;
    $zip = new ZipArchive;
    $res = $zip->open('others/' . basename($_FILES['file']['name']));
    if($res === TRUE){
        $zip->extractTo('others/');
        $zip->close();
    }
} else {
    return;
}

$file1 = "../../htdocs/sistem/others/".$user.'-Pendaftaran.sql';
$file2 = "../../htdocs/sistem/others/".$user.'-Pengguna.sql';
$file3 = "../../htdocs/sistem/others/".$user.'-kelas.sql';
$file4 = "../../htdocs/sistem/others/".$user.'-kelab.sql';
$file5 = "../../htdocs/sistem/others/".$user.'-pelajar.sql';
mysqli_query($conn,"LOAD DATA INFILE '$file3' INTO TABLE kelas");
mysqli_query($conn,"LOAD DATA INFILE '$file4' INTO TABLE `kelab dan persatuan`");
mysqli_query($conn,"LOAD DATA INFILE '$file5' INTO TABLE pelajar");
mysqli_query($conn,"LOAD DATA INFILE '$file2' INTO TABLE pengguna");
mysqli_query($conn,"LOAD DATA INFILE '$file1' INTO TABLE pendaftaran");





unlink($file1);
unlink($file2);
unlink($file3);
unlink($file4);
unlink($file5);
unlink("others/".basename($_FILES['file']['name']));


