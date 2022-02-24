<?php
if (!defined('IN_CB')) { die('No se permite acceder a esta página.'); }
?>



<html>
 


</head>
    <body>





        <form>
            <div class="output">
                <section id="output" class="output">
                    <h3>Codigo de Barra</h3>
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen($finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                       
                    ?>
                    
                    <div id="imageOutput">
                  
                       <?php if ($imageKeys['text'] !== '') { 
     $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

$query = $conexion->query("SELECT descripcionProducto FROM productos where codigoBarras='".$_POST['descripcionProducto']."' ");



while ($row = $query->fetch_assoc())
{
    
    
    echo "<font size=\"1\">".$row['descripcionProducto']."</font>";
   
?>
                        
<br></br>

<?php
}
                         if($_POST['codbarras']==1){ 
                             




?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        
                     <?php }?>
                         <?php  if($_POST['codbarras']==2){ $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");


?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     <?php }?>
                         <?php   if($_POST['codbarras']==3){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     <?php }?>
                           <?php  if($_POST['codbarras']==4){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                            <?php }?>
                                                    
                       
                     <?php  if($_POST['codbarras']==5){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                       
                     <?php  if($_POST['codbarras']==6){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==7){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==8){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==9){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==10){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==11){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==12){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==13){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==14){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                      <?php  if($_POST['codbarras']==15){ ?><img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" /> &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                     &nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />&nbsp&nbsp&nbsp<img src="image.php<?php echo $finalRequest; ?>" alt="Barcode Image" />
                        <?php }?>
                     
                        <?php }  else { ?>Llene el formulario para generar un código de barras y luego imprima.<?php } ?>
                    
                    </div>
                    
                </section>
               
            </div>
            
            <center><input type="button" value="Imprimir Codigos" onclick="javascript:imprSelec('imageOutput');function imprSelec(imageOutput)
{var ficha=document.getElementById('imageOutput');var ventimp = window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML).normalize();ventimp.document.close();ventimp.print;ventimp.close();};"/></center>
   
        </form>
   
        <br>
        <br>
        <br>
        <br>
        <br>
       <center><b><font face="Arial" size="3" color="turquoise"><a href="/pantalon/Views/principal.php">Volver al Menu</a></font></b></center>
    
</body>
</html>

      