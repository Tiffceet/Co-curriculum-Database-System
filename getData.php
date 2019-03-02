<?php

include('conn.php');
$_kodPendaftaran = array();
$_kodPengguna = array();
$_noSek = array();
$_namaMurid = array();
$_kodKelas = array();
$_namaKelas = array();
$_kodKelab = array();
$_kelabDisertai = array();

$count = 0;

$query = $conn->query("SELECT pendaftaran.KodPendaftaran, pendaftaran.KodPengguna, pendaftaran.NoSek, pelajar.NamaPelajar, kelas.KodKelas, kelas.NamaKelas, pendaftaran.KodKelab,`kelab dan persatuan`.NamaKelab
FROM pendaftaran
INNER JOIN pelajar ON pendaftaran.NoSek = pelajar.NoSek
INNER JOIN `kelab dan persatuan` ON pendaftaran.KodKelab = `kelab dan persatuan`.KodKelab
INNER JOIN kelas ON pelajar.KodKelas = kelas.KodKelas");
while ($row = $query->fetch_assoc()) {
    $_kodPendaftaran[$count] = $row['KodPendaftaran'];
    $_kodPengguna[$count] = $row['KodPengguna'];
    $_noSek[$count] = $row['NoSek'];
    $_namaMurid[$count] = $row['NamaPelajar'];
    $_kodKelas[$count] = $row['KodKelas'];
    $_namaKelas[$count] = $row['NamaKelas'];
    $_kodKelab[$count] = $row['KodKelab'];
    $_kelabDisertai[$count] = $row['NamaKelab'];
    $count++;
}