 <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM marcaproducto ORDER BY nombreMarcaProducto ASC");

                                                                        echo '<option value="0">Seleccione</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idMarcaProducto'] . '">' . $row['nombreMarcaProducto'] . '</option>' . "/n";
                                                                        }


                                                                        ?>      