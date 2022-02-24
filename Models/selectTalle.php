 <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM talleproducto ORDER BY nombreTalleProducto ASC");

                                                                        echo '<option value="0">Seleccione</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idTalleProducto'] . '">' . $row['nombreTalleProducto'] . '</option>' . "/n";
                                                                        }


                                                                        ?>       