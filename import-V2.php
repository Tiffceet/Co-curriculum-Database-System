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

// checks file format using substr()
$fileName = $_POST['fileName'];
if (strcmp(strtolower(substr($fileName, -3)), "csv") != 0) {
    echo "<script>alert('Invalid File Format / Missing File');window.location.replace('menu_utama.php');</script>";
    return;
}

$line_count = 1;
$file = fopen($_FILES['actualFile']['tmp_name'], "r");
while ($arr = fgetcsv($file, 1000, ",")) {
    if (!isTableName($arr)) {
        insertData($conn, $table_to_insert, $arr, $line_count);
    } else {
        $table_to_insert = $arr[0];
    }
    $line_count++;
}

echo "<script>alert('Data Berjaya Diimport');window.location.replace('menu_utama.php');</script>"; 

function isTableName($arr) {
    $isTable = false;
    for ($a = 0; $a < sizeOf($arr); $a++) {
        if ($a == 0 && (strcmp(trim(strtolower($arr[0])), "pelajar") == 0 || strcmp(trim(strtolower($arr[0])), "kelab dan persatuan") == 0 || strcmp(trim(strtolower($arr[0])), "kelas") == 0 || strcmp(trim(strtolower($arr[0])), "pendaftaran") == 0)) {
            $isTable = true;
        } else if ($a > 0 && strcmp(trim($arr[$a]), "") != 0) {
            $isTable = false;
        }
    }
    return $isTable;
}

function insertData($connection, $table, $datas, $line_count) {
    switch ($table) {

        case "pelajar":
            if (sizeOf($datas) >= 3) {
                if ($row = $connection->query("SELECT KodKelas from kelas WHERE NamaKelas = '$datas[2]'")->fetch_assoc()) {
                    $kodkelas = $row['KodKelas'];
                    $result = mysqli_query($connection, "INSERT INTO pelajar VALUES('$datas[0]','$datas[1]',$kodkelas)");
                    if ($result === FALSE) {
                        echo "<br><br>" . mysqli_error($connection) . "at Line " . $line_count . "<br><br>";
                    }
                } else {
                    echo "Kelas $datas[2] doesnt exist in db<br>";
                }
            } else {
                echo "invalid data at Line " . $line_count . "<br>";
            }
            break;

        case "kelab dan persatuan":
            if (sizeOf($datas) >= 1) {
                if (!$connection->query("SELECT NamaKelab FROM `kelab dan persatuan` WHERE NamaKelab = '$datas[0]'")->num_rows > 0) {
                    $result = mysqli_query($connection, "INSERT INTO `kelab dan persatuan`(NamaKelab) VALUES('$datas[0]')");
                    if ($result === FALSE) {
                        echo "<br><br>" . mysqli_error($connection) . "at Line " . $line_count . "<br><br>";
                    }
                } else {
                    echo "Kelab already existed on line " . $line_count;
                }
            } else {
                echo "invalid data at Line " . $line_count . "<br>";
            }
            break;

        case "kelas":
            if (sizeOf($datas) >= 1) {
                if (!$connection->query("SELECT NamaKelas FROM kelas WHERE NamaKelas='$datas[0]'")->num_rows > 0) {
                    $result = mysqli_query($connection, "INSERT INTO kelas(NamaKelas) VALUES('$datas[0]')");
                    if ($result === FALSE) {
                        echo "<br><br>" . mysqli_error($connection) . "at Line " . $line_count . "<br><br>";
                    }
                } else {
                    echo "Kelas already existed on line " . $line_count;
                }
            } else {
                echo "invalid data at Line " . $line_count . "<br>";
            }
            break;

        case "pendaftaran":
            if (sizeOf($datas) >= 5) {
                $result = mysqli_query($connection, "INSERT INTO pendaftaran VALUES('$datas[0]',$datas[1],$datas[2],$datas[3],$datas[4])");
                if ($result === FALSE) {
                    echo "<br><br>" . mysqli_error($connection) . "at Line " . $line_count . "<br><br>";
                }
            } else {
                echo "invalid data at Line " . $line_count . "<br>";
            }
            break;
    }
}
