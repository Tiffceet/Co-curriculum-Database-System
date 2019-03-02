<?php
    session_start(); 
	if(!isset($_SESSION['time'])){
		$_SESSION['time'] = time();	
	}
	if(!isset($_SESSION['login_user']) || time() - $_SESSION['time'] > 100){
		header("Location:/logout.php");
	}
    $_SESSION['time'] = time();
    
    $comment = htmlspecialchars(trim($_POST['comment']));
    if(trim($_POST['comment'])==false){
        header("Location:/temp_page.php"); 
    } else {
        $file = fopen("others/comments.txt","a");
        $txt = $_SESSION['login_user'] . " : " . $comment . PHP_EOL;
        fwrite($file,$txt);
        fclose($file);
        header("Location:/temp_page.php");
    }
?>