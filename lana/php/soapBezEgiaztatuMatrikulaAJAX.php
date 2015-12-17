<?php
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
<<<<<<< HEAD
	$soapclient = new nusoap_client('http://localhost:1234/wsjclarke001/lana/php/egiaztatuPasahitza.php?wsdl', true);
=======
	$soapclient = new nusoap_client('http://localhost:1234/WebSistemak/WebSistemak/lana/php/egiaztatuPasahitza.php?wsdl', true);
>>>>>>> 197320168fe9f7ee05991c7cfc6c615681d2a5d8
	//$soapclient = new nusoap_client('http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl', false);
	$server = new soap_server;
	
	if (isset($_GET['Eposta'])) {
		$emaitza = $soapclient->call('egimatrikula', array('a'=>$_GET['Eposta']));
	}
	if ($emaitza == "SI") {
		echo "Erabiltzailea erregistraturik dago.";
	}
	else {
		echo "Erabiltzailea ez dago erregistratuta.";
	}
?>