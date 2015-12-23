<?php
	// Konexioa sortu
	$sql = mysqli_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot', 'u275359965_quiz');
	// Konexioa lokala sortu
	//$sql = mysqli_connect('localhost', 'root', '', 'quiz');
	// Konexioa egiaztatu
	if (mysqli_connect_errno())
	$mota = "Galderak ikusi";
	$ordua = date('Y-m-d H:i:s');
	$ip = $_SERVER["REMOTE_ADDR"];
	$query="INSERT INTO Ekintzak(E_Mota, E_Ordua, IP) VALUES ('$mota', '$ordua', '$ip')";
	if (!mysqli_query($sql, $query))
	{
		echo('Errorea: ' . mysqli_error($sql));
	}
	
	header("location:../quizzes.php");
	mysqli_close();
?>

