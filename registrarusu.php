<?php 

	session_start();

 	include("coneccion.php");

  $result2 = $conn->query("SELECT count(*) as n FROM usuarios where usuario='".$_POST["usuario_usu"]."'");
  $datos=$result2->fetch_assoc(); 

  if($datos["n"]==0)
  {
    $sql = "INSERT INTO usuarios (nomusu , usuario, clave) VALUES ('".$_POST['nombre_usu']."', '".$_POST['usuario_usu']."', '".$_POST['clave_usu']."')";  

    $conn->query($sql);  
    header("Location: index.php?reg=ok");
  }
  else
    header("Location: index.php?reg=not");
 	
	
	


 ?>