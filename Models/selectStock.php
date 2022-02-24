<?php

    $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

    $query = $conexion->query("SELECT t1.*, IFNULL(t2.nombreTelaProducto,'') as tela, IFNULL(t3.nombreTalleProducto,'')as talle,IFNULL(t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,'') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto  ORDER BY descripcionProducto ASC");

    echo '<option value="0">Seleccione</option>';

        while ($row = $query->fetch_assoc())
            {
                echo '<option value ="' . $row['idProducto'] . '">' . $row['descripcionProducto'] . " " . "/" . " ". $row['talle']  .'</option>' . "/n";
            }


?>   