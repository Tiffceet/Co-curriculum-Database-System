<?php

session_start();
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
}
if (!isset($_SESSION['login_user']) || time() - $_SESSION['time'] > 1800) {
    header("Location:logout.php");
}
$_SESSION['time'] = time();
require_once('conn.php');

// determine export fileName
$table_to_export = $_POST['tableToExport'];
$output_fileName = trim($table_to_export, '`') . ".csv";

// WARNING : File Created !
// write kind of data to be exported onto first line (will be used during import)
$outputFile = fopen($output_fileName, 'w');
fwrite($outputFile, trim($table_to_export, '`') . "\n");


// determine which  to be used
if (strcmp($table_to_export, "kelas") == 0) {
    $query = "SELECT NamaKelas FROM $table_to_export";
}
if (strcmp($table_to_export, "`kelab dan persatuan`") == 0) {
    $query = "SELECT NamaKelab FROM $table_to_export";
}
if (strcmp($table_to_export, "pelajar") == 0) {
    $query = "SELECT NoSek, NamaPelajar, kelas.NamaKelas FROM $table_to_export INNER JOIN kelas ON pelajar.KodKelas = kelas.KodKelas";
}

$result = $conn->query($query);
if ($result === FALSE) {
    unlink($output_fileName);
    die('Error: Weird File(Wrong Query)');
}
while ($row = $result->fetch_assoc()) {
    foreach ($row as $str) {
        fwrite($outputFile, $str . ",");
    }
    fwrite($outputFile, "\n");
}
fclose($outputFile);
header('Content-type: application/octet-stream');
header('Content-Disposition: inline; filename="' . $output_fileName . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
ob_clean();
flush();
if(readfile($output_fileName)){
    unlink($output_fileName);
}

