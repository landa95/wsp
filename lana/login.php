<?php

session_start();
if (isset($_SESSION['erabiltzaile'])){
	header("location:php/../layout.html");
}
	
	// Konexioa sortu
	//$sql = mysql_connect('mysql.hostinger.es', 'u275359965_root', 'dbroot') or die(mysql_error());
	// Konexioa egiaztatu
	//mysql_select_db("u275359965_quiz") or die(mysql_error());
	// Konexioa lokala sortu
	$sql = mysql_connect('localhost', 'root', '') or die(mysql_error());
	// Konexioa lokala egiaztatu
	mysql_select_db("quiz") or die(mysql_error());
	$zuzenabat=1;
	$zuzenabi=1;
	$hutsa=1;
	
	if(isset($_POST["Eposta"])){
		
						if(empty($_POST['Eposta']))
						{
							$hutsa=0;

						}
						 
						if(empty($_POST['Pasahitza']))
						{
							$hutsa=0;
						}
						
						$eposta = $_POST['Eposta'];
						$pasahitza= "ilanda";
						$hashpasahitza = hash('sha512',"$_POST[Pasahitza]");
						$query = mysql_query("SELECT Eposta ,Pasahitza FROM Erabiltzaile
						WHERE Eposta='$eposta' and pasahitza='$hashpasahitza'") or die(mysql_error());
						$result = mysql_fetch_array($query);
						if (filter_var($eposta, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[a-z]+[0-9]{3}@ikasle(\.e)hu(\.e)(s|us)/"))) === false) {
							$zuzenabat=0;
						}
						
						if($hashpasahitza=$result[1]){	
							$_SESSION['erabiltzaile'] = $_POST['Eposta'];
							echo "Session";
	
						}else{
							if(isset($_COOKIE['login'])){
								if($_COOKIE['login'] < 3){
									$attempts = $_COOKIE['login'] + 1;
									setcookie('login', $attempts, time()+60*10); //set the cookie for 10 minutes with the number of attempts stored
								}else{
									echo '10 minutuetan ezin izango duzu pasahitza sartu. Saiatu berriro beranduago.';
								}
							}else{
								setcookie('login', 1, time()+60*10); //set the cookie for 10 minutes with the initial value of 1
							}
						}
						
						if($_SESSION['erabiltzaile'] == "web@ehu.es"){
							
							header("location:php/reviewingQuizzes.php");
						}else{
							header("location:php/handlingQuizzes.php");
					
						}
						
	}
					
?>

<!DOCTYPE html> 
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Log In</title>
		<link rel="stylesheet" type="text/css" href="stylesPWS/style.css">
		<link rel="stylesheet" 
			type="text/css" 
			media="screen and (min-device-width: 480px) and (min-width: 530px)"
			href="stylesPWS/wide.css">
		<link rel="stylesheet" 
			type="text/css" 
			media="screen and (max-width: 480px)"
			href="stylesPWS/smartphone.css">
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data" id="login" name="login">
			Eposta elektronikoa<br>
			<input id="Eposta" type="email" name="Eposta">
			<br>
			Pasahitza<br>
			<input id="Pasahitza" type="password" name="Pasahitza">
			<br>
			<input id="bidali" name="bidali" type="submit" value="Bidali">
			<br>
			<?php
				if ($hutsa==0) {
					echo "Eposta edo pasahitza hutsik dago!";
				} 
				else if ($zuzenabat==0 || $zuzenabi==0) {
					echo "Eposta edo pasahitza ez da zuzena!";
				}
			?>
		</form>
		<span>
			<a href="pasahitza.php">Pasahitza ahaztu dut...</a><br>
		</span>	
		<span>
			<a href="layout.html">Atzera</a><br>
		</span>	
	</body>
</html>