<?php 

	session_start();

  	if (!isset($_SESSION['loggedin'])) 
  	{

      header('Location: index.php');
      exit;

  	}



  	include("coneccion.php"); 



  	$result2 = $conn->query("SELECT *  FROM ejercicios where codeje=".$_POST["codeje"]."");

  	$datos=$result2->fetch_assoc();



	$maestro=str_replace(' ', '', trim(preg_replace('/\s+/', ' ', str_replace(' ', '', $datos["solucion"]))));//setear("prueba.java");

	$concursante=str_replace(' ', '', trim(preg_replace('/\s+/', ' ', str_replace(' ', '', $_POST["textareaCode".$_POST["indice"]]))));//setear("ingreso.java");



	if($maestro==$concursante){

		

		$sql = "INSERT INTO ejercicio_prueba (codpru,codeje,codigo) values(".$_POST["codpru"].", ".$_POST["codeje"].", '".$concursante."')";  

    	$conn->query($sql);



    	$result1 = $conn->query("SELECT horaReg FROM ejercicio_prueba where codeje=".$_POST["codeje"]." and codpru=".$_POST["codpru"]." order by horaReg desc limit 1");

    	$horaReg=$result1->fetch_assoc()["horaReg"];



    	$result1 = $conn->query("SELECT count(*) as n FROM ejercicio_prueba where codpru=".$_POST["codpru"]);

    	$n=$result1->fetch_assoc()["n"];



    	$conn->query("UPDATE prueba SET cantEjeRes=".$n." where codpru=".$_POST["codpru"]);



		echo $horaReg;

	}

	else{

		echo "Error";

	}



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