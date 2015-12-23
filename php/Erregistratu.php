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
	$email = $_POST['Eposta'];
	$pasa = $_POST['Pasahitza'];
	$tele = $_POST['Telefonoa'];
	$izen = $_POST['Izenabizenak'];
	if (!filter_var($izen, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[A-Z]+[a-z]* {1}[A-Z]+[a-z]* {1}[A-Z]+[a-z]*/"))) === false) {
		echo("$izen izena zuzena da.<br>");
	} else {
		echo("$izen izena ez da zuzena.<br>");
	}
	if (!filter_var($pasa, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/.{6,}/"))) === false) {
		echo("Pasahitza formatua zuzena da.<br>");
	} else {
		echo("Pasahitza formatua ez da zuzena.<br>");
	}
	if (!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-z]+[0-9]{3}@ikasle(\.e)hu(\.e)(s|us)/"))) === false) {
		echo("$email email helbide zuzena da.<br>");
	} else {
		echo("$email ez da email helbide zuzena.<br>");
	}
	if (!filter_var($tele, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9]{9}/"))) === false) {
		echo("$tele telefonoa zuzena da.<br>");
	} else {
		echo("$tele telefonoa ez da zuzena.<br>");
	}
	
	$hashpasahitza = hash('sha512',"$_POST[Pasahitza]");
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["Argazkia"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$fileName = $_FILES['Argazkia']['name'];
	$tmpName = $_FILES['Argazkia']['tmp_name'];
	$fileSize = $_FILES['Argazkia']['size'];
	$fileType = $_FILES['Argazkia']['type'];
	if(isset($_POST["Bidali"])) {
		$check = false;
		if(!empty($_FILES['Argazkia']['name'])) {
			$fp = fopen($tmpName, 'r');
			$edukia = fread($fp, filesize($tmpName));
			$edukia = addslashes($edukia);
			fclose($fp);
			$check = getimagesize($_FILES["Argazkia"]["tmp_name"]);
		}
		if($check !== false) {
			echo "Igotako argazkia - " . $check["mime"] . ".";
			$uploadOk = 1;
			$query="INSERT INTO Erabiltzaile(Izena, Eposta, Pasahitza, Telefonoa, Espezialitatea, Interesak, Argazkia, Erantzuna) VALUES ('$_POST[Izenabizenak]', '$_POST[Eposta]', '$hashpasahitza', '$_POST[Telefonoa]', '$_POST[Espezialitatea]', '$_POST[Interesak]', '$edukia', '$_POST[Erantzuna]')";
		} else {
			echo "Ez da argazkirik igo.<br>";
			$uploadOk = 0;
			$query="INSERT INTO Erabiltzaile(Izena, Eposta, Pasahitza, Telefonoa, Espezialitatea, Interesak, Erantzuna) VALUES ('$_POST[Izenabizenak]', '$_POST[Eposta]', '$hashpasahitza', '$_POST[Telefonoa]', '$_POST[Espezialitatea]', '$_POST[Interesak]', '$_POST[Erantzuna]')";
		}
	}	
	if (!mysqli_query($sql, $query))
	{
		echo('Errorea: ' . mysqli_error($sql));
	}
	echo "Txertatze bat eginda.";
	mysqli_close($sql);
	echo '<br><a href="../layout.html">Hasierako orrira</a>';
?> 
