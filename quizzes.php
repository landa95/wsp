<?php
	// Konexioa sortu
	$sql = mysqli_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot', 'u275359965_quiz');
	// Konexioa lokala sortu
	//$sql = mysqli_connect('localhost', 'root', '', 'quiz');
	// Konexioa egiaztatu
	if (mysqli_connect_errno())
	{
		echo "Errorea MYSQLera konektatzean: " . mysqli_connect_error();
	}
	session_start();

	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Galderak gehitu</title>
		<link rel='stylesheet' type='text/css' href='stylesPWS/style.css'>
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='stylesPWS/wide.css'>
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='stylesPWS/smartphone.css'>
		<script src="javascript/galderak.js"></script>
	</head>
	<body>
		<div id = "anonim">
			<form method="post" enctype="multipart/form-data" id="nicknameform" name="quiz">
				Nickname:<input id="nickname" type= "text" name="nickname" placeholder="user" width="100">			
				<input id = "anonimo" type = "button" name= "anonimo"value = "OK" onClick="nickName()"></input>
			</form>
		</div>
		<a href="layout.html">Atzera</a><br>
	</body>
</html>