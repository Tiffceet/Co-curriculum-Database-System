<?php

session_start();
if (!empty($_POST["login-name"]) && !empty($_POST["login-pwd"])) {
    $conn = new mysqli("localhost", "root", "", "kokurikulum");
    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    }
    $correctUsername = false;
    $correctPwd = false;

    $var_a = $_POST["login-name"];
    $var_b = $_POST["login-pwd"];
	if(strlen($var_a) > 50){
		echo "<script>alert('Data tidak sah');window.location.replace('index.php');</script>";
		return;
	}
    $_POST = array();
    $name = array();
    $pwd = array();

    $query = $conn->query("SELECT NamaPengguna, KataLaluan FROM pengguna");
    if ($query->num_rows > 0) {
        $counter = 0;
        while ($row = $query->fetch_assoc()) {
            $name[$counter] = $row["NamaPengguna"];
            $pwd[$counter] = $row["KataLaluan"];
            $counter = $counter + 1;
        }
    }

    $counter2 = 0;
    while ($counter2 < sizeOf($name)) {
        if (strcmp($name[$counter2], $var_a) == 0) {
            $correctUsername = true;
            if (strcmp($pwd[$counter2], $var_b) == 0) {
                $correctPwd = true;
            }
        }
        $counter2 = $counter2 + 1;
    }

    if ($correctUsername && $correctPwd) {
        $_SESSION['login_user'] = $var_a;
        echo "<script>alert('You are logged in');window.location.replace('index.php');</script>";
    } else {
        echo "<script>alert('Wrong username or password');window.location.replace('index.php');</script>";
    }
} else {
    header("Location: index.php");
}
?>