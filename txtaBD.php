<?php 
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
 ?>