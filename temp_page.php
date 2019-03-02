<?php 
	session_start(); 
	if(!isset($_SESSION['time'])){
		$_SESSION['time'] = time();	
	}
	if(!isset($_SESSION['login_user']) || time() - $_SESSION['time'] > 100){
		header("Location:/logout.php");
	}
	$_SESSION['time'] = time();
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
	<title>SMPK | TempPage</title>
	<link rel="shortcut icon" type="image/x-icon" href="/image/login.png?v=2" />
	<link rel="stylesheet" type="text/css" href="/css/temp_page.css">
</head>
<body>
	<p>User : <?php echo $_SESSION['login_user'];?></p>
	<p>wanna help designing Main Menu? Tell me! :3</p>
	<br>
	<div class="box">
		<a href="/logout.php"><button class="headback">Fuck this shit im going back (LOG OUT)</button></a>
		<form action="/temp_comment.php" method="POST">
			Enter Comment : <input name="comment" class="comment-input"></input>
		</form>
		<div class="comment-inside">
			<?php
				$file = file_get_contents("others/comments.txt");
				$arr = explode("\n",$file);
				foreach($arr as $str){
					echo $str . "<br>";
				}
			?>
		</div>
	</div>
</body>
<body><script src="/js/temp_page.js"></script></body>
</html>