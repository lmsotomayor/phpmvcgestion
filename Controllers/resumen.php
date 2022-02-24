<?php 
	require_once("../Models/resumen.php");
	$boton= $_POST['boton'];


	if ($boton==='ventasDiariasResumen') {

	
		$fecha1=$_POST['fecha1'];
		$fecha2=$_POST['fecha2'];
		$inst = new resumen();
		$r=$inst->buscar_VentasDiariasResumen($fecha1,$fecha2);
		echo json_encode($r);
		
	}

	if ($boton==='ventasTotalResumen') {

		$inst = new resumen();
		$r=$inst->buscar_VentasTotalResumen();
		echo json_encode($r);
		
	}

	if ($boton==='ventasTotalResumenProductos') {

		$valor1=$_POST['valor1'];
		$inst = new resumen();
		$r=$inst->buscar_VentasTotalResumenProductos($valor1);
		echo json_encode($r);
		
	}

	if ($boton==='devolucionesTotalResumenProductos') {

		$valor1=$_POST['valor1'];
		$inst = new resumen();
		$r=$inst->buscar_devolucionesTotalResumenProductos($valor1);
		echo json_encode($r);
		
	}

	if ($boton==='verVentasDiariasResumen') 
	{
		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $fecha1=$_POST['fecha1'];
        $fecha2=$_POST['fecha2'];
        $sucursalVentas=$_POST['sucursalVentas'];
        $inst = new resumen();
		$a= $inst->lista_VentasDiariasResumen1($fecha1,$fecha2,$sucursalVentas);
		$b=count($a);
		$c= $inst->lista_VentasDiariasResumen1($fecha1,$fecha2,$sucursalVentas,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if ($boton==='buscar_productos_resumen_productos') 
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor1=$_POST['valor1'];
         
        $inst = new resumen();
		$a= $inst->lista_VentasProductosResumen($valor1);
		$b=count($a);
		$c= $inst->lista_VentasProductosResumen($valor1,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if ($boton==='buscar_detalleVentaResumenxProducto') 
	{
		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor1=$_POST['valor1'];
        $inst = new resumen();
		$a= $inst->lista_detalleVentaResumenxProducto($valor1);
		$b=count($a);
		$c= $inst->lista_detalleVentaResumenxProducto($valor1,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}



	

?>