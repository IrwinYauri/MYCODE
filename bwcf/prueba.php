<?php 

	$maestro=setear("prueba.java");
	$concursante=setear("ingreso.java");

	if($maestro==$concursante)
		echo "Correcto";
	else
		echo "Error";

	function setear($archivo)
	{
		$fp = fopen($archivo, "r");
		$cad="";
		while (!feof($fp)){
		    $linea = fgets($fp);
		    $cad.=str_replace(' ', '', $linea);
		}
		fclose($fp);
		return str_replace(' ', '', trim(preg_replace('/\s+/', ' ', str_replace(' ', '', $cad))));
	}


 ?>