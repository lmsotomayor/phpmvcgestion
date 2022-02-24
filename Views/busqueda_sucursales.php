
<?php 
session_start();
if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES') 
{?>
<!DOCTYPE html>
<html lang="en">
    <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                
                <title>La Casa del Pantalon</title>
               
                <link rel="stylesheet" href="../css/bootstrap.min.css">
                <script src="../js/jquery-2.2.2.min.js"></script>
                <script src="../js/jquery-ui.1-10.1.js"></script>
                <link rel="stylesheet" href="../js/jquery_css.js" />
                <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
                <script src="../js/jquery.dropotron.min.js"></script>
                <link rel="stylesheet" src="../css/bootstrap.css"> 
                <script src="../js/jquery-1.11.2.js"></script>
                <script src="../js/bootstrap.min.js"></script>
                <script src="../js/funciones.js"></script>
                <link rel="stylesheet" href="../css/alertify.core.css" />
                <link rel="stylesheet" href="../css/alertify.default.css" id="toggleCSS" /> 
                <script src="../js/jquery.maskMoney.js"></script>
                <link href="../images/icono_pantalon.png" rel="shortcut icon" type="image/x-icon" />  
    </head>

 

<body  onload="busquedaSucursales('');" style= "background: url(../images/fondopantalla.jpg) repeat;">
                
   <!--Barra de Navegacion-->
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" >La casa del pantalón</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       
      
   

      </ul>
    </div>
  </div>
</nav>
 
<div class="container">
 
       
                    
    <div class="tab-content">

        <!--tab de productos-->
        <div class="tab-pane active" id="tab_sucursales">
            <div class="row">
                    <div class="col-md-12">
                            <div class="panel panel-default" >
                                <div class="panel-heading" style="background-color:STEELBLUE">Datos de Sucursales</div>
                                       
                                            <div class="form-group">
                                                <div id="lista_sucursales_busqueda"></div> 
                                             
                                            </div> 
                            </div>        
                    </div>
            </div>
       </div><!--fin del tab de sucursales-->
 
    </div><!--fin del tab-->

</div><!--fin del container-->

<script src="../js/alertify.min.js"></script>



                <script>
                    function cerrar()
                    {
                        $.ajax({
                            url:'../Controllers/usuario.php',
                            type:'POST',
                            data:"mensaje=mensaje&boton=cerrar"
                        }).done(function(resp){
                             location.href='../views/index.php';
                        });
                    }
                </script>
            </html>

            <?php

              }
              else
              {
                header("location: ../Views/Index.php");
              }
             ?>
                