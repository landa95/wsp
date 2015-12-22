<?php
	// Konexioa sortu
	//$sql = mysqli_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot', 'u275359965_quiz');
	// Konexioa lokala sortu
	$sql = mysqli_connect('localhost', 'root', '', 'quiz');
	// Konexioa egiaztatu
	if (mysqli_connect_errno())
	{
		echo "Errorea MYSQLera konektatzean: " . mysqli_connect_error();
	}
	
	session_start();
	
	$nickname= $_GET['nickname'];
	
	
	echo '<form method="post" enctype="multipart/form-data" id="nicknameform" name="quiz">
			 Nickname:<input id="nickname" type= "text" placehoolder = "user" name="nickname" width="100">			
			 <input id = "anonimo" type = "button" name= "anonimo"value = "OK" onClick="nickName()"></input>
			 </form>';
	echo "Erabiltzailea: ".$nickname;
	
	$query= mysqli_query($sql, "SELECT Galdera, Erantzuna, Zailtasuna FROM galderak");
	if(!$query)
	{
		echo('Errorea: ' . mysqli_error($sql));
	}
	mysqli_close($sql);
	
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
				$id = 1;
				while($galderak=mysqli_fetch_assoc($query)) {
					echo '<form method="post" enctype="multipart/form-data" id="quiz" name="quiz">';
					echo '<td><p id="galdera'.$id.'">'.$galderak['Galdera']."</p></td>";
					echo "<td>".$galderak['Zailtasuna']."</td>";
					$erantzuna= $galderak['Erantzuna'];			
					echo '<td>';
					echo '<input id="erantzuna'.$id.'" type= "text" name="erantzuna" width="100"></td>';
					echo '<td><div id = "zuzen"><input id = "bidali" type = "button" value ="check" name ="bidali" onClick= "emaitza('.$id.')"></div></form></td>';  
					echo "</tr>";
					++$id;
				}
			?>
			
		</table>
	</body>
</html>