<?php 



	session_start();



  	if (!isset($_SESSION['loggedin'])) {



      header('Location: index.php');

      exit;

  	}



  	include("coneccion.php"); 



	$conn->query("UPDATE prueba SET tiempoTotal=SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horInicio, now())),culmino=1,horFin=now(),cantEjeRes=cantEjeRes-".$_POST["descuento"]." where codpru=".$_POST["codpru"]);

	header("Location: inicio.php");



 ?>