
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

 <script type="text/javascript">

            function buscar_caracteristicas() {

          
            var txt1 =  $("#selectBuscarMarca option:selected").val();
            var txt2 = $("#selectBuscarModelo option:selected").val();
            var txt3 = $("#selectBuscarTalle option:selected").val();
            var txt4 = $("#selectBuscarColor option:selected").val();
            var txt5 = $("#selectBuscarTela option:selected").val();



            if($("#selectBuscarMarca option:selected").val() == 0 &&
               $("#selectBuscarModelo option:selected").val() == 0 &&
               $("#selectBuscarTalle option:selected").val() == 0 &&
               $("#selectBuscarColor option:selected").val() == 0 &&
               $("#selectBuscarTela option:selected").val() == 0){
               
            alertify.alert("Se mostraran todos los productos");
                productos_stock_caracteristicas();
            }else{   

                if(txt1==0){
                txt1 = '';
                }
                if(txt2==0){
                txt2 = '';
                }
                if(txt3==0){
                txt3 = '';
                }
                if(txt4==0){
                txt4 = '';
                }
                if(txt5==0){
                txt5 = '';
                }
               
                productos_stock_caracteristicas(txt1,txt2,txt3,txt4,txt5);
               
            }
           
                   
            }

          
            

</script>

<body  onload="productos_stock('','1');" style= "background: url(../images/fondopantalla.jpg) repeat;">
                
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
 
        <div class="row form-horizontal">
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_productos" data-toggle="tab">Productos por CB o Descripción</a></li>
                          <li><a href="#tab_productos_caracteristicas" data-toggle="tab">Productos por caracteristicas</a></li>
                        </ul>
        </div>
                    
    <div class="tab-content">

        <!--tab de productos-->
        <div class="tab-pane active" id="tab_productos">
            <div class="row">
                    <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Productos por codigo de barras o descripción</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-xs-4  text-right">
                                                    <label for="buscar" class="control-label">Buscar Producto:</label>
                                                </div>
                                                
                                                    <div class="col-xs-4">
                                                    
                                                        <input  type="text" name="buscar" id="buscar" class="form-control" onkeyup="productos_stock(this.value,'1');"  placeholder="Ingrese CB o descripción del producto" />
                                                    </div>
                                            </div>
                                            <br>   
                                        </div>
                                            <div class="form-group">
                                                <div id="lista_productos_stock2"></div> 
                                              <div id="paginador" class="text-center"></div> 
                                            </div> 

                                     <!--muestro el resultado de la busqueda-->    
                                        <div class="col-md-6" >

                                                <div class="well well-sm" style="background-color:#B0C4DE;">
                                                <center>
                                                <h2>Stock Consulta</h2>
                                                      <h3><input  type="text" disabled name="stockBusqueda1" id="stockBusqueda1" style="text-align:center; background-color:#B0C4DE;border-width:0;"/><h3>
                                                      
                                                </center>
                                                </div>

                                        </div> 
                                        <div class="col-md-6" >

                                                <div class="well well-sm" style="background-color:#B0C4DE;">
                                                <center>
                                                <h2>Stock Total</h2>
                                                      <h3><input  type="text" disabled name="stockTotal" id="stockTotal" style="text-align:center; background-color:#B0C4DE;border-width:0;"/><h3>
                                                      
                                                </center>
                                                </div>

                                        </div>          
                                    </div>        
                    </div>

                     <!--empieza el modal de stock por sucursales-->
                    <div class="modal fade " id="modal_stockxsucursales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h2 class="modal-title">Stock por Sucursales</h2>
                                    </div>
                            <br>
                            <div class="form-group">
                                                       
                                        
                            </div>

                            <div class="modal-body">
                                                      
                                    <!--aca muestro la lista por sucursales-->                              
                                    <div id="lista_stockxsurcursales"></div> 

                                    <div class="modal-footer">  
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>

                             </div>
                                                           
                                                            
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal modal de stock por sucursales -->  

                 
                                        
            </div>
                         
        </div><!--fin del tab de productos-->
   

  

        <!--tab de productos x caracteristicas-->
        <div class="tab-pane" id="tab_productos_caracteristicas">
            <div class="row">
                    <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Productos por caracteristicas</div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-xs-2">
                                                             <select  id="selectBuscarMarca"  name="selectBuscarMarca" class="form-control">
                                                                   <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM marcaProducto ORDER BY nombreMarcaProducto ASC");

                                                                        echo '<option value="0">Marca</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idMarcaProducto'] . '">' . $row['nombreMarcaProducto'] . '</option>' . "/n";
                                                                        }


                                                                    ?>                
                                                             </select>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-xs-2">
                                                             <select  id="selectBuscarModelo"  name="selectBuscarModelo" class="form-control">
                                                                   <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM modeloProducto ORDER BY nombreModeloProducto ASC");

                                                                        echo '<option value="0">Modelo</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idModeloProducto'] . '">' . $row['nombreModeloProducto'] . '</option>' . "/n";
                                                                        }


                                                                    ?>                
                                                             </select>
                                                    </div>
                                                </div>    

                                                <div class="form-group">
                                                    <div class="col-xs-2">
                                                             <select  id="selectBuscarTalle"  name="selectBuscarTalle" class="form-control">
                                                                   <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM talleProducto ORDER BY nombreTalleProducto ASC");

                                                                        echo '<option value="0">Talle</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idTalleProducto'] . '">' . $row['nombreTalleProducto'] . '</option>' . "/n";
                                                                        }


                                                                    ?>                
                                                             </select>
                                                    </div>
                                                </div>  

                                                <div class="form-group">
                                                    <div class="col-xs-2">
                                                             <select  id="selectBuscarColor"  name="selectBuscarColor" class="form-control">
                                                                   <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM colorProducto ORDER BY nombreColorProducto ASC");

                                                                        echo '<option value="0">Color</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idColorProducto'] . '">' . $row['nombreColorProducto'] . '</option>' . "/n";
                                                                        }


                                                                    ?>                
                                                             </select>
                                                    </div>
                                                </div>    

                                                <div class="form-group">
                                                    <div class="col-xs-2">
                                                             <select  id="selectBuscarTela"  name="selectBuscarTela" class="form-control">
                                                                   <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM telaProducto ORDER BY nombreTelaProducto ASC");

                                                                        echo '<option value="0">Tela</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idTelaProducto'] . '">' . $row['nombreTelaProducto'] . '</option>' . "/n";
                                                                        }


                                                                    ?>                
                                                             </select>
                                                    </div>
                                                </div>       


                                                <div class="form-group " >
                                                          <div class="col-xs-2">
                                                            
                                                             <button type="button"  class="btn btn-success btn-block" onclick="productos_stock_caracteristicas(1);">Buscar</button>  
                                                          </div>
                                                </div>
                                                   
                                            </div><!--fin de form-group-->
                                           
                                        </div><!--fin del panel body-->
                                        
                                        <div class="form-group">
                                                <div id="lista_productos_caracteristicas"></div> 
                                                <div id="lista_productos_caracteristicas_paginador" class="text-center"></div> 
                                        </div> 
                                        <!--muestro el resultado de la busqueda-->    
                                        <div class="col-md-12" >

                                                <div class="well well-sm" style="background-color:#B0C4DE;">
                                                <center>
                                                <h2>Stock Consulta</h2>
                                                      <h3><input  type="text" disabled name="stockBusqueda2" id="stockBusqueda2" style="text-align:center; background-color:#B0C4DE;border-width:0;"/><h3>
                                                </center>
                                                </div>
                                        </div>
                                    </div><!--fin del panel heading-->    

                                    
                    
                                        
               
                            
                       <!--empieza el modal de stock por sucursales-->
                    <div class="modal fade " id="modal_stockxsucursales2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h2 class="modal-title">Stock por Sucursales</h2>
                                    </div>
                            <br>
                            <div class="form-group">
                                                        
                                        
                            </div>

                            <div class="modal-body">
                                                      
                                    <!--aca muestro la lista por sucursales-->                              
                                    <div id="lista_stockxsurcursales2"></div> 

                                    <div class="modal-footer">  
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>

                             </div>
                                                           
                                                            
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal modal de stock por sucursales --> 


                   

                </div><!--fin del md12-->    
            </div><!--fin del class row-->  

            <!--aca muestro el stock total de la consulta-->
     

        </div><!--fin del tab de descripcion-->



    </div><!--fin del tab-->

      <!--modal para ver cambios de precios-->
                       <div class="modal fade bs-example-modal-lg" id="modal_cambioPrecios2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog " style="width:30%">
                           <div class="modal-content">
                               <div class="modal-header text-center" style="background-color:KHAKI">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h3 class="modal-title">Ultimos cambios de precios</h3>
                                                    </div>
                                                    <br>
                              <div class="modal-body">
                                         <div id="lista_ultimos_precios2"></div> 
                                       
                              </div>
                           </div>
                          </div>
                        </div><!--fin del modal para ver cambios de precios-->      

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
                