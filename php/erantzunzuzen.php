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
	$erantzuna= $_GET['saiakera'];
	$galdera= $_GET['galdera'];
	$query = mysqli_query($sql, "SELECT Erantzuna FROM galderak WHERE Galdera='$galdera'");
	$fetch=mysqli_fetch_assoc($query);
	if ($fetch['Erantzuna'] == $erantzuna) {
		echo "Erantzuna zuzena da!";
	}
	else if ($fetch['Erantzuna']!= $erantzuna) {
		echo "Erantzuna ez da zuzena.";
	}
	else
	{
		echo('Errorea: ' . mysqli_error($sql));
	}
	echo '<td><div id = "zuzen"><input id = "bidali" type = "button" value ="check" name ="bidali" onClick= "emaitza('.$id.')"></div></form></td>';  
	?>