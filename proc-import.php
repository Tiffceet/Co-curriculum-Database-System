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

$file = fopen($_FILES['actualFile']['tmp_name'], "r");

// interpreting csv file -- testing in progress
$count = 2;

$first_line = fgets($file);
$first_row = explode(",", $first_line);
$table_to_add = $first_row[0];

// echo $table_to_add;
if (strcmp(trim(strtolower($table_to_add)), "pelajar") != 0 && strcmp(trim(strtolower($table_to_add)), "kelas") != 0 && strcmp(trim(strtolower($table_to_add)), "kelab dan persatuan") != 0) {
    die("Invalid CSV file (Please include **type of data to add into first row of CSV file) **Supported type of data(kelas, pelajar, kelab dan persatuan)");
} else if (trim(strtolower($table_to_add)) == "pelajar") {
    while ($line = fgetcsv($file, 1000, ",")) {
        
        // echo "Line " . $count . ": " . trim($arr[0]) . ", " . trim($arr[1]) . ", " . trim($arr[2]) . "<br>";
        // $count++;
        $query = "INSERT INTO pelajar VALUES('$line[0]','$line[1]',$line[2])";

        $testing = mysqli_query($conn, $query);
        if ($testing === FALSE) {
            $err = mysqli_error($conn);
            echo "<script>console.log('$err','at Line ','$count');</script>";
        }

        $count++;

        //var_dump($arr);
        //echo "<br><br>";
    }
} else if (trim(strtolower($table_to_add)) == "kelas") {
    while ($line = fgetcsv($file, 1000, ",")) {
        

        // echo "Line " . $count . ": " . trim($arr[0]) . ", " . trim($arr[1]) . ", " . trim($arr[2]) . "<br>";
        // $count++;

        $query = "INSERT INTO kelas(NamaKelas) VALUES('$line[0]')";

        $testing = mysqli_query($conn, $query);
        if ($testing === FALSE) {
            $err = mysqli_error($conn);
            echo "<script>console.log('$err','at Line ','$count');</script>";
        }

        $count++;

        //var_dump($arr);
        //echo "<br><br>";
    }
} else if (trim(strtolower($table_to_add)) == "kelab dan persatuan") {
    while ($line = fgetcsv($file, 1000, ",")) {

        // echo "Line " . $count . ": " . trim($arr[0]) . ", " . trim($arr[1]) . ", " . trim($arr[2]) . "<br>";
        // $count++
        $query = "INSERT INTO `kelab dan persatuan`(NamaKelab) VALUES('$line[0]')";

        $testing = mysqli_query($conn, $query);
        if ($testing === FALSE) {
            $err = mysqli_error($conn);
            echo "<script>console.log('$err','at Line ','$count');</script>";
        }

        $count++;

        //var_dump($arr);
        //echo "<br><br>";
    }
}
echo "<script>window.location.replace('menu_utama.php');</script>";