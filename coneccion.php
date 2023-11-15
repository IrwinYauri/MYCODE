<?php 
	$hostname="localhost";
	$username="cuantics_irwin";
	$password="pYBifY*aP@*g";
	$dbname="cuantics_mycode";
	
	// Create connection
	$conn = new mysqli($hostname, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) 	
	  die("Connection failed: " . $conn->connect_error);
?>