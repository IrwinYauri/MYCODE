<?php 
	include("coneccion.php");
	
	//ini_set('memory_limit', '-1');
	//$arc = fopen('train.txt.src',"r");	
	//$load = 0;	

    //$linea = fgets($arc);	
	$sql = "UPDATE resumen_articulos SET resumido=1,saveupdate=now()  WHERE codresar=".$_POST['codresar'];	    
	//echo ++$load.") ...<br>";
	$conn->query($sql);  

	$result = $conn->query("SELECT saveupdate FROM resumen_articulos WHERE codresar=".$_POST['codresar']);

	//fclose($arc);
	$conn->close();

	echo $result->fetch_assoc()["saveupdate"];
?>