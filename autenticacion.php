<?php
session_start();


//credenciales de acceso a la base datos

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'cuantics_irwin';
$DATABASE_PASS = 'pYBifY*aP@*g';
$DATABASE_NAME = 'cuantics_mycode';


// conexion a la base de datos

$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {

    // si se encuentra error en la conexión

    exit('Fallo en la conexión de MySQL:' . mysqli_connect_error());
}

// Se valida si se ha enviado información, con la función isset()

if (!isset($_POST['username'], $_POST['password'])) 
{
    // si no hay datos muestra error y re direccionar
    header('Location: index.php');
}

// evitar inyección sql

if ($stmt = $conexion->prepare('SELECT codusu,usuario, clave, preparado,nomusu,concursante FROM usuarios WHERE usuario = ?')) {

    // parámetros de enlace de la cadena ss
    $stmt->bind_param('s', $_POST['username']);    
    $stmt->execute();
}


// acá se valida si lo ingresado coincide con la base de datos

$stmt->store_result();
if ($stmt->num_rows > 0) 
{
    $stmt->bind_result($codusu, $id, $password, $preparado,$nom,$concursante);
    $stmt->fetch();


    // se confirma que la cuenta existe ahora validamos la contraseña

    if ($_POST['password'] === $password."") 
    {
        // la conexion sería exitosa, se crea la sesión
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        $_SESSION['codusu'] = $codusu;
        $_SESSION['nom'] = $nom;
        $_SESSION['concursante'] = $concursante;
        
        
        header('Location: inicio.php');
    }
} 
else 
{

    // usuario incorrecto
    header('Location: index.php');
}

$stmt->close();