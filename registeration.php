<?php

if (!empty($_POST["daftar-name"]) && !empty($_POST["daftar-pwd"])) {
    $var_a = $_POST["daftar-name"];
    $var_b = $_POST["daftar-pwd"];
	if(strlen($var_a) > 50){
		echo "<script>alert('Data tidak sah');window.location.replace('index.php');</script>";
		return;
	}
    $_POST = array();
    $conn = new mysqli("localhost", "root", "", "kokurikulum");
    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    }

    $var_a = trim($var_a);
    $var_b = trim($var_b);
    $arr = array();
    $query = $conn->query("SELECT NamaPengguna FROM pengguna");
    if ($query->num_rows > 0) {
        $counter = 0;
        while ($row = $query->fetch_assoc()) {
            $arr[$counter] = $row["NamaPengguna"];
            $counter = $counter + 1;
        }
    }

    $exist = false;
    foreach ($arr as $str) {
        if (strcmp($str, $var_a) == 0) {
            echo "<script>alert('Username already existed');window.location.replace('index.php');</script>";
            $exist = true;
            break;
        }
    }
    try {
        if (!$exist) {
            $sql = "INSERT INTO pengguna (NamaPengguna,KataLaluan) VALUES ('$var_a','$var_b')";
            $conn->query("SELECT * FROM pengguna");
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Pendaftaran Berjaya');window.location.replace('index.php');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } catch (Exception $e) {
        echo "Invalid Username / Password";
    }

    $conn->close();
} else {
    echo "<script>window.location.replace('index.php');alert('Invalid Username / Password');</script>";
}
?>