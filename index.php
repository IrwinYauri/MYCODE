<?php 

    if(isset($_GET["reg"]))
    {
        if($_GET["reg"]=="ok"){
            echo '<div class="alert alert-success">
              <strong>Correcto!</strong> Se registró el usuario correctamente.
            </div>;';            
        }
        else{
            echo '<div class="alert alert-danger">
              <strong>Error!</strong> El usuario ya existe.
            </div>;';            
        }

    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    <div class="login">
        <h1>I Concurso de Programación</h1>

        <form action="autenticacion.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username"
            placeholder="Usuario" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password"
            placeholder="Contraseña" id="password" required>
            <input type="submit" value="Acceder">
        </form>
    </div>
    <div class="content" style="text-align: center;">

        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Quiero registrarme</button>
          <div id="demo" class="collapse">
            <div class="login">
                <h1>Formulario de Registro</h1>

                <form action="registrarusu.php" method="post">
                    <label for="nombre_usu">
                        <i class="fa fa-book"></i>
                    </label>
                    <input type="text" name="nombre_usu"
                    placeholder="Nombre completo" id="nombre_usu" required>

                    <label for="usuario_usu">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="usuario_usu"
                    placeholder="Usuario (Num. DNI)" id="usuario_usu" required>

                    <label for="clave_usu">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="clave_usu"
                    placeholder="Contraseña" id="clave_usu" required>
                    <input type="submit" value="Registrarme">
                </form>
            </div>
          </div>

       

        <!--div class="alert alert-primary">
          <strong>Tesis: Algoritmo TF-IDF y PageRank para Generar Resumen Automático de Textos en Español</strong> El objetivo de esta tesis es elaborar un algoritmo que pueda generar resumen de texto en forma automática.
        </div>        
        <div class="alert alert-primary">
          <strong>Proyecto NLP</strong> Este proyecto tiene el objetivo, evaluar los resumenes de texto que elaboran los seres humanos. Para luego ser comparados con los resumenes que genera el proyecto de tesis.
        </div-->        
    </div>
    
</body>
</html>