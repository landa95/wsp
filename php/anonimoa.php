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
	
	$nickname= $_GET['nickname'];
	
	
	echo '<div id = "anonim">
			 <form method="post" enctype="multipart/form-data" id="nicknameform" name="quiz">
			 Nickname:<input id="nickname" type= "text" placehoolder = "user" name="nickname" width="100">			
			 <input id = "anonimo" type = "button" name= "anonimo"value = "OK" onClick="nickName()"></input>
			 </form>';
	echo "Erabiltzailea: ".$nickname;
	echo'<div id = "anonim">';	
	
	$sql="SELECT Galdera, Erantzuna, Zailtasuna FROM galderak";
	$records = mysql_query($sql);
	if (! $records)
	{
		die('Errorea: ' . mysql_error());
	}
	mysql_close();
	
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
		<table width="800" border="1" cellpadding="1" cellspacing="1">
			<tr>
				<th>Galdera</th>
				<th>Zailtasuna</th>
				<th>Erantzuna</th>
				<th>Ondo?</th>
			<tr>
			
			<?php
				while($galderak=mysql_fetch_assoc($records)) {
					echo "<td>".$galderak['Galdera']."</td>";
					echo "<td>".$galderak['Zailtasuna']."</td>";
					$erantzuna= $galderak['Erantzuna'];			
					echo '<div id = "zuzen">';
					echo '<td><form method="post" enctype="multipart/form-data" id="quiz" name="quiz">';
					echo '<input id="erantzuna" type= "text" name="erantzuna" width="100"></td>';
					echo '<td><input id = "bidali" type = "button" value ="check" name ="bidali" onClick= "emaitza()">
						  </form></td>';  
					echo '</div>';	  
					echo "</tr>";
				}
			?>
			
		</table>
	</body>
</html>