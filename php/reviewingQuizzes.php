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
	
	if($_SESSION['erabiltzaile'] != "web000@ehu.es"){
			
			header("location:../layout.html");
		}
	
	$hutsa = 1;
	if (isset($_POST['Galdera'])) {
		if(empty($_POST['Galdera']))
		{
			$hutsa=0;
		}
		if(empty($_POST['Erantzuna']))
		{
			$hutsa=0;
		}
		if(empty($_POST['Zailtasuna']))
		{
			$hutsa=0;
		}
	
		$eposta = $_SESSION['erabiltzaile'];
		$galdera = $_POST['Galdera'];
		$erantzuna = $_POST['Erantzuna'];
		$zailtasuna = $_POST['Zailtasuna'];
		$ordua = date('Y-m-d H:i:s');
		$ip = $_SERVER["REMOTE_ADDR"];
		$ID = $_POST['ID'];
		$ekintza = $_POST['aukera'];
		echo "$ekintza";
		
		
		
		libxml_use_internal_errors(true);
		$xml=simplexml_load_file('../xml/galderak.xml');
		
		if ($xml === false) {
			echo "Arazoa XML-a kargatzen!\n";
			foreach(libxml_get_errors() as $error) {
				echo "\t", $error->message;
			}
		}
		if ($ekintza == "Gehitu"){
			$mota = "Galdera txertatu";
			if($hutsa == 1) {
				//$sqlgaldera="INSERT INTO Galderak(Eposta, Galdera, Erantzuna, Zailtasuna) VALUES ('$eposta', '$galdera', '$erantzuna', '$zailtasuna')";
				$sqlkonexioa="INSERT INTO Konexioak(Eposta, K_Ordua) VALUES ('$eposta', '$ordua')";
				
				$assesItem = $xml->addchild('assesmentItem');
				$assesItem-> addAttribute('konplexutasuna', $zailtasuna);
				$assesItem-> addAttribute('subject', 'Orokorra');
			
				$Itembody= $assesItem-> addChild('itemBody');
				$Itembody-> addChild('p', $galdera);
				$cResponse= $assesItem ->addChild('correctResponse');
				$Value= $cResponse-> addChild('value',$erantzuna);
			
				$xml->asXML('../xml/galderak.xml');
				//echo $xml->asXML();
				
				if (!mysql_query($sqlgaldera) || !mysql_query($sqlkonexioa))
				{
					die('Errorea: ' . mysql_error());
				}
				
				$query="SELECT MAX(K_ID) FROM `Konexioak`";
				$do = mysql_query($query);
				$fetch=mysql_fetch_assoc($do);
				$k_id=$fetch['MAX(K_ID)'];
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$sqlekintza="INSERT INTO Ekintzak(K_ID, Eposta, E_Mota, E_Ordua, IP) VALUES ('$k_id', '$eposta', '$mota', '$ordua', '$ip')";
				if (! $do || !mysql_query($sqlekintza))
				{
					die('Errorea: ' . mysql_error());
				}
				
				echo "Txertatze bat eginda.";
				mysql_close();
			}
			else {
				echo "Kutxetako bat hutsik dago!";
			}
		}
		
		if ($ekintza == "Eguneratu"){
			$mota = "Galdera eguneratu";
			$hutsa=0;
			if(empty($_POST['Galdera']))
			{
				$hutsa=1;
			}
			if(empty($_POST['Erantzuna']))
			{
				$hutsa=2;
			}
			
			switch ($hutsa) {
			case 0:
				$sqlgaldera = "UPDATE Galderak(Galdera, Erantzuna, Zailtasuna) SET Galdera = $galdera , Erantzuna = $erantzuna, Zailtasuna = $Zailtasuna WHERE ID = $ID ";
				break;
			case 1:
				$sqlgaldera = "UPDATE Galderak(Erantzuna, Zailtasuna) SET  Erantzuna = $erantzuna, Zailtasuna = $Zailtasuna WHERE ID = $ID ";
				break;
			case 2:
				$sqlgaldera = "UPDATE Galderak(Zailtasuna) SET Zailtasuna = $Zailtasuna WHERE ID = $ID ";
				break;
			$sqlkonexioa="INSERT INTO Konexioak(Eposta, K_Ordua) VALUES ('$eposta', '$ordua')";
			if (!mysql_query($sqlgaldera) || !mysql_query($sqlkonexioa))
				{
					die('Errorea: ' . mysql_error());
				}
			$query="SELECT MAX(K_ID) FROM `Konexioak`";
			$do = mysql_query($query);
			$fetch=mysql_fetch_assoc($do);
			$k_id=$fetch['MAX(K_ID)'];
			$ip = $_SERVER['REMOTE_ADDR'];
				
			$sqlekintza="INSERT INTO Ekintzak(K_ID, Eposta, E_Mota, E_Ordua, IP) VALUES ('$k_id', '$eposta', '$mota', '$ordua', '$ip')";
				if (! $do || !mysql_query($sqlekintza))
				{
					die('Errorea: ' . mysql_error());
				}
				
				echo "Eguneraketa eginda!.";
				mysql_close();
		}
		
		}
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Reviewing</title>
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
	<h1>Reviewing Quizzes</h1>
		<form action="" method="post" enctype="multipart/form-data" id="login" name="login">
			Galdera<br>
			<input id="galdera" type="text" name="Galdera" width="100">
			<br>
			Erantzuna<br>
			<input id="erantzuna" type="text" name="Erantzuna">
			<br>
			Zailtasun-maila(Max: 5)<br>
			<input id="zailtasuna" type="number" name="Zailtasuna" value="1" min="1" max="5">
			<br>Sar ezazu galderaren ID-a<br> 
			<input id = "ID" type = "number" name = "ID" min = "1"><br>
			Ekintza<br>
			<select id="aukera" name="aukera" >
				<option selected="selected" value="Gehitu">Gehitu</option>
				<option value="Eguneratu">Eguneratu</option>
			</select><br>
			<input id="gehitu" name="Gehitu" type="button" value="OK" onclick="galderaGehitu2()">
			<br>
			<input id="ikusi" name="Ikusi" type="button" value="Galderak Ikusi" onclick="GalderakIkusi2()"><br>
			<!-- Lokala -->
			<a href="../layout.html">Hasierako orria</a><br>
			<!-- Web-a -->
			<!--<a href="../layout.html">Hasierako orria</a><br>-->
		</form>
		<div id="emaitza" style="background-color:#99FF66;">
			<p>Galderak</p>
		</div>
		<div id="galderakop" style="background-color:#298ff5;">
			<p>Galdera kopurua</p>
		</div>
		<br>
	</body>
</html>