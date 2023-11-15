<?php 
	include("coneccion.php");

	$sql = "INSERT INTO resumen (codresar , indice, oracion) VALUES (".$_POST['codresar'].", ".$_POST['indice'].", '".$_POST['oracion']."')";	    
	//echo ++$load.") ...<br>";
	$conn->query($sql);  

	//fclose($arc);
	$conn->close();

	echo "good";
 ?>