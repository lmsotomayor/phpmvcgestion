<?php 
	require_once("../Models/venta.php");
	$boton= $_POST['boton'];
	
	if ($boton==='verVendedoresVenta') 
	{
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$inst = new venta();
		$r=$inst->lista_vendedoresVenta($valor1,$valor2);
		//print_r($r);
		echo json_encode($r);
	}

	if ($boton==='verUltimaVenta') 
	{
		$valor=$_POST['valor'];
		$inst = new venta();
		$r=$inst->lista_ultimaVenta($valor);
		echo json_encode($r);
	}

	if ($boton==='verVendedoresSucursal') 
	{
		$sucursal=$_POST['sucursal'];
		$inst = new venta();
		$r=$inst->lista_verVendedoresSucursal($sucursal);
		echo json_encode($r);
	}

	if ($boton==='verCarrito') 
	{
		$valor1=$_POST['valor1'];
		$inst = new venta();
		$r=$inst->lista_carrito($valor1);
		echo json_encode($r);
	}

	if ($boton==='verFormasPago') 
	{
		$valor=$_POST['valor'];
		$inst = new venta();
		$r=$inst->lista_formasDePago($valor);
		echo json_encode($r);
	}

	if ($boton==='insertar_venta') {
		$inst = new venta();
		$venta=$_POST['venta'];
		$sucursal=$_POST['sucursal'];
		$vendedor=$_POST['vendedor'];
		$fecha=$_POST['fecha'];
			
		
		if($inst->insertar_Venta($venta,$sucursal,$vendedor,$fecha)){
			echo 'exito_venta';
		}
		else{
			
		
		}

	}


	if ($boton==='insertar_producto_venta') {
		$inst = new venta();
		$id1=$_POST['id1'];
		$id2=$_POST['id2'];
		$id3=$_POST['id3'];
		$id4=$_POST['id4'];
		$id5=$_POST['id5'];
		$id6=$_POST['id6'];
			
		
		if($inst->insertar_productos_venta($id1,$id2,$id3,$id4,$id5,$id6)){
			echo 'exito_producto_venta';
		}
		else{
			
		
		}

	}

	
	if($boton==='buscar_productos_venta')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor1=$_POST['valor1'];
        $valor2=$_POST['valor2'];
        $check=$_POST['check'];
		$ins=new venta();
		$a= $ins->lista_productos_venta($valor1,$valor2,$check);
		$b=count($a);
		$c= $ins->lista_productos_venta($valor1,$valor2,$check,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}


	if($boton==='buscar_productos_devolucion')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor1=$_POST['valor1'];
        
		$ins=new venta();
		$a= $ins->lista_productos_devolucion($valor1);
		$b=count($a);
		$c= $ins->lista_productos_devolucion($valor1,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if ($boton==='buscarVenta') {

		$valor=$_POST['valor'];
		$inst = new venta();
		if($r=$inst->buscar_Ventas($valor)){

		}else{
			
		}
		
	}

	if ($boton==='ventasDiarias') {

		$valor=$_POST['valor'];
		$fecha1=$_POST['fecha1'];
		$fecha2=$_POST['fecha2'];
		$inst = new venta();
		$r=$inst->buscar_VentasDiarias($valor,$fecha1,$fecha2);
		echo json_encode($r);
		
	}

	if ($boton==='ventasSemanales') {

		$valor=$_POST['valor'];
		$semana=$_POST['semana'];
		$año=$_POST['año'];
		$inst = new venta();
		$r=$inst->buscar_VentasSemanales($valor,$semana,$año);
		echo json_encode($r);
		
	}


	if ($boton==='ventasGenerales') {

		$valor=$_POST['valor'];
		$inst = new venta();
		$r=$inst->buscar_VentasGenerales($valor);
		echo json_encode($r);
		
	}

	if ($boton==='eliminar_producto_carrito') {

		$inst = new venta();
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$valor3=$_POST['valor3'];
		$valor4=$_POST['valor4'];
		
		if($inst->eliminarProductoCarrito($valor1,$valor2,$valor3,$valor4)){
			
		}
		else{
			echo 'No se puedo borrar';
		}
		
	}

	if ($boton==='actualizar_carrito') {
		$inst = new venta();
		$idDetalleVentaCarrito=$_POST['idDetalleVentaCarrito'];
		$idVentaCarrito=$_POST['idVentaCarrito'];
		$idProductoCarrito=$_POST['idProductoCarrito'];
		$cantidadCarritoEditar=$_POST['cantidadCarritoEditar'];
		$precioCarritoEditar=$_POST['precioCarritoEditar'];
		$descuentoCarritoEditar=$_POST['descuentoCarritoEditar'];
		$precioTotalCarritoEditar=$_POST['precioTotalCarritoEditar'];
		$sucursal=$_POST['sucursal'];
		$cantidadCarritoEditarOculto=$_POST['cantidadCarritoEditarOculto'];


		
		if($inst->actualizar_carrito($idDetalleVentaCarrito,$idVentaCarrito,$idProductoCarrito,$cantidadCarritoEditar,$precioCarritoEditar,$descuentoCarritoEditar,$precioTotalCarritoEditar,$sucursal,$cantidadCarritoEditarOculto)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='insertarPagos') {
		$inst = new venta();
		$idFormaPago1=$_POST['idFormaPago1'];
		$idFormaPago2=$_POST['idFormaPago2'];
		$idVenta=$_POST['idVenta'];
		$formaDePago1=$_POST['formaDePago1'];
		$formaDePago2=$_POST['formaDePago2'];
		$cantidadPagos=$_POST['cantidadPagos'];
		
		$inst->insertar_pagos($idFormaPago1,$idFormaPago2,$idVenta,$formaDePago1,$formaDePago2,$cantidadPagos);
			
	}

	if ($boton==='finVenta') {
		$inst = new venta();
		$idVenta=$_POST['idVenta'];
		$idSucursal=$_POST['idSucursal'];
		$idVendedor=$_POST['idVendedor'];
		$idFormaPago=$_POST['idFormaPago'];
		$cantidadTotalVenta=$_POST['cantidadTotalVenta'];
		$subTotalVenta=$_POST['subTotalVenta'];
		$descuentoVenta=$_POST['descuentoVenta'];
		$precioTotalVenta=$_POST['precioTotalVenta'];
		$fechaVenta=$_POST['fechaVenta'];


		
		if($inst->actualizar_venta_final($idVenta,$idSucursal,$idVendedor,$idFormaPago,$cantidadTotalVenta,$subTotalVenta,$descuentoVenta,$precioTotalVenta,$fechaVenta)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if($boton==='lista_VentasDiarias')
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $fecha1=$_POST['fecha1'];
        $fecha2=$_POST['fecha2'];
		$ins=new venta();
		$a= $ins->lista_VentasDiarias($valor,$fecha1,$fecha2);
		$b=count($a);
		$c= $ins->lista_VentasDiarias($valor,$fecha1,$fecha2,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='lista_VentasSemanales')
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $semana=$_POST['semana'];
        $año=$_POST['año'];
		$ins=new venta();
		$a= $ins->lista_VentasSemanales($valor,$semana,$año);
		$b=count($a);
		$c= $ins->lista_VentasSemanales($valor,$semana,$año,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='lista_VentasGenerales')
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $fechaInicio=$_POST['fechaInicio'];
        $fechaFin=$_POST['fechaFin'];
		$ins=new venta();
		$a= $ins->lista_VentasGenerales($valor,$fechaInicio,$fechaFin);
		$b=count($a);
		$c= $ins->lista_VentasGenerales($valor,$fechaInicio,$fechaFin,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='verEditarVentaDiaria')
	{
		
        $valor=$_POST['valor'];
        
		$inst = new venta();
		$r=$inst->buscar_editarVentasDiarias($valor);
		echo json_encode($r);
	}

	if($boton==='buscarVentaAnulacion')
	{
		
        $venta=$_POST['venta'];
        $sucursal=$_POST['sucursal'];
      	$inst = new venta();
		$r=$inst->buscar_ventaAnulacion($venta,$sucursal);
		echo json_encode($r);
	}

	if ($boton==='guardarDevolucion') {
		$inst = new venta();
		$idProductoDevolucion=$_POST['idProductoDevolucion'];
		$selectSucursalOrigenDevolucion=$_POST['selectSucursalOrigenDevolucion'];
		$selectSucursalDestinoDevolucion=$_POST['selectSucursalDestinoDevolucion'];
		$cantidadDevolucion=$_POST['cantidadDevolucion'];
		$motivoDevolucion=$_POST['motivoDevolucion'];
	


		
		if($inst->insertar_devolucion($idProductoDevolucion,$selectSucursalOrigenDevolucion,$selectSucursalDestinoDevolucion,$cantidadDevolucion,$motivoDevolucion)){
			echo 'exito';
		}
		else{
			echo 'No se Actualizo los datos';
		}
	}

	if ($boton==='eliminar_venta_final') {

		$inst = new venta();
		$idVenta=$_POST['idVenta'];
		$sucursal=$_POST['sucursal'];
		$selectVendedorAnular=$_POST['selectVendedorAnular'];
		$motivoAnular=$_POST['motivoAnular'];
		$dd=$_POST['dd'];
		
		if($inst->eliminar_ventaFinal($idVenta,$sucursal,$selectVendedorAnular,$motivoAnular,$dd)){
			
		}
		else{
			echo 'No se puedo borrar';
		}
		
	}


?>