<?php
  
      $buscar = $_POST['b'];
        
      if(!empty($buscar)) {
            buscar($buscar);
      }
        
      function buscar($b) {
            $con = mysql_connect('localhost','root','Ramses2005*');
            mysql_select_db('pantalon', $con);
        
            $sql = mysql_query("SELECT * FROM productos WHERE codigoBarras LIKE '%".$b."%' LIMIT 10" ,$con);
              
            $contar = @mysql_num_rows($sql);
              
            if($contar == 0){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{
               while($row=mysql_fetch_array($sql)){
                $nombre = $row['descripcionProducto'];
                $cb = $row['codigoBarras'];
                echo $cb." - "."<a>".$nombre."</a>"."<br />";
            }
        }
  }
        
?>