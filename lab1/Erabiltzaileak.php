<?php

$link= mysql_connect("localhost","root","") or die(mysql_error()); //erabiltzaile eta pasahitza
mysql_select_db( "quiz" , $link ) ;
echo"conection ok";
$SQL1= "INSERT INTO erabiltzaile(IzenAbizenak, Eposta, Pasahitza, Telefonoa, Espezialitatea, Interesak) VALUES('$_POST[IzenAbizenak]','$_POST[Eposta]','$_POST[Pasahitza]','$_POST[Telefonoa]','$_POST[Espezialitatea]','$_POST[Interesak]')";

if(!mysql_query($SQL1)){
	die("Errorea: ".mysql_error());
}
echo "1 record added";

mysql_close($link);
echo "<p> <a href='IkusiErabiltzaileak.php'> Erregistroak ikusi </a>";
?>
