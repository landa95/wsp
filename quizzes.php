<?php
	// Konexioa sortu
	//$sql = mysql_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot') or die(mysql_error());
	// Konexioa egiaztatu
	//mysql_select_db("u275359965_quiz") or die(mysql_error());
	// Konexioa lokala sortu
	$sql = mysql_connect('localhost', 'root', '') or die(mysql_error());
	// Konexioa lokala egiaztatu
	mysql_select_db("quiz") or die(mysql_error());
	session_start();
	if (!isset($_SESSION['erabiltzaile'])){
		header("location: ../login.php");
		
	}
	
	$query = 
	
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
		<script src="../javascript/handling.js"></script>
	</head>
	<body>
			
			<form method="post" enctype="multipart/form-data" id="nickname" name="quiz" action = "" >
			Nickname:<input id="nickname" type= "text" name="nickname" width="100">			
			<input id = "anonimo" type = "button" name= "anonimo" action="galderakErakutsi()"></input>
			</form>
		
		
		<div id="Galdera" style="background-color:#99FF66;">		
			<form method="post" enctype="multipart/form-data" id="quiz" name="quiz" >
			<input id="erantzuna" type= "text" name="erantzuna" width="100">
			<input id = "bidali" type = "button" name ="bidali" onClick=" AJAX">
			</form>
			
		</div>
		<div id="galderakop" style="background-color:#298ff5;">
			<p>Galdera kopurua</p>
		</div>
		<br>
	</body>
</html>