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

$r = $conn->query("SELECT * FROM pelajar");
while($row = $r->fetch_assoc()){
    if(isset($_POST[$row['NoSek']])){
        $noSek = $row['NoSek'];
        $q = "DELETE FROM pendaftaran WHERE NoSek='$noSek'";
        $q2 = "DELETE FROM pelajar WHERE NoSek='$noSek'";
        mysqli_query($conn,$q)or die(mysqli_error($conn));
        mysqli_query($conn,$q2)or die(mysqli_error($conn));
    }
}
echo "<script>alert('Data Berjaya Dihapuskan');window.location.replace('form-hapus-pelajar.php');</script>";


