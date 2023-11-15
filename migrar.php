<?php 
	/*
	function cantidad_de_palabras($txt)
	{
		$cont=0;
		$palabras = explode(" ", $txt);
		foreach ($palabras as $key => $value) 
		{
			if(strlen($value)>2)
				$cont++;
		}
		
		return $cont;
	}

	//Sintaxis de conexión de la base de datos de muestra para PHP y MySQL.	
	//Conectar a la base de datos
	
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname="proyecto";
	
	// Create connection
	$conn = new mysqli($hostname, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 	
	  die("Connection failed: " . $conn->connect_error);
	
	ini_set('memory_limit', '-1');	
	
	$arc = fopen('train.txt.src',"r");	
	$load = 0;
	while(! feof($arc))  
	{
	    $linea = fgets($arc);			    	
		$sql = "INSERT INTO articulos (codart , txtart, catpal) VALUES (NULL, '".$linea."', ".cantidad_de_palabras($linea).")";	    
    	echo ++$load.") ...<br>";
    	$conn->query($sql);
    	//break;
	}

	fclose($arc);


	$conn->close();
	*/
?>