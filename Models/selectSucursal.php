<?php

    $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

    $query = $conexion->query("SELECT * FROM sucursal ORDER BY nombreSucursal ASC");

    echo '<option value="0">Seleccione</option>';

        while ($row = $query->fetch_assoc())
            {
                echo '<option value ="' . $row['idSucursal'] . '">' . $row['nombreSucursal'] . "  -  " . utf8_encode($row['direccionSucursal']) . '</option>' . "/n";
            
            }


?>        


