<?php 
	require_once("../Models/opciones.php");
	$boton= $_POST['boton'];
	
	if ($boton==='incrementoPrecios') {
		$inst = new opciones();
		$idProducto=$_POST['idProducto'];
		$incrementoProducto=$_POST['incrementoProducto'];
		
		
		if($inst->incrementoProducto($idProducto,$incrementoProducto)){
			echo 'exito_incremento';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='verSucursal') 
	{
		$valor=$_POST['valor'];
		$inst = new opciones();
		$r=$inst ->lista_sucursal($valor);
		//print_r($r);
		echo json_encode($r);
	}

	if ($boton==='verSucursalesBusqueda') 
	{
		$inst = new opciones();
		$r=$inst ->lista_sucursal('');
		echo json_encode($r);
	}
		
	if ($boton==='actualizar_sucursal') {
		$inst = new opciones();
		$idSucursal=$_POST['idSucursal'];
		$nombreSucursal=$_POST['nombreSucursal'];
		$direccionSucursal=$_POST['direccionSucursal'];
		$telefonoSucursal=$_POST['telefonoSucursal'];
		
		
		if($inst->actualizar_sucursal($idSucursal,$nombreSucursal,$direccionSucursal,$telefonoSucursal)){
			echo 'exito';
		}
		else{
			echo "";
		}
	}


	if ($boton==='verVendedores') 
	{

		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new opciones();
		$a= $inst->lista_vendedores($valor);
		$b=count($a);
		$c= $inst->lista_vendedores($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if ($boton==='insertar_vendedores') {
		$inst = new opciones();
		$idVendedores=$_POST['idVendedores'];
		$selectSucursal=$_POST['selectSucursal'];
		$numeroVendedores=$_POST['numeroVendedores'];
		$nombreVendedores=$_POST['nombreVendedores'];
			
		
		
		if($inst->insertar_vendedores($idVendedores,$selectSucursal,$numeroVendedores,$nombreVendedores)){
			echo 'exito';
		}
		else{
			echo 'No se puede ingresar el vendedor';
		
		}

	}


	if ($boton==='actualizar_vendedores') {
		$inst = new opciones();
		$idVendedores=$_POST['idVendedores'];
		$selectSucursal=$_POST['selectSucursal'];
		$numeroVendedores=$_POST['numeroVendedores'];
		$nombreVendedores=$_POST['nombreVendedores'];
		
		
		if($inst->actualizar_vendedores($idVendedores,$selectSucursal,$numeroVendedores,$nombreVendedores)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}


	if($boton==='eliminar_vendedores_confirma')
	{
		$idVendedores=$_POST['idVendedores'];
		$inst = new opciones();
		if($inst->eliminar_venderores_confirma($idVendedores)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	if($boton==='eliminar_vendedor')
	{
		$idVendedores=$_POST['idVendedores'];
		$inst = new opciones();
		if($inst->eliminar_vendedor($idVendedores)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if ($boton==='verProductoEnvio') 
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new opciones();
		$a=$inst->lista_ProductoEnvio($valor);
		$b=count($a);
		$c=$inst->lista_ProductoEnvio($valor,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if ($boton==='verProductoEnvioVenta') 
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$sucursal=$_POST['sucursal'];
		$inst = new opciones();
		$a=$inst->lista_ProductoEnvioVenta($valor,$sucursal);
		$b=count($a);
		$c=$inst->lista_ProductoEnvioVenta($valor,$sucursal,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if ($boton==='envioStock') {
		$inst = new opciones();
		$idProductoEnvio=$_POST['idProductoEnvio'];
		$productoSeleccionadoSucursal=$_POST['productoSeleccionadoSucursal'];
		$selectSucursalDestino=$_POST['selectSucursalDestino'];
		$cantidadEnvio=$_POST['cantidadEnvio'];
		$fechaEnvio=$_POST['fechaEnvio'];
			
		
		
		if($inst->insertar_envio($idProductoEnvio,$productoSeleccionadoSucursal,$selectSucursalDestino,$cantidadEnvio,$fechaEnvio)){
			echo 'exito';
		}
		else{
			echo "No se puedo realizar el envio.";
		
		}

	}

	if ($boton==='envioStockVenta') {
		$inst = new opciones();
		$idProductoEnvio2=$_POST['idProductoEnvio2'];
		$productoSeleccionadoSucursal2=$_POST['productoSeleccionadoSucursal2'];
		$selectSucursalDestino2=$_POST['selectSucursalDestino2'];
		$cantidadEnvio2=$_POST['cantidadEnvio2'];
		$fechaEnvio2=$_POST['fechaEnvio2'];
			
		
		
		if($inst->insertar_envio_venta($idProductoEnvio2,$productoSeleccionadoSucursal2,$selectSucursalDestino2,$cantidadEnvio2,$fechaEnvio2)){
			echo 'exito';
		}
		else{
			echo "No se puedo realizar el envio.";
		
		}

	}

	//boton de historial de envios para opciones	
	if ($boton==='verEnvioHistorial') {
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$inst = new opciones();
		$a=$inst ->buscarEnvioHistorial($valor1,$valor2);
		$b=count($a);
		$c=$inst->buscarEnvioHistorial($valor1,$valor2,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}
	
	//boton de historial de venta	
	if ($boton==='verEnvioHistorialVenta') {
	
		$fechaVenta=$_POST['fechaVenta'];
		$inst = new opciones();
		$r=$inst->buscarEnvioHistorialVenta($fechaVenta);
		echo json_encode($r);
	}

	//esta funcion es para buscar por los select
	if($boton==='buscar_productos_precios_caracteristicas')
	{
		
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$valor3=$_POST['valor3'];
		$valor4=$_POST['valor4'];
		$valor5=$_POST['valor5'];
		$inst = new opciones();
		$r=$inst ->lista_productos_precios_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5);
		echo json_encode($r);
	}

	//esta funcion es para buscar por los select en cambio de precios
	if($boton==='buscar_productos_stock_caracteristicas')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$valor3=$_POST['valor3'];
		$valor4=$_POST['valor4'];
		$valor5=$_POST['valor5'];
		$inst = new opciones();
		$a=$inst->lista_productos_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5);
		$b=count($a);
		$c= $inst->lista_productos_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}


	if ($boton==='actualizar_precioPorValor') {
		$inst = new opciones();
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$valor3=$_POST['valor3'];
		$valor4=$_POST['valor4'];
		$valor5=$_POST['valor5'];
		$precioNuevo=$_POST['precioNuevo'];
		$fechaPrecio=$_POST['fechaPrecio'];
		
		
		if($inst->actualizar_precios_por_valor($valor1,$valor2,$valor3,$valor4,$valor5,$precioNuevo,$fechaPrecio)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	//esta funcion es para buscar el historial de cambio de precios
	if($boton==='buscar_cambios_precios')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		
		$inst = new opciones();
		$a=$inst->lista_cambio_precios();
		$b=count($a);
		$c= $inst->lista_cambio_precios($inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	//esta funcion es para buscar el historial de cambio de precios
	if($boton==='buscar_detalle_precios')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$id=$_POST['id'];
		$inst = new opciones();
		$a=$inst->lista_detalle_precios($id);
		$b=count($a);
		$c= $inst->lista_detalle_precios($id,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='verUltimosPrecios')
	{
		
        $valor=$_POST['valor'];
      	$inst = new opciones();
		$r=$inst->buscar_ultimosPrecios($valor);
		echo json_encode($r);
	}

//formas de pago////////////////////////////////////////////////////////////////////////////
	
	if ($boton==='verFormasPagoOpciones') 
	{

		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new opciones();
		$a= $inst->lista_formasPago_opciones($valor);
		$b=count($a);
		$c= $inst->lista_formasPago_opciones($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if ($boton==='insertar_forma_de_pago') {
		$inst = new opciones();
		$descripcionPago=$_POST['descripcionPago'];
				
		if($inst->insertar_pago_controller($descripcionPago)){
			echo 'exito';
		}
		else{
			echo "No se pudo ingresar la forma de pago.";
		
		}

	}

	if($boton==='eliminar_formaDePago_confirma')
	{
		$idFormaPago=$_POST['idFormaPago'];
		$inst = new opciones();
		if($inst->eliminar_formadepago_confirma($idFormaPago)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	if($boton==='eliminar_formaDePago')
	{
		$idFormaPago=$_POST['idFormaPago'];
		$inst = new opciones();
		if($inst->eliminar_formaDePago($idFormaPago)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if ($boton==='actualizar_forma_de_pago_controller') {
		$inst = new opciones();
		$idFormaPago=	$_POST['idFormaPago'];
		$descripcionPago = $_POST['descripcionPago'];	
		
		if($inst->actualizar_forma_de_pago_model($idFormaPago,$descripcionPago)){
			echo 'exito';
		}
		else{
			echo "";
		}
	}

////devoluciones//////////////////////////////

	if($boton==='lista_devoluciones_opciones')
	{
		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        
              
		$ins=new opciones();
		$a= $ins->lista_devoluciones_opciones1();
		$b=count($a);
		$c= $ins->lista_devoluciones_opciones1($inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

?>