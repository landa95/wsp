<?php
	// Konexioa sortu
<<<<<<< HEAD
	//$sql = mysql_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot') or die(mysql_error());
=======
<<<<<<< HEAD
	//$sql = mysql_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot') or die(mysql_error());
	// Konexioa egiaztatu
	//mysql_select_db("u275359965_quiz") or die(mysql_error());
	// Konexioa lokala sortu
	$sql = mysql_connect('localhost', 'root', '') or die(mysql_error());
	// Konexioa lokala egiaztatu
	mysql_select_db("quiz") or die(mysql_error());
=======
	$sql = mysql_connect('mysql.hostinger.es', 'u609685926_landa', 'quiz00') or die(mysql_error());
>>>>>>> a13ae06ca324908a5c99995aeb47d2d7428d6bcf
	// Konexioa egiaztatu
	//mysql_select_db("u275359965_quiz") or die(mysql_error());
	// Konexioa lokala sortu
	$sql = mysql_connect('localhost', 'root', '') or die(mysql_error());
	// Konexioa lokala egiaztatu
<<<<<<< HEAD
	mysql_select_db("quiz") or die(mysql_error());
=======
	//mysql_select_db("quiz") or die(mysql_error());
>>>>>>> 197320168fe9f7ee05991c7cfc6c615681d2a5d8
>>>>>>> a13ae06ca324908a5c99995aeb47d2d7428d6bcf
	session_start();
	if (!isset($_SESSION['erabiltzaile'])){
		header("location: ../login.php");
		
	}
	
	if($_SESSION['erabiltzaile'] != "web000@ehu.es"){
			
			header("location:../layout.html");
		}
	
	
		$eposta = $_SESSION['erabiltzaile'];
		$galdera = $_GET['Galdera'];
		$erantzuna = $_GET['Erantzuna'];
		$zailtasuna = $_GET['Zailtasuna'];
		$ordua = date('Y-m-d H:i:s');
		$ip = $_SERVER["REMOTE_ADDR"];
		$ID = $_GET['ID'];
		$aukera = $_GET['Aukera'];
		
		
		
		libxml_use_internal_errors(true);
		$xml=simplexml_load_file('../xml/galderak.xml');
		
		if ($xml === false) {
			echo "Arazoa XML-a kargatzen!\n";
			foreach(libxml_get_errors() as $error) {
				echo "\t", $error->message;
			}
		}
		if ($aukera == "Gehitu"){
			$mota = "Galdera txertatu";
			$hutsa = 1;
			if (isset($_GET['Galdera'])) {
				if(empty($_GET['Galdera']))
				{
					$hutsa=0;
				}
				if(empty($_GET['Erantzuna']))
				{
					$hutsa=0;
				}
				if(empty($_GET['Zailtasuna']))
				{
					$hutsa=0;
				}
			
			if($hutsa == 1) {
				$sqlgaldera="INSERT INTO Galderak(Eposta, Galdera, Erantzuna, Zailtasuna) VALUES ('$eposta', '$galdera', '$erantzuna', '$zailtasuna')";
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
		}
		if ($aukera == "Eguneratu"){
			$mota = "Galdera eguneratu";
			$hutsa=0;
			if(empty($_GET['Galdera']))
			{
				$hutsa=1;
			}
			if(empty($_GET['Erantzuna']))
			{
				$hutsa=2;
			}
			
			if ($hutsa == 0) {
			
				$sqlgaldera = "UPDATE Galderak SET Galdera = '$galdera' , Erantzuna = '$erantzuna',Zailtasuna = $zailtasuna  WHERE ID = $ID ";
			}
				
			if ($hutsa == 1) {
				$sqlgaldera = "UPDATE Galderak SET  Erantzuna = '$erantzuna', Zailtasuna = $zailtasuna WHERE ID = $ID ";	break;
			}
			if ($hutsa == 2) {
				$sqlgaldera = "UPDATE Galderak SET Zailtasuna = $zailtasuna WHERE ID = $ID ";
			}
			echo "7";
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
				
				
>>>>>>> 197320168fe9f7ee05991c7cfc6c615681d2a5d8
>>>>>>> a13ae06ca324908a5c99995aeb47d2d7428d6bcf
		}
		
		
		
	
?>