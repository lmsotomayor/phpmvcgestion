  <?php

                                                                        $conexion = mysqli_connect("localhost","root","Ramses2005*","pantalon");

                                                                        $query = $conexion->query("SELECT * FROM telaproducto ORDER BY nombreTelaProducto ASC");

                                                                        echo '<option value="0">Seleccione</option>';

                                                                        while ($row = $query->fetch_assoc())
                                                                        {
                                                                            echo '<option value ="' . $row['idTelaProducto'] . '">' . $row['nombreTelaProducto'] . '</option>' . "/n";
                                                                        }


                                                                        ?>        