<?php 
	require_once("../Models/stock.php");
	$boton= $_POST['boton'];

	if ($boton==='verStockGeneral') 
	{
		$inst = new stock();
		$r=$inst ->verInventario();
		echo json_encode($r);

	}

	if ($boton==='verStockConsulta') 
	{
		$valor=$_POST['valor'];
		$inst = new stock();
		$r=$inst ->verStockConsulta($valor);
		echo json_encode($r);

	}


	if ($boton==='verStockTotalCaracteristicasBuscar') 
	{
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$valor3=$_POST['valor3'];
		$valor4=$_POST['valor4'];
		$valor5=$_POST['valor5'];
		$inst = new stock();
		$r=$inst ->verInventario2($valor1,$valor2,$valor3,$valor4,$valor5);
		echo json_encode($r);

	}

	if ($boton==='verStock') 
	{
		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $inst = new stock();
		$a= $inst->lista_productosStock($valor);
		$b=count($a);
		$c= $inst->lista_productosStock($valor,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}


	if ($boton==='verStockCarga') 
	{

		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new stock();
		$a=$inst ->lista_productosStockCarga($valor);
		$b=count($a);
		$c= $inst->lista_productosStockCarga($valor,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if ($boton==='insertar_stock') {
		$inst = new stock();
		$idProducto=$_POST['idProductoStock'];
		$idSucursal=$_POST['selectSucursal'];
		$stockProducto=$_POST['stockProducto'];
		$stockMinimo=$_POST['stockMinimo'];
		$fechaActual=$_POST['fechaActual'];
	
		if($inst->insertar_stock($idProducto,$idSucursal,$stockProducto,$stockMinimo,$fechaActual)){
			echo 'Stock Guardado';
		}
		else{
			
			echo 'El producto ya tiene stock, haga click en el boton de actualizar';
		}

	}


	if ($boton==='actualizar_stock') {
		$inst = new stock();
		$idSucursalActualizar=$_POST['idSucursalActualizar'];
		$idProductoActualizar=$_POST['idProductoActualizar'];
		$stockActual=$_POST['stockActual'];
		$stockMinimoActual=$_POST['stockMinimoActual'];
		$nuevoStock=$_POST['nuevoStock'];
		$nuevoStockMinimo=$_POST['nuevoStockMinimo'];
		$fechaActual=$_POST['fechaActual'];
		
		
		
		if($inst->actualizar_stock($idSucursalActualizar,$idProductoActualizar,$stockActual,$stockMinimoActual,$nuevoStock,$nuevoStockMinimo,$fechaActual)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='borrar_stock') {
		$inst = new stock();
		
		if($inst->borrar_stock()){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='ordenar_stock_general') {
		$inst = new stock();
		
		if($inst->ordenar_stock_general()){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}








?>