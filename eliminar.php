<?php 
	include("coneccion.php");
	
	//ini_set('memory_limit', '-1');
	//$arc = fopen('train.txt.src',"r");	
	//$load = 0;	

    //$linea = fgets($arc);	
	$sql = "DELETE FROM resumen WHERE codresar=".$_POST['codresar'];	    
	//echo ++$load.") ...<br>";
	$conn->query($sql);  

	//fclose($arc);
	$conn->close();

	echo "good";
 ?>