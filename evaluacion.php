<?php


// confirmar sesion

session_start();


if (!isset($_SESSION['loggedin'])) {

    header('Location: index.php');
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="loggedin">
    <nav class="row" style="background: lightslategray;padding: 15px 35px;">
        <div class="col-sm-6">
            <h1 style="color:white;">Resumen de Texto Extractivo</h1>            
        </div>

        <div class="col-sm-6" style="text-align: right;">
            <!--a href="perfil.php" style="color:white;"><i class="fas fa-user-circle"></i>Informción de Usuario</a-->
            <div>
                <b style="color:white;"><?php echo $_SESSION['nom']; ?></b>
            </div>
            <div>
                <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>                
            </div>
        </div>
    </nav>

    <div class="content" style="width: 90%;">
        <h2>Muestra: 30 artículos</h2>
        <p><i class="fa fa-info-circle"></i> Lee detenidamente los artículos y ve seleccionando las oraciones que te parescan importantes y creas que deban formar parte del resumen.</p>
    </div>

    <div class="content" style="width: 90%;">
        <?php include("index2.php"); ?>
    </div>

</body>

</html>