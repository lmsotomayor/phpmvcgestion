<?php 
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES') 

  {
if($_SESSION['nombre']=='administrador'){
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   
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
    <link href="../images/icono_pantalon.png" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="../css/alertify.core.css" />
    <link rel="stylesheet" href="../css/alertify.default.css" id="toggleCSS" />



</head>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script> 
 
<body onload="consulta_devolucion('',1);" style= "background: url(../images/fondopantalla.jpg) repeat;" onload="verUsuarios();"  >
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
 
    <div class="tab-content" >

     	<div class="tab-pane active " id="tab_vendedores">
            <div class="row form-horizontal">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="background-color:LIGHTSTEELBLUE">Devoluciones</div>
	                                        <div class="panel-body">
	                                            <div class="form-group">
                                                <div class="col-xs-4  text-right">
                                                    <label for="buscarDevoluciones" class="control-label" >Buscar Producto:</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <input  type="text" name="buscarDevoluciones" id="buscarDevoluciones" class="form-control" onkeyup="consulta_devolucion(this.value,1);" placeholder="Ingrese descripción del producto o Código de Barras"/>
                                                </div>
                                                <div class="col-xs-4">  
                                                 <button type="button"  data-toggle='modal'  data-target='#modal_masDevueltos' class="btn btn-info"    onclick="masDevueltos();">Productos mas devueltos</button>  
                                               
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div id="lista_devolucionesGeneral"></div> 
                                                <div id="paginador_devoluciones" class="text-center"></div> 
                                            </div> 
	                                        </div>
                                    </div>
                                </div>
                                             
            </div><!--fin del row-->

        </div><!--fin del tabpanel vendedores-->


    </div><!--fin de tab-content-->


    <!--modal de mas devueltos-->
    <div class="modal fade bs-example-modal-lg" id="modal_masDevueltos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="width:50%">
           <div class="modal-content">
               <div class="modal-header text-center" style="background-color:LIGHTSTEELBLUE">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h2 class="modal-title">Productos mas devueltos</h2>
                                    </div>
                                    <br>
          		<div class="modal-body">
                          <div id="lista_productos_masvendidos"></div> 
                          </div>
          		</div>
          </div>
    </div><!--fin del modal de mas devueltos-->   

     <!--modal motivo-->
    <div class="modal fade bs-example-modal-lg" id="modal_motivoDevolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="width:50%">
           <div class="modal-content">
               <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h2 class="modal-title">Motivo de Devolución</h2>
                                    </div>
                                    <br>
          <div class="modal-body">
                      	
                          <div class="form-group">
						  <label for="comment">Motivo:</label>
						   <input type="text" name="motivoArea" id="motivoArea" class="form-control"/>
                           
                          </div>
                                       
            </div>
          </div>
    </div><!--fin del modal de motivos-->   


</div><!--fin de container-->  

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
      

       

        
</body>

<script>
       
        $('.modal-dialog').draggable({
            handle: ".modal-header"
        });
</script> 

<html>




      




<?php
    }
    else{
      
      echo "<script languaje='javascript' type='text/javascript'>window.alert('Sin Acceso a esta página');</script>";
      echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
  }
  else
  {
    header("location: ../Views/Index.php");
  }
 ?>
