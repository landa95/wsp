<?php
	// Konexioa lokala sortu
	$sql = mysql_connect('localhost', 'root', '') or die(mysql_error());
	// Konexioa lokala egiaztatu
	mysql_select_db("quiz") or die(mysql_error());
	$email = $_POST['Eposta'];
	if (!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-z]+[0-9]{3}@ikasle(\.e)hu(\.e)(s|us)/"))) === false) {
		echo("$email email helbide zuzena da.");
	} else {
		echo("$email ez da email helbide zuzena.");
	}
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["Argazkia"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$besterik = $_POST['Espezialitatea'];
	$fileName = $_FILES['Argazkia']['name'];
	$tmpName = $_FILES['Argazkia']['tmp_name'];
	$fileSize = $_FILES['Argazkia']['size'];
	$fileType = $_FILES['Argazkia']['type'];
	if(isset($_POST["Bidali"])) {
		$fp = fopen($tmpName, 'r');
		$edukia = fread($fp, filesize($tmpName));
		$edukia = addslashes($edukia);
		fclose($fp);
		$check = getimagesize($_FILES["Argazkia"]["tmp_name"]);
		if($check !== false) {
			echo "Igotako argazkia - " . $check["mime"] . ".";
			$uploadOk = 1;
			$sql="INSERT INTO Erabiltzaile(Izena, Eposta, Pasahitza, Telefonoa, Espezialitatea, Interesak, Argazkia) VALUES ('$_POST[Izenabizenak]', '$_POST[Eposta]', '$_POST[Pasahitza]', '$_POST[Telefonoa]', '$_POST[Espezialitatea]', '$_POST[Interesak]', '$edukia')";
		} else {
			echo "Ez da argazkirik igo.<br>";
			$uploadOk = 0;
			$sql="INSERT INTO Erabiltzaile(Izena, Eposta, Pasahitza, Telefonoa, Espezialitatea, Interesak) VALUES ('$_POST[Izenabizenak]', '$_POST[Eposta]', '$_POST[Pasahitza]', '$_POST[Telefonoa]', '$_POST[Espezialitatea]', '$_POST[Interesak]')";
		}
	}	
	if (!mysql_query($sql))
	{
		die('Errorea: ' . mysql_error());
	}
	echo "Txertatze bat eginda.";
	mysql_close();
	echo "<p> <a href='IkusiErabiltzaileak.php'> Erabiltzaileak ikusi </a>";
?> 
