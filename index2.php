<?php 
  session_start();

  if (!isset($_SESSION['loggedin'])) {

      header('Location: index.php');
      exit;
  }

  include("coneccion.php");

  function convertirTexto($txt,$indice)
  {
    $i=0;
    $cad="";
    while(strpos($txt,'.'))
    {
      $cadena=substr($txt,0,strpos($txt,'.')+1);

      //$("#texto_11").append('<button class="btn btn-primary" onclick="escribir(this,'+(++$i)+',biblioteca11,11);">'+$cadena+'</button>');
      $cad.='<a class="block" href="#" onclick="escribir(this,'.(++$i).',biblioteca'.$indice.','.$indice.');">'.$cadena.'</a>';
      $txt=substr($txt,strpos($txt,'.')+1);      
    }

    return $cad;
  }
  //tipoejercicio=1

  $result1 = $conn->query("SELECT count(*) as cant FROM prueba where codtip=".$_GET["tipoejercicio"]." and tipoPrueba='".$_GET["tipoprueba"]."' and codusu=".$_SESSION["codusu"]." and culmino=0");

  //verificar si esta preparado 1 si es 0
  if($result1->fetch_assoc()["cant"]=="0")
  { 
    $sql = "INSERT INTO prueba(codtip,codusu,tipoPrueba) VALUES (".$_GET["tipoejercicio"].", ".$_SESSION["codusu"].", '".$_GET["tipoprueba"]."')";  
    $conn->query($sql);
    
    $result1 = $conn->query("SELECT horinicio FROM prueba where codusu=".$_SESSION["codusu"]." and codpru='' order by horinicio desc limit 1");

    $codi=$result1->fetch_assoc()["horinicio"];
    $codi=str_replace("-", "", $codi);
    $codi=str_replace(":", "", $codi);
    $codi=str_replace(" ", "", $codi);

    if($_GET["tipoprueba"]=="SIMULACRO")
    {

    $sql = "UPDATE prueba SET codpru='".$codi."',finProgramado=ADDTIME(horinicio, '".(($_GET["nomtipoprueba"]=="DIGITACIÓN")?'00:10:00':'00:30:00')."'),tiempoProgramado='".(($_GET["nomtipoprueba"]=="DIGITACIÓN")?'00:10:00':'00:30:00')."' where codusu=".$_SESSION["codusu"]." and codpru='' order by horinicio desc";  

    }
    else if($_GET["tipoprueba"]=="CONCURSO")
    {
      $sql = "UPDATE prueba SET codpru='".$codi."',finProgramado=ADDTIME(horinicio, '".(($_GET["nomtipoprueba"]=="DIGITACIÓN")?'01:00:00':'01:30:00')."'),tiempoProgramado='".(($_GET["nomtipoprueba"]=="DIGITACIÓN")?'01:00:00':'01:30:00')."' where codusu=".$_SESSION["codusu"]." and codpru='' order by horinicio desc";  

    }
    $conn->query($sql);  
  }
  $result1->free(); 

  $result2 = $conn->query("SELECT *  FROM prueba where codtip=".$_GET["tipoejercicio"]." and tipoPrueba='".$_GET["tipoprueba"]."' and codusu=".$_SESSION["codusu"]." and culmino=0");
  $datos=$result2->fetch_assoc();

  //$conn->close();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_GET["tipoprueba"]." - ".$_GET["nomtipoprueba"];?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  body {
      position: relative;
      background-image: url("https://img.freepik.com/vector-premium/fondo-transparente-vector-codigo-binario-blanco-hackeo-big-data-programacion-descifrado-cifrado-transmision-computadora-numeros-negros-1-0-textura-concepto-codificacion-o-hacker-o-relleno-pagina-web_167184-367.jpg");
    }
    ul.nav-pills {
      top: 20px;
      position: fixed;
    }
    div.col-8 div {
      height: 500px;
    }
  
    .espacio
    {
      border: 1px solid #d1d1d1;
      width: 100%;
      /*height: 100%;*/
      background-color: #ffffff;
      padding: 10px 17px;
      text-align: justify;
    }

    a 
    {
      color: #000000;
    }

    a:hover {
        color: #ffffff;
        cursor: pointer;
        background-color: #ff1dce;
        text-decoration: blink;
    }
  </style>

<!---- ##########################################################################  -->
   <script async="" src="./W3Schools Tryit Editor_files/wrap.js.descarga"></script>
  <script type="text/javascript" async="" src="./W3Schools Tryit Editor_files/localstore.js.descarga"></script>
  <!--link rel="stylesheet" href="./W3Schools Tryit Editor_files/w3schools31.css"-->
  <link rel="stylesheet" href="./W3Schools Tryit Editor_files/codemirror_multi.css">
  <script type="text/javascript" src="./W3Schools Tryit Editor_files/config.js.descarga" async=""></script><script type="text/javascript" async="" src="./W3Schools Tryit Editor_files/js"></script><script async="" src="./W3Schools Tryit Editor_files/gtm.js.descarga"></script><script src="./W3Schools Tryit Editor_files/codemirror_multi.js.descarga"></script>
  <script src="./W3Schools Tryit Editor_files/codemirror_clike.js.descarga"></script>
  <!-- Google Tag Manager -->

  <!-- End Google Tag Manager -->

  <script data-cfasync="false" type="text/javascript">
    window.snigelPubConf = {
    "adengine": {
      "activeAdUnits": ["try_it_leaderboard"]
      }
    }
    uic_r_a()
  </script>
  <script async="" data-cfasync="false" src="./W3Schools Tryit Editor_files/loader.js.descarga" type="text/javascript"></script>
  <script>
    if (window.addEventListener) {              
        window.addEventListener("resize", browserResize);
    } else if (window.attachEvent) {                 
        window.attachEvent("onresize", browserResize);
    }
    var xbeforeResize = window.innerWidth;

    function browserResize() {
        var afterResize = window.innerWidth;
        if ((xbeforeResize < (970) && afterResize >= (970)) || (xbeforeResize >= (970) && afterResize < (970)) ||
            (xbeforeResize < (728) && afterResize >= (728)) || (xbeforeResize >= (728) && afterResize < (728)) ||
            (xbeforeResize < (468) && afterResize >= (468)) ||(xbeforeResize >= (468) && afterResize < (468))) {
            xbeforeResize = afterResize;
            
            if (document.getElementById("adngin-try_it_leaderboard-0")) {
                    adngin.queue.push(function(){  adngin.cmd.startAuction(["try_it_leaderboard"]); });
                  }
             
        }
        if (window.screen.availWidth <= 768) {
          restack(window.innerHeight > window.innerWidth);
        }
        fixDragBtn();
        showFrameSize();  
      
          
    }
    var fileID = "";
  </script>

  <style type="text/css">
    .CodeMirror {
      font-family: monospace;
      height: 700px;
      font-size: 13px;
      color: black;
      direction: ltr;
  }
  #iframewrapper1 > iframe
  {
    width: 100%;
  }
  #iframewrapper2 > iframe
  {
    width: 100%;
  }
  #iframewrapper3 > iframe
  {
    width: 100%;
  }
  #iframewrapper4 > iframe
  {
    width: 100%;
  }
  #iframewrapper5 > iframe
  {
    width: 100%;
  }
  #iframewrapper6 > iframe
  {
    width: 100%;
  }
  #iframewrapper7 > iframe
  {
    width: 100%;
  }
  #iframewrapper8 > iframe
  {
    width: 100%;
  }
  #iframewrapper9 > iframe
  {
    width: 100%;
  }
  #iframewrapper10 > iframe
  {
    width: 100%;
  }
  #iframewrapper11 > iframe
  {
    width: 100%;
  }
  #iframewrapper12 > iframe
  {
    width: 100%;
  }
  #iframewrapper13 > iframe
  {
    width: 100%;
  }
  #iframewrapper14 > iframe
  {
    width: 100%;
  }
  #iframewrapper15 > iframe
  {
    width: 100%;
  }
  #iframewrapper16 > iframe
  {
    width: 100%;
  }
  #iframewrapper17 > iframe
  {
    width: 100%;
  }
  #iframewrapper18 > iframe
  {
    width: 100%;
  }
  #iframewrapper19 > iframe
  {
    width: 100%;
  }
  #iframewrapper20 > iframe
  {
    width: 100%;
  }

  </style>

<!-- ############################################################################ -->

</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">
<br>
<div style="text-align: center;"><h1 style="color: #3f5f87;font-weight: bold;"><?php echo $_GET["tipoprueba"]." - ".$_GET["nomtipoprueba"];?></h1></div>
<div style="text-align: center;"><h3 style="color: #3f5f87;font-weight: bold;"><?php echo $datos["codpru"]; ?></h3></div>
<br>

<div class="alert alert-info"><strong>Nota: </strong>Recuerde todas las clases deben llamarse "Main" y si desea implementar una función debe ser "static" 
  <br>
  <code>public class Main
  {
    public static void main(String[]args)
    {

    }

    static void mifuncion()
    {

    }

  }
  </code>
  <br>
  Estan prohibido los comentarios //  /**/
</div>

<div class="column has-text-centered"  style="position: fixed;
    z-index: 8;
    right: 33px;
    background-color: white;
    padding: 9px 24px;
    color: #3f5f87;
    box-shadow: bisque;
    text-shadow: #454e60 0 3px 5px;width: 155px;">
  <!--div id="contenedorInputs">
      <div class="field">
        <label class="label">Minutos</label>
        <div class="control">
          <input class="input" id="minutos" type="number" placeholder="Minutos">
        </div>
      </div>
      <div class="field">
        <label class="label">Segundos</label>
        <div class="control">
          <input class="input" id="segundos" type="number" placeholder="Segundos">
        </div>
      </div>
    </div-->
    <img src="logo.png" width="100%" style="position: absolute;
    top: -148px;
    left: 0px;">
    <h2 id="tiempoRestante">00:00.0</h2>
    <!--button id="btnIniciar" class="button is-success"><span class="mdi mdi-play"></span></button>
    <button id="btnPausar" class="button is-success"><span class="mdi mdi-pause"></span></button>
    <button id="btnDetener" class="button is-success"><span class="mdi mdi-stop"></span></button-->
    
  </div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">      
    
        <?php 
          ini_set('memory_limit', '-1');
          $i=0;
          //ejercicios en general
          $result = $conn->query("select * from ejercicios where codtip = ".$_GET["tipoejercicio"]." order by ejenum asc");
          //ejercicios resuelto por el participante
          
          
          //if($ejeRes!="")
          //  $datosEjePart=$ejeRes->fetch_assoc();
          

          function buscarRespuestas($resultados,$codeje_)
          {
            echo "<script>console.log('Entro!!');</script>";
            if($resultados!="")
            {
              //echo "ingrese";              
              while ($row = $resultados->fetch_assoc()) 
              {
                  echo "<script>console.log('->".$codeje_." - ".$row["codeje"]."');</script>";
                  if($codeje_==$row["codeje"])
                    return $row;
              }
            }
            
            return '';

          }
        ?>
        <?php 
          while ($row = $result->fetch_assoc()) 
          { 
            $ejeRes = $conn->query("select * from ejercicio_prueba where codpru = '".$datos["codpru"]."'");
            $resultados_=buscarRespuestas($ejeRes,$row["codeje"]);        
          ?>
            <div id="section<?php echo $row["ejenum"];?>" style="padding: 30px 25px 55px 25px;border: 1px solid #275ba9;background-color: <?php echo ($row["ejenum"]%2==0)?'#d6d9e7':'#9ba6cd'; ?>">         
              <div class="row" style="margin-bottom: 10px;">
                <div class="col-sm-8">
                  <h3 style="color: #3f5f87;font-weight: bold;"><span id="ico_<?php echo $row["ejenum"];?>"><?php echo (($resultados_=="")?'<i class="fa fa-hourglass-o"></i>':'<i class="fa fa-check" style="color:green;"></i>'); ?></span> Ejercicio N° <?php echo $row["ejenum"]; ?></h3>  
                </div>                
                <div class="col-sm-4" style="text-align: right;">

                  
                </div>  
              </div>   
                       
              <br>
              
              <div class="row">             
                <div class="col-sm-6">                  
                  <!--p style="text-align: justify;"><?php echo convertirTexto($row["txt"],"1".$i); ?></p-->
                  <!--textarea rows="25" style="width:100%;"></textarea-->
                  <div id="shield"></div>
                  <a href="javascript:void(0)" id="dragbar" style="width: 5px; top: 144px; left: 678px; height: 464px; cursor: col-resize;"></a>

                    <div id="menuOverlay"class="w3-overlay w3-transparent" style="cursor:pointer;z-index:4;"></div>
                    <div id="textareacontainer">
                      <div id="textarea">
                        <div id="textareawrapper">     
                        <form action="<?php echo ($_GET["nomtipoprueba"]=="DIGITACIÓN")?'verificardigitacion.php':'verificardesarrolloprogramacion.php'; ?>" method="POST" id="verificardigitacion<?php echo $row['ejenum']; ?>" onsubmit="return valida(this)">
                          <input type="hidden" name="indice" value="<?php echo $row['ejenum']; ?>">
                          <input type="hidden" name="codeje" value="<?php echo $row['codeje']; ?>">  
                          <input type="hidden" name="codpru" value="<?php echo $datos["codpru"]; ?>">   
                          <textarea autocomplete="off" name="textareaCode<?php echo $row['ejenum']; ?>" id="textareaCode<?php echo $row['ejenum']; ?>" wrap="logical" spellcheck="false" style="display: none;"><?php echo ($resultados_!="")?$resultados_['codigo']:'public class Main{
  public static void main(String[]args){

  }
}';?></textarea>
						
						<input type="hidden" name="outputrpt_<?php echo $row['ejenum']; ?>" id="outputrpt_<?php echo $row['ejenum']; ?>" value="">   
                        </form>
                          <form id="codeForm<?php echo $row['ejenum']; ?>" autocomplete="off" style="margin:0px;display:none;">
                            <input type="hidden" name="code" id="code<?php echo $row['ejenum']; ?>">
                          </form>                  
                         </div>
                      </div>
                    </div>
                </div>
            
                <div class="col-sm-6">                                        
                 
                  <div class="espacio" id="zona_<?php echo $row["ejenum"]; ?>"><img src="<?php echo $row['url']; ?>" style="width: 100%;"></div>   
                  <br>

                  <div id="iframecontainer" style="width: 100%;">
                    <div id="iframe" style="width: 100%;">        
                      <div id="runloadercontainer<?php echo $row['ejenum']; ?>"><div id="runloader<?php echo $row['ejenum']; ?>"></div></div>
                      <div id="iframewrapper<?php echo $row['ejenum']; ?>" style="background-color: black;width: 100%">
                          <div id="iframeResult<?php echo $row['ejenum']; ?>" style="position:relative;white-space:nowrap;overflow:auto;width: 100%;">
                            <div style="width: 100%;height: 145px;color: #00f1ff;" id="rpt_<?php echo $row['ejenum']; ?>">
                              
                            </div>
                          </div>                    
                      </div>
                    </div>
                  </div> 

                  <br>

                  <div style="text-align: right;" id="controles_<?php echo $row['ejenum']; ?>">
                    <?php 
                        if($resultados_!="")
                          echo '<div class="alert alert-success"><strong>Correcto =) '.$resultados_["horaReg"].'</strong></div>';
                     ?>
                  </div> 
                    <?php 
                        if($resultados_==""){
                    ?>
                          

                          <?php 

                            if($_GET["tipoejercicio"]=="1")
                            {
                          ?>
                            <button id="runbtn_<?php echo $row['ejenum']; ?>" class="btn btn-success" onclick="submitTryit(<?php echo $row['ejenum']; ?>);uic_r_p();">Run &#10095;</button> 

                            <button class="btn btn-primary disabled" revisar="NO" id="re_<?php echo $row['ejenum']; ?>" onclick="verificar_enviar(this,'<?php echo $row["ejenum"];?>',<?php echo $row["codeje"];?>);" > Revisar y Enviar</button>  
                          <?php 
                            }
                            else if($_GET["tipoejercicio"]=="2")
                            {
                          ?>
                          	<!--button id="runbtn_<?php echo $row['ejenum']; ?>" class="btn btn-warning" onclick="submitTryit(<?php echo $row['ejenum']; ?>);uic_r_p();">Compilar &#10095;</button--> 

                              <button id="runbtn_<?php echo $row['ejenum']; ?>" class="btn btn-success" onclick="submitTryit_2(<?php echo $row['ejenum']; ?>);uic_r_p();">Run &#10095;</button> 

                              <button class="btn btn-primary disabled" revisar="NO" id="re_<?php echo $row['ejenum']; ?>" onclick="verificar_enviar_2(this,'<?php echo $row["ejenum"];?>',<?php echo $row["codeje"];?>);" > Revisar y Enviar</button> 
                          <?php
                            }

                           ?>

                          
                    <?php
                        }
                     ?>
                      
                </div>
              </div>
              

            </div>
            
            <br>        
          <?php 


          }

          $result->free(); 
        ?> 
    </div>
  </div>
  <form action="enviarprueba.php" method="POST" style="text-align: right;" id="prueba__<?php echo $datos["codpru"]; ?>">     
    <input type="hidden" name="codpru" value="<?php echo $datos["codpru"]; ?>"> 
    <input type="hidden" name="descuento" id="descuento" value="0"> 
    <div class="btn btn-primary" onclick="mandar(<?php echo $datos["codpru"]; ?>);">Terminar</div>
  </form>
</div>
<br>
<br>

<div id="banner"><script type="text/javascript" id="hoja"></script></div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script type="text/javascript">
  
  document.addEventListener("DOMContentLoaded", () => 
  {
  const $tiempoRestante = document.querySelector("#tiempoRestante"),
    //$btnIniciar = document.querySelector("#btnIniciar"),
    //$btnPausar = document.querySelector("#btnPausar"),
    //$btnDetener = document.querySelector("#btnDetener"),
    $minutos = document.querySelector("#minutos"),
    $segundos = document.querySelector("#segundos"),
    $contenedorInputs = document.querySelector("#contenedorInputs");
  let idInterval = null, diferenciaTemporal = 0,
    fechaFuturo = null;
  // Carga un sonido a través de su fuente y lo inyecta de manera oculta
  // Tomado de: https://parzibyte.me/blog/2020/09/28/reproducir-sonidos-javascript/
  const cargarSonido = function (fuente) {
    const sonido = document.createElement("audio");
    sonido.src = fuente;
    sonido.loop = true;
    sonido.setAttribute("preload", "auto");
    sonido.setAttribute("controls", "none");
    sonido.style.display = "none"; // <-- oculto
    document.body.appendChild(sonido);
    return sonido;
  };

  const sonido = cargarSonido("timer.wav");
 /* const ocultarElemento = elemento => {
    elemento.style.display = "none";
  }

  const mostrarElemento = elemento => {
    elemento.style.display = "";
  }*/

  const iniciarTemporizador = (minutos, segundos) => {
    //ocultarElemento($contenedorInputs);
    //mostrarElemento($btnPausar);
    //ocultarElemento($btnIniciar);
    //ocultarElemento($btnDetener);
    if (fechaFuturo) {
      fechaFuturo = new Date(new Date().getTime() + diferenciaTemporal);
      diferenciaTemporal = 0;
      
    } else {
      const milisegundos = (segundos + (minutos * 60)) * 1000;
      fechaFuturo = new Date(new Date().getTime() + milisegundos);
    }
    clearInterval(idInterval);
    idInterval = setInterval(() => {
      const tiempoRestante = fechaFuturo.getTime() - new Date().getTime();

      if (tiempoRestante <= 0) {
      	mandar('<?php echo $datos["codpru"]; ?>');
      	$( "button[id^='re_']" ).hide();
      	$( "button[id^='runbtn_']" ).hide();
        //$("#prueba__<?php echo $datos["codpru"]; ?>").submit();//Finaliza el tiempo finaliza el examen
        clearInterval(idInterval);
        sonido.play();
        ocultarElemento($btnPausar);
        mostrarElemento($btnDetener);
        
      } else {
        $tiempoRestante.textContent = milisegundosAMinutosYSegundos(tiempoRestante);

      }
    }, 50);
  };

  const pausarTemporizador = () => {
    //ocultarElemento($btnPausar);
    //mostrarElemento($btnIniciar);
    //mostrarElemento($btnDetener);
    diferenciaTemporal = fechaFuturo.getTime() - new Date().getTime();
    clearInterval(idInterval);
  };

  const detenerTemporizador = () => {
    clearInterval(idInterval);
    fechaFuturo = null;
    diferenciaTemporal = 0;
    sonido.currentTime = 0;
    sonido.pause();
    $tiempoRestante.textContent = "00:00.0";
    init();
  };

  const agregarCeroSiEsNecesario = valor => {
    if (valor < 10) {
      return "0" + valor;
    } else {
      return "" + valor;
    }
  }
  const milisegundosAMinutosYSegundos = (milisegundos) => {
    const minutos = parseInt(milisegundos / 1000 / 60);
    milisegundos -= minutos * 60 * 1000;
    segundos = (milisegundos / 1000);
    return `${agregarCeroSiEsNecesario(minutos)}:${agregarCeroSiEsNecesario(segundos.toFixed(1))}`;
  };
  /*const init = () => {
    $minutos.value = "";
    $segundos.value = "";
    //mostrarElemento($contenedorInputs);
    //mostrarElemento($btnIniciar);
    //ocultarElemento($btnPausar);
    //ocultarElemento($btnDetener);
  };*/


  /*$btnIniciar.onclick = () => 
  {
    const minutos = parseInt($minutos.value);
    const segundos = parseInt($segundos.value);
    if (isNaN(minutos) || isNaN(segundos) || (segundos <= 0 && minutos <= 0)) {
      return;
    }
    iniciarTemporizador(minutos, segundos);
  };*/
  <?php 
    $result_x = $conn->query("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND, horInicio, now())) as tiempotranscurrido,tiempoProgramado,now() as horaactual,finProgramado FROM prueba where codpru=".$datos["codpru"]);    
    $datos_w=$result_x->fetch_assoc();

    //echo 'alert("'.$datos["tiempotranscurrido"].'"+"|"+"'.$datos["tiempoProgramado"].'");';

    $horaInicio = new DateTime($datos_w["tiempoProgramado"]);
    $horaTermino = new DateTime($datos_w["tiempotranscurrido"]);

    $interval = $horaInicio->diff($horaTermino);
    //echo $interval->format('%H horas %i minutos %s seconds');
    $totalMinutos=($interval->h * 60) + $interval->i;
    $totalSegundos=$interval->s;
    //echo $datos_w["finProgramado"];
    //echo $datos_w["horaactual"];
   ?>

   <?php 
    if($datos_w["finProgramado"]>$datos_w["horaactual"])
    {
    ?>
      iniciarTemporizador(<?php echo $totalMinutos;?>, <?php echo $totalSegundos;?>);
    <?php
    }
    else
    {
    ?>
    	mandar('<?php echo $datos["codpru"]; ?>');
    	$( "button[id^='re_']" ).hide();
    	$( "button[id^='runbtn_']" ).hide();
    	
      //$("#prueba__<?php echo $datos["codpru"]; ?>").submit();
    <?php
    }
    ?>
  

  /*function iniciarCronometro(minu,segu)
  {
    alert();
    const minutos = parseInt(minu);
    const segundos = parseInt(segu);
    if (isNaN(minutos) || isNaN(segundos) || (segundos <= 0 && minutos <= 0)) {
      return;
    }
    iniciarTemporizador(minutos, segundos); 
  }*/

  //init();
  //$btnPausar.onclick = pausarTemporizador;
  //$btnDetener.onclick = detenerTemporizador;
});

</script>
<script type="text/javascript">

	function mandar(n)
	{
		<?php 
			if($_GET["tipoejercicio"]=="1" || $_GET["tipoprueba"]=="SIMULACRO")
			{
		 ?>
		 		if (confirm("¿Está seguro que desea finalizar su participación?") == true) {
				    $("#prueba__"+n).submit();
				  }

				
		<?php 
			}
			else if($_GET["tipoejercicio"]=="2")
			{
		?>
				if(myFunction())
				{
					let puntosDescuento = prompt("¿Cuántos puntos se va descontar?", "");
					if (puntosDescuento>=0 && puntosDescuento != null && puntosDescuento != "") 
					{			
						$("#descuento").val(puntosDescuento);
						$("#prueba__"+n).submit();			
					} 
					else 
					{
						$("#descuento").val("0");
						alert("¡Ingrese un número válido!");
					}
				}
				else
					alert("Cancelado");
		<?php
			}

		 ?>

	}


	function myFunction() {
		
		let person = prompt("Si está seguro de finalizar su participación, ingrese la contraseña del docente supervisor:", "");
		if (person == null || person == "" || person!="CONCURSO01") 
		{			
			return false;
		} 
		else 
		{
			return true;
		}
		
	}

  function verificar_enviar(t,n,codeje)
  {
    if($(t).attr("revisar")=="SI")
    {
      $(t).removeAttr("onclick");
      $(t).html('<span class="spinner-border spinner-border-sm"></span> Revisar y Enviar');

      var frm=$( "#verificardigitacion"+n); //Identificamos el formulario por su id
      var datos = frm.serialize();  //Serializamos sus datos

      //Preparamos la petición Ajax
      /*$.ajax({
          url: frm.prop("action"),    //Leerá la url en la etiqueta action del formulario (archivo.php)
          method: frm.prop('method'), //Leerá el método en etiqueta method del formulario
          data: datos,                //Variable serializada más arriba 
          dataType: "json",
          success: function(data) 
          {                  
            alert(data);
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });*/

      $.ajax({
          data: datos,
          url: frm.prop("action"),
          type: 'post',
          success: function (data)
          {                  
            //alert(data);
            if(data!="Error"){
              $(t).hide();
              //$("controles_"+n).empty();
              $("#runbtn_"+n).hide();
              $("#controles_"+n).html('<div class="alert alert-success"><strong>Correcto =) '+data+'</strong></div>');
              $("#ico_"+n).html('<i class="fa fa-check" style="color:green;"></i>');
            }
            else{
              $(t).attr("onclick","verificar_enviar(this,"+n+","+codeje+");"); 
              $(t).attr("revisar","NO");
              $(t).attr("class","btn btn-primary disabled");  
              $("#controles_"+n).html('<div class="alert alert-danger"><strong>Error: </strong>No coindicen con el código propuesto</div>'); 
              $(t).html(' Revisar y Enviar');      
            }
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });

      

      //alert("codigo=" + $("#textareaCode"+n).val());
      /*$.ajax({
          type: "POST",
          url : "verificardigitacion.php",
          //data: "codigo=" + $("#textareaCode"+n).val()+"&codeje="+codeje,
          data: datos, 
          //async: false,
          success: function(data) 
          {                  
            alert(data);
            if(data=="Correcto"){
              $(t).hide();
              //$("controles_"+n).empty();
              $("#controles_"+n).html('<div class="alert alert-success"><strong>Correcto =)</strong></div>');
            }
            else{
              $(t).attr("onclick","verificar_enviar(this,"+n+","+codeje+");");  
              $("#controles_"+n).html('<div class="alert alert-danger"><strong>Error: </strong>No coindicen con el código propuesto</div>'); 
              $(t).html(' Revisar y Enviar');      
            }
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });*/  
    }
    
  }


  function submitTryit_2(n)
  {
    if (editores["textareaCode"+n]) 
    {
          editores["textareaCode"+n].save();
    }
    var text = document.getElementById("textareaCode"+n).value;
    document.getElementById("code"+n).value=text;
    
    $("#runloadercontainer"+n).show();
    $("#controles_"+n).html("");
    $("#re_"+n).attr("revisar","NO");
    $("#re_"+n).attr("class","btn btn-primary disabled"); 
    

    // cadena de texto con el código a ejecutar
         
    // guardar el código a ejecutar dentro del <div>
    var div = document.getElementById('banner');
    //div.text = codigoEjecutable;

    $("#hoja").html(transformarX(($("#code"+n).val()).trim(),n)+'main();');
     
    // ejecutar el código del <script> con la función eval()
    var scripts = div.getElementsByTagName('script');
    $("#rpt_"+n).html("");
    

    try {
      eval(scripts[0].text);
    } 
    catch (e) {
        
      if (e instanceof SyntaxError) 
        {
            //alert(e.message);
            $("#rpt_"+n).html(e.message);
        }
    }

    if($("#rpt_"+n).html()!="")
    {
      //alert(document.getElementById("iframewrapper"+n).innerHTML); 
      document.getElementById("runloadercontainer"+n).style.display = "none";
      $("#re_"+n).attr("class","btn btn-primary");
      $("#re_"+n).attr("revisar","SI");
      //alert($("#rpt_"+n).html());
      $("#outputrpt_"+n).val($("#rpt_"+n).html());
    }
    else
    	$("#rpt_"+n).html("");


     //document.getElementById("runloadercontainer"+n).innerHTML="<img src='https://www.gifde.com/gif/otros/decoracion/cargando-loading/cargando-loading-039.gif' width='100%'>";

      

    /*if($(t).attr("revisar")=="SI")
    {
      $(t).removeAttr("onclick");
      $(t).html('<span class="spinner-border spinner-border-sm"></span> Revisar y Enviar');

      var frm=$( "#verificardigitacion"+n); //Identificamos el formulario por su id
      var datos = frm.serialize();  //Serializamos sus datos

      $.ajax({
          data: datos,
          url: frm.prop("action"),
          type: 'post',
          success: function (data)
          {                  
            //alert(data);
            if(data!="Error"){
              $(t).hide();
              //$("controles_"+n).empty();
              $("#runbtn_"+n).hide();
              $("#controles_"+n).html('<div class="alert alert-success"><strong>Correcto =) '+data+'</strong></div>');
              $("#ico_"+n).html('<i class="fa fa-check" style="color:green;"></i>');
            }
            else{
              $(t).attr("onclick","verificar_enviar(this,"+n+","+codeje+");"); 
              $(t).attr("revisar","NO");
              $(t).attr("class","btn btn-primary disabled");  
              $("#controles_"+n).html('<div class="alert alert-danger"><strong>Error: </strong>No coindicen con el código propuesto</div>'); 
              $(t).html(' Revisar y Enviar');      
            }
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });

    }
    */
  }

  function verificar_enviar_2(t,n,codeje)
  {
    if($(t).attr("revisar")=="SI")
    {

      $(t).removeAttr("onclick");
      $(t).html('<span class="spinner-border spinner-border-sm"></span> Revisar y Enviar');

      var frm=$( "#verificardigitacion"+n); //Identificamos el formulario por su id
      var datos = frm.serialize();  //Serializamos sus datos

      //Preparamos la petición Ajax
      /*$.ajax({
          url: frm.prop("action"),    //Leerá la url en la etiqueta action del formulario (archivo.php)
          method: frm.prop('method'), //Leerá el método en etiqueta method del formulario
          data: datos,                //Variable serializada más arriba 
          dataType: "json",
          success: function(data) 
          {                  
            alert(data);
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });*/

      $.ajax({
          data: datos,
          url: frm.prop("action"),
          type: 'post',
          success: function (data)
          {                  
            //alert(data);
            if(data!="Error"){
              $(t).hide();
              //$("controles_"+n).empty();
              $("#runbtn_"+n).hide();
              $("#controles_"+n).html('<div class="alert alert-success"><strong>Correcto =) '+data+'</strong></div>');
              $("#ico_"+n).html('<i class="fa fa-check" style="color:green;"></i>');
            }
            else{
              $(t).attr("onclick","verificar_enviar_2(this,"+n+","+codeje+");"); 
              $(t).attr("revisar","NO");
              $(t).attr("class","btn btn-primary disabled");  
              $("#controles_"+n).html('<div class="alert alert-danger"><strong>Error: </strong>No coindicen con el código propuesto</div>'); 
              $(t).html(' Revisar y Enviar');      
            }
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });

      

      //alert("codigo=" + $("#textareaCode"+n).val());
      /*$.ajax({
          type: "POST",
          url : "verificardigitacion.php",
          //data: "codigo=" + $("#textareaCode"+n).val()+"&codeje="+codeje,
          data: datos, 
          //async: false,
          success: function(data) 
          {                  
            alert(data);
            if(data=="Correcto"){
              $(t).hide();
              //$("controles_"+n).empty();
              $("#controles_"+n).html('<div class="alert alert-success"><strong>Correcto =)</strong></div>');
            }
            else{
              $(t).attr("onclick","verificar_enviar(this,"+n+","+codeje+");");  
              $("#controles_"+n).html('<div class="alert alert-danger"><strong>Error: </strong>No coindicen con el código propuesto</div>'); 
              $(t).html(' Revisar y Enviar');      
            }
            //$(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
          }
      });*/  
    }
    
  }

  function transformarX(code,n)
  {
    let cadaux=code;
    cadaux=cadaux.replace(/int +/g, ' ');
    cadaux=cadaux.replace(/float +/g, ' ');
    cadaux=cadaux.replace(/boolean +/g, ' ');
    cadaux=cadaux.replace(/double +/g, ' ');
    cadaux=cadaux.replace(/String +/g, ' ');

    //cadaux.indexOf('System.out.println')
    
    //cadaux=cadaux.replace(/System.out.println/g, '$("#rpt_'+n+'").append');//obs



    cadaux=cadaux.replace(/System.out.print/g, '$("#rpt_'+n+'").append');

    cadaux=cadaux.replace(/String\[\] args/g, '');
    cadaux=cadaux.replace(/String\[\]args/g, '');
    cadaux=cadaux.replace(/String \[\]args/g, '');
    cadaux=cadaux.replace(/String \[\] args/g, '');

    cadaux=cadaux.replace(/String\[ \] args/g, '');
    cadaux=cadaux.replace(/String\[ \]args/g, '');
    cadaux=cadaux.replace(/String \[ \]args/g, '');
    cadaux=cadaux.replace(/String \[ \] args/g, '');


    cadaux=cadaux.replace(/public static void/g, 'function ');
    cadaux=cadaux.replace(/public void/g, 'function ');
    cadaux=cadaux.replace(/private static void/g, 'function ');
    cadaux=cadaux.replace(/private void/g, 'function ');
    cadaux=cadaux.replace(/static void/g, 'function ');

    cadaux=cadaux.replace(/public static int/g, 'function ');
    cadaux=cadaux.replace(/private static int/g, 'function ');
    cadaux=cadaux.replace(/private int/g, 'function ');
    cadaux=cadaux.replace(/static int/g, 'function ');

    cadaux=cadaux.replace(/public static float/g, 'function ');
    cadaux=cadaux.replace(/public float/g, 'function ');
    cadaux=cadaux.replace(/private static float/g, 'function ');
    cadaux=cadaux.replace(/private float/g, 'function ');
    cadaux=cadaux.replace(/static float/g, 'function ');

    cadaux=cadaux.replace(/public static boolean/g, 'function ');
    cadaux=cadaux.replace(/public boolean/g, 'function ');
    cadaux=cadaux.replace(/private static boolean/g, 'function ');
    cadaux=cadaux.replace(/private boolean/g, 'function ');
    cadaux=cadaux.replace(/static boolean/g, 'function ');

    cadaux=cadaux.replace(/public static double/g, 'function ');
    cadaux=cadaux.replace(/public double/g, 'function ');
    cadaux=cadaux.replace(/private static double/g, 'function ');
    cadaux=cadaux.replace(/private double/g, 'function ');
    cadaux=cadaux.replace(/static double/g, 'function ');

    cadaux=cadaux.replace(/public static String/g, 'function ');
    cadaux=cadaux.replace(/public String/g, 'function ');
    cadaux=cadaux.replace(/private static String/g, 'function ');
    cadaux=cadaux.replace(/private String/g, 'function ');
    cadaux=cadaux.replace(/static String/g, 'function ');

    cadaux=cadaux.replace(/public static/g, 'function ');

    cadaux=(cadaux.split("\n").join("")).replace(/\s+/g, '');
    cadaux=cadaux.replace('publicclassMain{', '');
    //cadaux=cadaux.replace('publicstaticvoidmain(String[]args)', 'function main()');
    cadaux=cadaux.replace(/function/g, 'function ');
    cadaux=cadaux.replace(/String args/g, '');
    cadaux=cadaux.replace(/elseif/g, 'else if');
    
    
    cadaux=cadaux.replace(/\[\]+/g, ' ');
    cadaux=cadaux.replace(/\[ \]+/g, ' ');
    cadaux=cadaux.replace(/={+/g, '=[');
    cadaux=cadaux.replace(/};+/g, '];');
    
    cadaux=cadaux.substr(0,cadaux.length - 1);

    cadaux=cadaux.replace(/return/g, 'return ');
    //publicclassMain{publicstaticvoidmain(String[]args){intserie=10,num1=0,num2=1,suma=1;System.out.print(num1+",");for(inti=1;i<serie;i++){System.out.print(suma+",");suma=num1+num2;num1=num2;num2=suma;}}}
    //alert(cadaux);
    
    return ln(cadaux,n);
  }

  function ln(cadena,n)
  {
    let array = cadena.split(";"); 

    for(let i=0;i<array.length;i++)
    {
      if(array[i].indexOf('appendln')>=0)
      {
        array[i]=array[i].replace(/appendln/g, 'append');
        array[i]+=';$("#rpt_'+n+'").append("<br>")';
        //console.log("-->"+array[i]);
      }
    }
    let cad_aux='';
    let y;
    for(y=0;y<array.length-1;y++)
    {
      cad_aux+=array[y]+";";
    }
    cad_aux+=array[y];

    //console.log("-->"+cad_aux);
    return cad_aux;

  }


</script>

 <script>

    var editores=[];


    function submitTryit(n) 
    {      
      if (editores["textareaCode"+n]) 
      {
        editores["textareaCode"+n].save();
      }
      
      var text = document.getElementById("textareaCode"+n).value;

      var ifr = document.createElement("iframe");
      ifr.setAttribute("frameborder", "0");
      ifr.setAttribute("id", "iframeResult"+n);
      ifr.setAttribute("name", "iframeResult"+n);  

      
      document.getElementById("iframewrapper"+n).innerHTML = "";
      document.getElementById("iframewrapper"+n).appendChild(ifr);

      document.getElementById("iframeResult"+n).addEventListener("load", function(){/*alert(document.getElementById("iframewrapper"+n).innerHTML);*/ document.getElementById("runloadercontainer"+n).style.display = "none";$("#re_"+n).attr("class","btn btn-primary");$("#re_"+n).attr("revisar","SI"); } );

      document.getElementById("runloadercontainer"+n).innerHTML="<img src='https://www.gifde.com/gif/otros/decoracion/cargando-loading/cargando-loading-039.gif' width='100%'>";

      $("#runloadercontainer"+n).show();
      $("#controles_"+n).html("");
      $("#re_"+n).attr("revisar","NO");
      $("#re_"+n).attr("class","btn btn-primary disabled");  
      //displaySpinner(n);
      var t=text;
      //alert(t);
      t=t.replace(/=/gi,"w3equalsign");
      t=t.replace(/\+/gi,"w3plussign");    
      var pos=t.search(/script/i)
      while (pos>0) {
        t=t.substring(0,pos) + "w3" + t.substr(pos,3) + "w3" + t.substr(pos+3,3) + "tag" + t.substr(pos+6);
        pos=t.search(/script/i);
      }
        
      document.getElementById("code"+n).value=t;
      
      document.getElementById("codeForm"+n).action = "https://try.w3schools.com/try_java.php?x=" + Math.random();  
      
      document.getElementById('codeForm'+n).method = "post";
      document.getElementById('codeForm'+n).acceptCharset = "utf-8";
      document.getElementById('codeForm'+n).target = "iframeResult"+n;
      document.getElementById("codeForm"+n).submit();
        
    }

    function hideSpinner() {
      document.getElementById("runloadercontainer1").style.display = "none";
    }
    function displaySpinner(n) {

      var i, c, w, h, r, top;
      i = document.getElementById("iframeResult"+n);
      w = w3_getStyleValue(i, "width");
      h = w3_getStyleValue(i, "height");
      c = document.getElementById("runloadercontainer"+n);
      //document.getElementById("runloadercontainer"+n).innerHTML = "123";
      c.style.width = w;
      c.style.height = h;
      c.style.display = "block";
      w = Number(w.replace("px", "")) / 5;
      r = document.getElementById("runloader"+n);
      r.style.width = w + "px";
      r.style.height = w + "px";
      h = w3_getStyleValue(r, "height");
      h = Number(h.replace("px", "")) / 2;
      top = w3_getStyleValue(c, "height");
      top = Number(top.replace("px", "")) / 2;
      top = top - h
      r.style.top = top + "px";
    }

    var currentStack=true;
    if ((window.screen.availWidth <= 768 && window.innerHeight > window.innerWidth) || "" == " horizontal") {restack(true);}
    function restack(horizontal) {
        var tc, ic, t, i, c, f, sv, sh, d, b, height, flt, width;
        tc = document.getElementById("textareacontainer");
        ic = document.getElementById("iframecontainer");
        t = document.getElementById("textarea");
        i = document.getElementById("iframe");
        c = document.getElementById("container");    
        sv = document.getElementById("stackV");
        sh = document.getElementById("stackH");
        b = document.getElementsByClassName("localhostoutercontainer");
        tc.className = tc.className.replace("horizontal", "");
        ic.className = ic.className.replace("horizontal", "");        
        t.className = t.className.replace("horizontal", "");        
        i.className = i.className.replace("horizontal", "");        
        c.className = c.className.replace("horizontal", "");                        
        if (b[0]) {b[0].className = b[0].className.replace("horizontal", "")};
        if (sv) {sv.className = sv.className.replace("horizontal", "")};
        if (sv) {sh.className = sh.className.replace("horizontal", "")};
        stack = "";
        if (horizontal) {
            tc.className = tc.className + " horizontal";
            ic.className = ic.className + " horizontal";        
            t.className = t.className + " horizontal";        
            i.className = i.className + " horizontal";                
            c.className = c.className + " horizontal";                
            if (sv) {sv.className = sv.className + " horizontal"};
            if (sv) {sh.className = sh.className + " horizontal"};
            if (b[0]) {b[0].className = b[0].className + " horizontal"};        
            stack = " horizontal";
            document.getElementById("textareacontainer").style.height = "50%";
            document.getElementById("iframecontainer").style.height = "50%";
            document.getElementById("textareacontainer").style.width = "100%";
            document.getElementById("iframecontainer").style.width = "100%";
            currentStack=false;
        } else {
            document.getElementById("textareacontainer").style.height = "100%";
            document.getElementById("iframecontainer").style.height = "100%";
            document.getElementById("textareacontainer").style.width = "50%";
            document.getElementById("iframecontainer").style.width = "50%";
            currentStack=true;        
        }
        fixDragBtn();
        showFrameSize();
          
    }
    function showFrameSize(n) {
      var t;
      var width, height;
      width = Number(w3_getStyleValue(document.getElementById("iframeResult"+n), "width").replace("px", "")).toFixed();
      height = Number(w3_getStyleValue(document.getElementById("iframeResult"+n), "height").replace("px", "")).toFixed();
      document.getElementById("framesize").innerHTML = "Result Size: <span>" + width + " x " + height + "</span>";
    }
    var dragging = false;
    var stack;
    function fixDragBtn() {
      var textareawidth, leftpadding, dragleft, containertop, buttonwidth
      var containertop = Number(w3_getStyleValue(document.getElementById("container"), "top").replace("px", ""));
      if (stack != " horizontal") {
        document.getElementById("dragbar").style.width = "5px";    
        textareasize = Number(w3_getStyleValue(document.getElementById("textareawrapper"), "width").replace("px", ""));
        leftpadding = Number(w3_getStyleValue(document.getElementById("textarea"), "padding-left").replace("px", ""));
        buttonwidth = Number(w3_getStyleValue(document.getElementById("dragbar"), "width").replace("px", ""));
        textareaheight = w3_getStyleValue(document.getElementById("textareawrapper"), "height");
        dragleft = textareasize + leftpadding + (leftpadding / 2) - (buttonwidth / 2);
        document.getElementById("dragbar").style.top = containertop + "px";
        document.getElementById("dragbar").style.left = dragleft + "px";
        document.getElementById("dragbar").style.height = textareaheight;
        document.getElementById("dragbar").style.cursor = "col-resize";
        
      } else {
        document.getElementById("dragbar").style.height = "5px";
        if (window.getComputedStyle) {
            textareawidth = window.getComputedStyle(document.getElementById("textareawrapper"),null).getPropertyValue("height");
            textareaheight = window.getComputedStyle(document.getElementById("textareawrapper"),null).getPropertyValue("width");
            leftpadding = window.getComputedStyle(document.getElementById("textarea"),null).getPropertyValue("padding-top");
            buttonwidth = window.getComputedStyle(document.getElementById("dragbar"),null).getPropertyValue("height");
        } else {
            dragleft = document.getElementById("textareawrapper").currentStyle["width"];
        }
        textareawidth = Number(textareawidth.replace("px", ""));
        leftpadding = Number(leftpadding .replace("px", ""));
        buttonwidth = Number(buttonwidth .replace("px", ""));
        dragleft = containertop + textareawidth + leftpadding + (leftpadding / 2);
        document.getElementById("dragbar").style.top = dragleft + "px";
        document.getElementById("dragbar").style.left = "5px";
        document.getElementById("dragbar").style.width = textareaheight;
        document.getElementById("dragbar").style.cursor = "row-resize";        
      }
    }
    function dragstart(e) {
      e.preventDefault();
      dragging = true;
      var main = document.getElementById("iframecontainer");
    }
    /*function dragmove(e) {
      if (dragging) 
      {
        document.getElementById("shield").style.display = "block";        
        if (stack != " horizontal") {
          var percentage = (e.pageX / window.innerWidth) * 100;
          if (percentage > 5 && percentage < 98) {
            var mainPercentage = 100-percentage;
            document.getElementById("textareacontainer").style.width = percentage + "%";
            document.getElementById("iframecontainer").style.width = mainPercentage + "%";
            fixDragBtn();
          }
        } else {
          var containertop = Number(w3_getStyleValue(document.getElementById("container"), "top").replace("px", ""));
          var percentage = ((e.pageY - containertop + 20) / (window.innerHeight - containertop + 20)) * 100;
          if (percentage > 5 && percentage < 98) {
            var mainPercentage = 100-percentage;
            document.getElementById("textareacontainer").style.height = percentage + "%";
            document.getElementById("iframecontainer").style.height = mainPercentage + "%";
            fixDragBtn();
          }
        }
        showFrameSize();  
      
          
      }
    }*/
    /*function dragend(n) {
      document.getElementById("shield").style.display = "none";
      dragging = false;
      var vend = navigator.vendor;
      if (editores[n] && vend.indexOf("Apple") == -1) {
          editores[n].refresh();
      }
    }
    if (window.addEventListener) {              
      document.getElementById("dragbar").addEventListener("mousedown", function(e) {dragstart(e);});
      document.getElementById("dragbar").addEventListener("touchstart", function(e) {dragstart(e);});
      window.addEventListener("mousemove", function(e) {dragmove(e);});
      window.addEventListener("touchmove", function(e) {dragmove(e);});
      window.addEventListener("mouseup", dragend);
      window.addEventListener("touchend", dragend);
      window.addEventListener("load", fixDragBtn);
      window.addEventListener("load", showFrameSize);
      
    }*/

    function retheme() {
      var cc = document.body.className;
      if (cc.indexOf("darktheme") > -1) {
        document.body.className = cc.replace("darktheme", "");
        if (opener) {opener.document.body.className = cc.replace("darktheme", "");}
        localStorage.setItem("preferredmode", "light");
      } else {
        document.body.className += " darktheme";
        if (opener) {opener.document.body.className += " darktheme";}
        localStorage.setItem("preferredmode", "dark");
      }
    }
    (
    function setThemeMode() {
      var x = localStorage.getItem("preferredmode");
      if (x == "dark") {
        document.body.className += " darktheme";
      }
    })();

    //Aplicar diseño al cuadro de código ##########################################
    function colorcoding(nom) {
      var ua = navigator.userAgent;
      //Opera Mini refreshes the page when trying to edit the textarea.
      if (ua && ua.toUpperCase().indexOf("OPERA MINI") > -1) { return false; }
      editores[nom] = CodeMirror.fromTextArea(document.getElementById(nom), {
      mode: "text/x-java",
      lineWrapping: true,
      smartIndent: false,
      htmlMode: true,
      autocorrect: false,      
      addModeClass: true,

      
        //mode: "text/x-java",
        //lineWrapping: true,
        //autocorrect: false,      
        //smartIndent: false
      
      });


    //  editor.on("change", function () {editor.save();});
    }

    <?php 
      $result_l = $conn->query("select * from ejercicios where codtip = ".$_GET["tipoejercicio"]." order by ejenum asc");
      //$num_=0;
      while ($row = $result_l->fetch_assoc()) 
      {
    ?>
      colorcoding("textareaCode<?php echo $row["ejenum"]; ?>");
    <?php
      } 
     ?>

    //colorcoding("textareaCode1");
    //colorcoding("textareaCode2");
    //#############################################################################


    function clickTab(x) {
      
      return false;
      
    }

    function w3_getStyleValue(elmnt,style) {
        if (window.getComputedStyle) {
            return window.getComputedStyle(elmnt,null).getPropertyValue(style);
        } else {
            return elmnt.currentStyle[style];
        }
    }

    function openMenu() {
        var x = document.getElementById("navbarDropMenu");
        var y = document.getElementById("menuOverlay");
        var z = document.getElementById("menuButton");
        if (z.className.indexOf("w3-text-gray") == -1) {
            z.className += " w3-text-gray";
        } else { 
            z.className = z.className.replace(" w3-text-gray", "");
        }
        if (z.className.indexOf("w3-gray") == -1) {
            z.className += " w3-gray";
        } else { 
            z.className = z.className.replace(" w3-gray", "");
        }
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
        if (y.className.indexOf("w3-show") == -1) {
            y.className += " w3-show";
        } else { 
            y.className = y.className.replace(" w3-show", "");
        }

    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("menuOverlay")) {
            openMenu();
        }
    }
    function setCodewindowHeight() {
      var i;
      var txw = document.getElementById("textareawrapper");
      var txwh = w3_getStyleValue(txw,"height");
      
      var qwsa = document.getElementsByClassName("codewindow");
      for (i = 0; i < qwsa.length; i++) {
        qwsa[i].style.height = txwh;
        qwsa[i].style.setProperty("overflow", "auto", "important");
      }
    }

    uic_r_e()
  </script>
