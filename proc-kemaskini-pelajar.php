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

$lowerB = 0;
$upperB = 50;
if(isset($_GET['page'])){
    $page = $_GET['page'];
    $lowerB = (($page - 1) * 50);
    $upperB = $lowerB + 49;
}

$query = $conn->query("SELECT pelajar.NoSek, pelajar.NamaPelajar, pelajar.KodKelas, kelas.NamaKelas FROM pelajar INNER JOIN kelas ON pelajar.KodKelas = kelas.KodKelas LIMIT $lowerB,$upperB;");
while ($row = $query->fetch_assoc()) {
    
    $old_noSek = "_" . $row['NoSek'];
    $real_old_noSek = ltrim($old_noSek, "_");
    $old_name = $row['NamaPelajar'];
    
    // replace all white spaces in oldname with '_' due to stupid POST method
    $old_name_withNoSpace = preg_replace('/\s+/', '_', $old_name);
    
    // refer to form-kemaskini-pelajar.php
    $old_KodKelas = "__" . $row['NoSek'];
    
    $new_noSek = $_POST[$old_noSek];
    $new_name = trim($_POST[$old_name_withNoSpace]);
    $new_KodKelas = $_POST[$old_KodKelas];
    
    // use this if website lags like hell
    // if(strcmp($old_noSek,$new_noSek)!=0 || strcmp($old_name,$new_name)!=0 || strcmp($old_KodKelas,$new_KodKelas)!=0){
    $q = "UPDATE pelajar SET NoSek='$new_noSek', NamaPelajar='$new_name', KodKelas=$new_KodKelas WHERE NoSek='$real_old_noSek'";
    mysqli_query($conn,$q)or die(mysqli_error($conn));
    // }
}
echo "<script>alert('Mengemaskini Berjaya!');window.location.replace('form-kemaskini-pelajar.php?page=$page');</script>";