<?php 

  include("coneccion.php");

  //$result = $conn->query("select * from articulos_200_499__15");

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


 ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-fluid">
  <div class="row">
   
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home">Bienvenidos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu1">Simulacro - DIGITACIÓN</a>
      </li>
      <?php 
        if($_SESSION['concursante']=='1')
        {
      ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu2">Concurso - DIGITACIÓN</a>
      </li>
      <?php 
        }
      ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu3">Simulacro - DESARROLLO DE ALGORITMOS</a>
      </li>
      <?php 
        if($_SESSION['concursante']=='1')
        {
      ?>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu4">Concurso - DESARROLLO DE ALGORITMOS</a>
      </li>
      <?php 
        }
      ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content" style="width: 100%;">
      <div id="home" class="container tab-pane active"><br>
        <h3>¡Bienvenidos!</h3>
        <h2><span>I CONCURSO DE PROGRAMACIÓN - 2023</span></h2>
        <p>La carrera Profesional de Computación e Informática, les invita a participar del I Concurso de Programación. La inscripción es libre.</p>
        <p>Como parte del Santa Lucia Fest, realizaremos el I Concurso de Programación. Que se llevará acabo el 07 de Noviembre.</p>
        <h2>"Promoción Byte-riente 2023"</h2>
        <p>Los estudiantes de computación, les invitan a participar en dos Categorías: DIGITACIÓN y DESARROLLO DE ALGORITMOS. <a href="https://forms.gle/9NKkyC6tZs6qTqvm8" target="_blank" type="livedemo" name="Live Demo" class="btn btn-primary btn-sm" >Inscríbete al concurso aquí</a></p>

        <div style="text-align: center;">
          <img src="https://cuanticsoft.com/concurso/img/BANNER2.png" style="width: 70%;">  
          <p>Lugar del Concurso: Av. Pacheco 238 - Laboratorio 201</p>
        </div> 
      </div>
      <div id="menu1" class="container tab-pane fade"><br>
        
        <div class="row">
          <div class="col-sm-6" style="text-align: left;">
            <h3>Simulacro - DIGITACIÓN</h3>    
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a class="btn btn-primary" href="index2.php?tipoejercicio=1&nomtipoprueba=DIGITACIÓN&tipoprueba=SIMULACRO" target="_blank">Probar</a>
          </div>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>ORDEN</th>
              <th>USUARIO</th>
              <th>CODIGO PRUEBA</th>
              <th>TIEMPO</th>
              <th>TIPO</th>
              <th>PUNTAJE</th>
              <th>HOR.INICIO</th>
              <th>HOR.FIN</th>
            </tr>
          </thead>
          <tbody>
         <?php 
              ini_set('memory_limit', '-1');
              $i=0;
              $result = $conn->query("SELECT usuarios.usuario,usuarios.nomusu,prueba.codpru,prueba.tiempoTotal,tipo.nomtip,prueba.cantEjeRes,prueba.horInicio,prueba.horFin FROM prueba inner join usuarios on prueba.codusu=usuarios.codusu inner join tipo on prueba.codtip=tipo.codtip where prueba.codtip=1 and prueba.tipoPrueba='SIMULACRO' and prueba.culmino=1 order by cantEjeRes desc, tiempoTotal asc");
            ?>
            <?php 
              $con=0;
              while ($row = $result->fetch_assoc()) 
              {         
              ?>              
                <tr>
                  <td><?php echo ++$con; ?></td>
                  <td><?php echo $row["nomusu"]; ?></td>
                  <td><?php echo $row["codpru"]; ?></td>
                  <td><?php echo $row["tiempoTotal"]; ?></td>
                  <td><?php echo $row["nomtip"]; ?></td>
                  <td><?php echo $row["cantEjeRes"]; ?></td>
                  <td><?php echo $row["horInicio"]; ?></td>
                  <td><?php echo $row["horFin"]; ?></td>
                </tr>  
              <?php 
              }

              $result->free(); 
            ?> 
          </tbody>
        </table>
      </div>
      <div id="menu2" class="container tab-pane fade"><br>
        
        <div class="row">
          <div class="col-sm-6" style="text-align: left;">
            <h3>Concurso - DIGITACIÓN</h3>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a class="btn btn-primary" href="index2.php?tipoejercicio=1&nomtipoprueba=DIGITACIÓN&tipoprueba=CONCURSO" target="_blank">Concursar</a>
          </div>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>ORDEN</th>
              <th>USUARIO</th>
              <th>CODIGO PRUEBA</th>
              <th>TIEMPO</th>
              <th>TIPO</th>
              <th>PUNTAJE</th>
              <th>HOR.INICIO</th>
              <th>HOR.FIN</th>
            </tr>
          </thead>
          <tbody>
         <?php 
              ini_set('memory_limit', '-1');
              $i=0;
              $result = $conn->query("SELECT usuarios.usuario,usuarios.nomusu,prueba.codpru,prueba.tiempoTotal,tipo.nomtip,prueba.cantEjeRes,prueba.horInicio,prueba.horFin FROM prueba inner join usuarios on prueba.codusu=usuarios.codusu inner join tipo on prueba.codtip=tipo.codtip where prueba.codtip=1  and prueba.tipoPrueba='CONCURSO' and prueba.culmino=1  order by cantEjeRes desc, tiempoTotal asc");
            ?>
            <?php 
              $con=0;
              while ($row = $result->fetch_assoc()) 
              {         
              ?>              
                <tr>
                  <td><?php echo ++$con; ?></td>
                  <td><?php echo $row["nomusu"]; ?></td>
                  <td><?php echo $row["codpru"]; ?></td>
                  <td><?php echo $row["tiempoTotal"]; ?></td>
                  <td><?php echo $row["nomtip"]; ?></td>
                  <td><?php echo $row["cantEjeRes"]; ?></td>
                  <td><?php echo $row["horInicio"]; ?></td>
                  <td><?php echo $row["horFin"]; ?></td>
                </tr>  
              <?php 
              }

              $result->free(); 
            ?> 
          </tbody>
        </table>
      </div>


      <div id="menu3" class="container tab-pane fade"><br>
        
        <div class="row">
          <div class="col-sm-6" style="text-align: left;">
            <h3>Simulacro - DESARROLLO DE ALGORITMOS</h3>    
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <!--button class="btn btn-primary" onclick="alert('Pronto se habilitará esta opción.')">Probar</button-->
            <a class="btn btn-primary" href="index2.php?tipoejercicio=2&nomtipoprueba=DESARROLLO DE ALGORITMOS&tipoprueba=SIMULACRO" target="_blank">Probar</a>
          </div>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>ORDEN</th>
              <th>USUARIO</th>
              <th>CODIGO PRUEBA</th>
              <th>TIEMPO</th>
              <th>TIPO</th>
              <th>PUNTAJE</th>
              <th>HOR.INICIO</th>
              <th>HOR.FIN</th>
            </tr>
          </thead>
          <tbody>
         <?php 
              ini_set('memory_limit', '-1');
              $i=0;
              $result = $conn->query("SELECT usuarios.usuario,usuarios.nomusu,prueba.codpru,prueba.tiempoTotal,tipo.nomtip,prueba.cantEjeRes,prueba.horInicio,prueba.horFin FROM prueba inner join usuarios on prueba.codusu=usuarios.codusu inner join tipo on prueba.codtip=tipo.codtip where prueba.codtip=2 and prueba.tipoPrueba='SIMULACRO' and prueba.culmino=1 order by cantEjeRes desc, tiempoTotal asc");
            ?>
            <?php
              $con=0; 
              while ($row = $result->fetch_assoc()) 
              {         
              ?>              
                <tr>
                  <td><?php echo ++$con; ?></td>
                  <td><?php echo $row["nomusu"]; ?></td>
                  <td><?php echo $row["codpru"]; ?></td>
                  <td><?php echo $row["tiempoTotal"]; ?></td>
                  <td><?php echo $row["nomtip"]; ?></td>
                  <td><?php echo $row["cantEjeRes"]; ?></td>
                  <td><?php echo $row["horInicio"]; ?></td>
                  <td><?php echo $row["horFin"]; ?></td>
                </tr>  
              <?php 
              }

              $result->free(); 
            ?> 
          </tbody>
        </table>
      </div>
      <div id="menu4" class="container tab-pane fade"><br>
        
        <div class="row">
          <div class="col-sm-6" style="text-align: left;">
            <h3>Concurso - DESARROLLO DE ALGORITMOS</h3>
          </div>
          <div class="col-sm-6" style="text-align: right;">
            <a class="btn btn-primary" href="index2.php?tipoejercicio=2&nomtipoprueba=DESARROLLO DE ALGORITMOS&tipoprueba=CONCURSO"  target="_blank">Concursar</a>
          </div>
        </div>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>ORDEN</th>
              <th>USUARIO</th>
              <th>CODIGO PRUEBA</th>
              <th>TIEMPO</th>
              <th>TIPO</th>
              <th>PUNTAJE</th>
              <th>HOR.INICIO</th>
              <th>HOR.FIN</th>
            </tr>
          </thead>
          <tbody>
         <?php 
              ini_set('memory_limit', '-1');
              $i=0;
              $result = $conn->query("SELECT usuarios.usuario,usuarios.nomusu,prueba.codpru,prueba.tiempoTotal,tipo.nomtip,prueba.cantEjeRes,prueba.horInicio,prueba.horFin FROM prueba inner join usuarios on prueba.codusu=usuarios.codusu inner join tipo on prueba.codtip=tipo.codtip where prueba.codtip=2  and prueba.tipoPrueba='CONCURSO' and prueba.culmino=1  order by cantEjeRes desc, tiempoTotal asc");
            ?>
            <?php
              $con=0; 
              while ($row = $result->fetch_assoc()) 
              {         
              ?>              
                <tr>
                  <td><?php echo ++$con; ?></td>
                  <td><?php echo $row["nomusu"]; ?></td>
                  <td><?php echo $row["codpru"]; ?></td>
                  <td><?php echo $row["tiempoTotal"]; ?></td>
                  <td><?php echo $row["nomtip"]; ?></td>
                  <td><?php echo $row["cantEjeRes"]; ?></td>
                  <td><?php echo $row["horInicio"]; ?></td>
                  <td><?php echo $row["horFin"]; ?></td>
                </tr>  
              <?php 
              }

              $result->free(); 
            ?> 
          </tbody>
        </table>
      </div>
    </div>


    

 
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script type="text/javascript">

  var biblioteca11=[];
  var biblioteca12=[];
  var biblioteca13=[];
  var biblioteca14=[];
  var biblioteca15=[];
  var biblioteca16=[];
  var biblioteca17=[];
  var biblioteca18=[];
  var biblioteca19=[];
  var biblioteca110=[];
  var biblioteca111=[];
  var biblioteca112=[];
  var biblioteca113=[];
  var biblioteca114=[];
  var biblioteca115=[];

  var biblioteca21=[];
  var biblioteca22=[];
  var biblioteca23=[];
  var biblioteca24=[];
  var biblioteca25=[];
  var biblioteca26=[];
  var biblioteca27=[];
  var biblioteca28=[];
  var biblioteca29=[];
  var biblioteca210=[];
  
  var biblioteca31=[];
  var biblioteca32=[];
  var biblioteca33=[];
  var biblioteca34=[];
  var biblioteca35=[];

  $( document ).ready(function() 
  {
    <?php
    ini_set('memory_limit', '-1');
    $i=0;
    $result = $conn->query("select articulos_200_499__15.*, resumen_articulos.codresar, resumen_articulos.resumido from resumen_articulos inner join articulos_200_499__15 on resumen_articulos.codart20049915 = articulos_200_499__15.codart20049915 where resumen_articulos.codusu = ".$_SESSION['codusu']);

    while ($row = $result->fetch_assoc()) 
    {  
      $i++;
      if($row["resumido"]==1)                  
      {                  
        $datos_resumen_row = $conn->query("select indice, oracion from resumen where codresar = ".$row["codresar"]." order by indice asc");
        //ECHO "select indice, oracion from resumen where codresar = ".$row["codresar"]." order by indice asc";
        $cad="";
    
        while ($w = $datos_resumen_row->fetch_assoc())                     
        {
    
          //echo "<a class='block' href='#' onclick='remover(this,".$w["indice"].",biblioteca1".$i.");event.preventDefault();'>".$w["oracion"]."</a>";                           
    ?>          
          //escribirBD('<?php echo $w["oracion"]; ?>','<?php echo $w["indice"]; ?>','<?php echo "biblioteca1".$i; ?>','<?php echo "1".$i; ?>');
          escribirBD_biblioteca('<?php echo $w["oracion"]; ?>','<?php echo $w["indice"]; ?>','<?php echo "biblioteca1".$i; ?>','<?php echo "1".$i; ?>');
          //console.log('<?php echo "biblioteca1".$i; ?>');
    <?php

        }
         
      }
    }
    ?> 

    <?php
    ini_set('memory_limit', '-1');
    $i=0;
    $result = $conn->query("select articulos_500_799__10.*, resumen_articulos.codresar, resumen_articulos.resumido, resumen_articulos.saveupdate from resumen_articulos inner join articulos_500_799__10 on resumen_articulos.codart50079915  = articulos_500_799__10.codart50079915  where resumen_articulos.codusu = ".$_SESSION['codusu']);

    while ($row = $result->fetch_assoc()) 
    {  
      $i++;
      if($row["resumido"]==1)                  
      {                  
        $datos_resumen_row = $conn->query("select indice, oracion from resumen where codresar = ".$row["codresar"]." order by indice asc");        
        $cad="";    
        while ($w = $datos_resumen_row->fetch_assoc())                     
        {                           
    ?>    
          escribirBD_biblioteca('<?php echo $w["oracion"]; ?>','<?php echo $w["indice"]; ?>','<?php echo "biblioteca2".$i; ?>','<?php echo "2".$i; ?>');
    <?php
        }
      }
    }
    ?>

    <?php
    ini_set('memory_limit', '-1');
    $i=0;
    $result = $conn->query("select articulos_800_1099__5.*, resumen_articulos.codresar, resumen_articulos.resumido, resumen_articulos.saveupdate from resumen_articulos inner join articulos_800_1099__5 on resumen_articulos.codart800109915 = articulos_800_1099__5.codart800109915 where resumen_articulos.codusu = ".$_SESSION['codusu']);

    while ($row = $result->fetch_assoc()) 
    {  
      $i++;
      if($row["resumido"]==1)                  
      {                  
        $datos_resumen_row = $conn->query("select indice, oracion from resumen where codresar = ".$row["codresar"]." order by indice asc");        
        $cad="";    
        while ($w = $datos_resumen_row->fetch_assoc())                     
        {                           
    ?>    
          escribirBD_biblioteca('<?php echo $w["oracion"]; ?>','<?php echo $w["indice"]; ?>','<?php echo "biblioteca3".$i; ?>','<?php echo "3".$i; ?>');
    <?php
        }
      }
    }
    ?>  
       
  });

  function escribirBD_biblioteca(txt,num,arr,x)
  {
    
    switch("biblioteca"+x)
    {
      case "biblioteca11":
        escribirBD(txt,num,biblioteca11,x);        
      break;
      case "biblioteca12":
        escribirBD(txt,num,biblioteca12,x);  
      break;
      case "biblioteca13":
        escribirBD(txt,num,biblioteca13,x);  
      break;
      case "biblioteca14":
        escribirBD(txt,num,biblioteca14,x);  
      break;
      case "biblioteca15":
        escribirBD(txt,num,biblioteca15,x);  
      break;
      case "biblioteca16":
        escribirBD(txt,num,biblioteca16,x);  
      break;
      case "biblioteca17":
        escribirBD(txt,num,biblioteca17,x);  
      break;
      case "biblioteca18":
        escribirBD(txt,num,biblioteca18,x);  
      break;
      case "biblioteca19":
        escribirBD(txt,num,biblioteca19,x);  
      break;
      case "biblioteca110":
        escribirBD(txt,num,biblioteca110,x);  
      break;
      case "biblioteca111":
        escribirBD(txt,num,biblioteca111,x);  
      break;
      case "biblioteca112":
        escribirBD(txt,num,biblioteca112,x);  
      break;
      case "biblioteca113":
        escribirBD(txt,num,biblioteca113,x);  
      break;
      case "biblioteca114":
        escribirBD(txt,num,biblioteca114,x);  
      break;
      case "biblioteca115":
        escribirBD(txt,num,biblioteca115,x);  
      break;
      case "biblioteca21":
        escribirBD(txt,num,biblioteca21,x);  
      break;
      case "biblioteca22":
        escribirBD(txt,num,biblioteca22,x);  
      break;
      case "biblioteca23":
        escribirBD(txt,num,biblioteca23,x);  
      break;
      case "biblioteca24":
        escribirBD(txt,num,biblioteca24,x);  
      break;
      case "biblioteca25":
        escribirBD(txt,num,biblioteca25,x);  
      break;
      case "biblioteca26":
        escribirBD(txt,num,biblioteca26,x);  
      break;
      case "biblioteca27":
        escribirBD(txt,num,biblioteca27,x);  
      break;
      case "biblioteca28":
        escribirBD(txt,num,biblioteca28,x);  
      break;
      case "biblioteca29":
        escribirBD(txt,num,biblioteca29,x);  
      break;
      case "biblioteca210":
        escribirBD(txt,num,biblioteca210,x);  
      break;
      case "biblioteca31":
        escribirBD(txt,num,biblioteca31,x);  
      break;
      case "biblioteca32":
        escribirBD(txt,num,biblioteca32,x);  
      break;
      case "biblioteca33":
        escribirBD(txt,num,biblioteca33,x);  
      break;
      case "biblioteca34":
        escribirBD(txt,num,biblioteca34,x);  
      break;
      case "biblioteca35":
        escribirBD(txt,num,biblioteca35,x);  
      break;

    }  
  }
 
   //escribir los resumenes guardados

  function escribirBD(txt,num,arr,x)
  {
    //se debe agregar la oración al array con su indice 
    //console.log("ini "+x);  
    arr[num]=txt;//$(t).html();
    //se imprime como boton en el orden de su indice.
    //console.log("-----------------");
    $("#zona_"+x).empty();
    for (var i = 0; i < arr.length; i++) 
    {
      if(typeof arr[i] !== 'undefined')
      {
        $("#zona_"+x).append("<a class='block' href='#' onclick='remover(this,"+i+",biblioteca"+x+");event.preventDefault();'>"+arr[i]+"</a>");
      }     
    }   
  }

  function escribir(t,num,arr,x)
  {
    //se debe agregar la oración al array con su indice 
    //console.log("ini "+x);  
    arr[num]=$(t).html();
    //se imprime como boton en el orden de su indice.
    //console.log("-----------------");
    $("#zona_"+x).empty();
    for (var i = 0; i < arr.length; i++) 
    {
      if(typeof arr[i] !== 'undefined')
      {
        $("#zona_"+x).append("<a class='block' href='#' onclick='remover(this,"+i+",biblioteca"+x+");event.preventDefault();'>"+arr[i]+"</a>");
      }     
    }   
  }

  function remover(t,n,arra)
  {
    delete(arra[n]);
    $(t).remove();
  }

  

  function registrarResultados(t,x,cod)
  {
    
    switch("biblioteca"+x)
    {
      case "biblioteca11":
        recorrer(t,biblioteca11,cod);        
      break;
      case "biblioteca12":
        recorrer(t,biblioteca12,cod);        
      break;
      case "biblioteca13":
        recorrer(t,biblioteca13,cod);        
      break;
      case "biblioteca14":
        recorrer(t,biblioteca14,cod);        
      break;
      case "biblioteca15":
        recorrer(t,biblioteca15,cod);        
      break;
      case "biblioteca16":
        recorrer(t,biblioteca16,cod);        
      break;
      case "biblioteca17":
        recorrer(t,biblioteca17,cod);        
      break;
      case "biblioteca18":
        recorrer(t,biblioteca18,cod);        
      break;
      case "biblioteca19":
        recorrer(t,biblioteca19,cod);        
      break;
      case "biblioteca110":
        recorrer(t,biblioteca110,cod);        
      break;
      case "biblioteca111":
        recorrer(t,biblioteca111,cod);        
      break;
      case "biblioteca112":
        recorrer(t,biblioteca112,cod);        
      break;
      case "biblioteca113":
        recorrer(t,biblioteca113,cod);        
      break;
      case "biblioteca114":
        recorrer(t,biblioteca114,cod);        
      break;
      case "biblioteca115":
        recorrer(t,biblioteca115,cod);        
      break;
      case "biblioteca21":
        recorrer(t,biblioteca21,cod);        
      break;
      case "biblioteca22":
        recorrer(t,biblioteca22,cod);        
      break;
      case "biblioteca23":
        recorrer(t,biblioteca23,cod);        
      break;
      case "biblioteca24":
        recorrer(t,biblioteca24,cod);        
      break;
      case "biblioteca25":
        recorrer(t,biblioteca25,cod);        
      break;
      case "biblioteca26":
        recorrer(t,biblioteca26,cod);        
      break;
      case "biblioteca27":
        recorrer(t,biblioteca27,cod);        
      break;
      case "biblioteca28":
        recorrer(t,biblioteca28,cod);        
      break;
      case "biblioteca29":
        recorrer(t,biblioteca29,cod);        
      break;
      case "biblioteca210":
        recorrer(t,biblioteca210,cod);        
      break;
      case "biblioteca31":
        recorrer(t,biblioteca31,cod);        
      break;
      case "biblioteca32":
        recorrer(t,biblioteca32,cod);        
      break;
      case "biblioteca33":
        recorrer(t,biblioteca33,cod);        
      break;
      case "biblioteca34":
        recorrer(t,biblioteca34,cod);        
      break;
      case "biblioteca35":
        recorrer(t,biblioteca35,cod);        
      break;

    }  
  }

  function recorrer(t,array_,codresar_)
  {
    $(t).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
    $.ajax({
          type: "POST",
          url : "eliminar.php",
          data: "codresar=" + codresar_,
          success: function(data) 
          {
            console.log("sucess");     

            for (var i = 0; i < array_.length; i++) 
            {
              if(typeof array_[i] !== 'undefined')
              {
                console.log(i+" "+array_[i]+" -> "+codresar_);

                $.ajax({
                    type: "POST",
                    url : "guardar.php",
                    data: "codresar=" + codresar_+ "&indice=" + i+ "&oracion=" + array_[i],
                    async: false,
                    success: function(data) 
                    {
                       console.log("sucess");
                    }
                });

              }     
            }

            $.ajax({
                type: "POST",
                url : "actualizar.php",
                data: "codresar=" + codresar_,
                async: false,
                success: function(data) 
                {                  
                  //alert(data);
                  $(t).html('<i class="fa fa-save"></i> Guardar<p style="padding: 0px 0px;font-size: 10px;margin-bottom: 3px;">Actualizado '+data+'</p>');                  
                }
            });

        }
      }); 
  }

  
  $(".block").click(function(event)
  {
    event.preventDefault();
  });
  

</script>