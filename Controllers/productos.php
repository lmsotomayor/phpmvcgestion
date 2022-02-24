<?php 
	require_once("../Models/productos.php");
	$boton= $_POST['boton'];

	

	if($boton==='buscar')
	{
		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
        $inst = new productos();
		$a= $inst->lista_productos($valor);
		$b=count($a);
		$c= $inst->lista_productos($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_telas')
	{
		$inicio = 0;
        $limite = 6;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new productos();
		$a= $inst->lista_telas($valor);
		$b=count($a);
		$c= $inst->lista_telas($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}


	if($boton==='buscar_telas_relaciones')
	{
		$inst = new productos();
		$r=$inst ->lista_telas_relaciones();
		echo json_encode($r);
	}

	if($boton==='buscar_talles')
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new productos();
		$a=$inst ->lista_talles($valor);
		$b=count($a);
		$c= $inst->lista_talles($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_talles_relaciones')
	{
		$inicio = 0;
        $limite = 8;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$inst = new productos();
		$a=$inst ->lista_talles_relaciones();
		$b=count($a);
		$c= $inst->lista_talles_relaciones($inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_color')
	{
		$inicio = 0;
        $limite = 8;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new productos();
		$a=$inst ->lista_color($valor);
		$b=count($a);
		$c= $inst->lista_color($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_color_relaciones')
	{
		$inicio = 0;
        $limite = 8;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$inst = new productos();
		$a=$inst ->lista_color_relaciones();
		$b=count($a);
		$c= $inst->lista_color_relaciones($inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_modelo')
	{
		$inicio = 0;
        $limite = 8;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new productos();
		$a=$inst->lista_modelos($valor);
		$b=count($a);
		$c= $inst->lista_modelos($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
		
	}

	if($boton==='buscar_modelo_relaciones')
	{
		$inicio = 0;
        $limite = 11;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$inst = new productos();
		$a= $inst->lista_modelos_relaciones();
		$b=count($a);
		$c= $inst->lista_modelos_relaciones($inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_marca')
	{
		$inicio = 0;
        $limite = 8;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor=$_POST['valor'];
		$inst = new productos();
		$a=$inst ->lista_marcas($valor);
		$b=count($a);
		$c= $inst->lista_marcas($valor,$inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	if($boton==='buscar_marca_relaciones')
	{
		$inicio = 0;
        $limite = 11;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$inst = new productos();
		$a= $inst->lista_marcas_relaciones();
		$b=count($a);
		$c= $inst->lista_marcas_relaciones($inicio,$limite);
		echo json_encode($c)."*".$b;
	}

	//viene de busqueda_producto.php
	if($boton==='buscar_productos_stock')
	{
		$inicio = 0;
        $limite = 12;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor=$_POST['valor'];
		$ins=new productos();
		$a= $ins->lista_productos_stock($valor);
		$b=count($a);
		$c= $ins->lista_productos_stock($valor,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	//esta funcion es para buscar por los select
	if($boton==='buscar_productos_stock_caracteristicas')
	{
		$inicio = 0;
        $limite = 12;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
		$valor1=$_POST['valor1'];
		$valor2=$_POST['valor2'];
		$valor3=$_POST['valor3'];
		$valor4=$_POST['valor4'];
		$valor5=$_POST['valor5'];
		$inst = new productos();
		$a=$inst->lista_productos_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5);
		$b=count($a);
		$c= $inst->lista_productos_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	//función para mostrar en busqueda_productos-php tab1, al hacer clic en en boton de busqueda mostrar stock de sucursales
	if($boton==='buscar_productos_stock_sucursales_1')
	{
		$valor=$_POST['valor'];
		$inst = new productos();
		$r=$inst ->lista_productos_stock_sucursales_1($valor);
		//print_r($r);
		echo json_encode($r);


	}	

	if ($boton==='insertar_tela') {
		$inst = new productos();
		$idTelaProducto=$_POST['idTelaProducto'];
		$nombreTelaProducto=$_POST['nombreTelaProducto'];
		$descripcionTelaProducto=$_POST['descripcionTelaProducto'];
			
		
		
		if($inst->insertar_tela($idTelaProducto,$nombreTelaProducto,$descripcionTelaProducto)){
			echo 'exito';
		}
		else{
			echo 'No se puedo guardar la tela';
		
		}

	}


	if ($boton==='insertar_talle') {
		$inst = new productos();
		$idTalleProducto=$_POST['idTalleProducto'];
		$nombreTalleProducto=$_POST['nombreTalleProducto'];
		
		if($inst->insertar_talle($idTalleProducto,$nombreTalleProducto)){
			echo 'exito';
		}
		else{
			echo 'No se puedo guardar el talle';
		
		}

	}

	if ($boton==='insertar_color') {
		$inst = new productos();
		$idColorProducto=$_POST['idColorProducto'];
		$nombreColorProducto=$_POST['nombreColorProducto'];
		
		if($inst->insertar_color($idColorProducto,$nombreColorProducto)){
			echo 'exito';
		}
		else{
			echo 'No se puedo guardar el color';
		
		}

	}

	if ($boton==='insertar_modelo') {
		$inst = new productos();
		$idModeloProducto=$_POST['idModeloProducto'];
		$nombreModeloProducto=$_POST['nombreModeloProducto'];
		$descripcionModeloProducto=$_POST['descripcionModeloProducto'];
		
		if($inst->insertar_modelo($idModeloProducto,$nombreModeloProducto,$descripcionModeloProducto)){
			echo 'exito';
		}
		else{
			echo 'No se puedo guardar el modelo';
		
		}

	}

	if ($boton==='insertar_marca') {
		$inst = new productos();
		$idMarcaProducto=$_POST['idMarcaProducto'];
		$nombreMarcaProducto=$_POST['nombreMarcaProducto'];
		$descripcionMarcaProducto=$_POST['descripcionMarcaProducto'];
		
		if($inst->insertar_marca($idMarcaProducto,$nombreMarcaProducto,$descripcionMarcaProducto)){
			echo 'exito';
		}
		else{
			echo 'No se puedo guardar el modelo';
		
		}

	}

		if ($boton==='insertar_producto') {
		$inst = new productos();
		$idProducto=$_POST['idProducto'];
		$descripcionProducto=$_POST['descripcionProducto'];
		$idModeloProducto1=$_POST['idModeloProducto1'];
		$idMarcaProducto1=$_POST['idMarcaProducto1'];
		$idTelaProducto1=$_POST['idTelaProducto1'];
		$idTalleProducto1=$_POST['idTalleProducto1'];
		$idColorProducto1=$_POST['idColorProducto1'];
		$precioCosto=$_POST['precioCosto'];
		$precioVenta=$_POST['precioVenta'];
		$codigoBarras=$_POST['codigoBarras'];
		$observaciones=$_POST['observaciones'];
		
		
		if($inst->insertar_producto($idProducto,$descripcionProducto,$idModeloProducto1,$idMarcaProducto1,$idTelaProducto1,
			$idTalleProducto1,$idColorProducto1,$precioCosto,$precioVenta,$codigoBarras,$observaciones)){
			echo 'exito';
		}
		else{
			echo 'No se puede guardar el producto';
		
		}

	}

	if ($boton==='actualizar_producto') {
		$inst = new productos();
		$idProducto=$_POST['idProducto'];
		$descripcionProducto=$_POST['descripcionProducto'];
		$idModeloProducto1=$_POST['idModeloProducto1'];
		$idMarcaProducto1=$_POST['idMarcaProducto1'];
		$idTelaProducto1=$_POST['idTelaProducto1'];
		$idTalleProducto1=$_POST['idTalleProducto1'];
		$idColorProducto1=$_POST['idColorProducto1'];
		$precioCosto=$_POST['precioCosto'];
		$precioVenta=$_POST['precioVenta'];
		$codigoBarras=$_POST['codigoBarras'];
		$observaciones=$_POST['observaciones'];
		
		if($inst->actualizar_producto($idProducto,$descripcionProducto,$idModeloProducto1,$idMarcaProducto1,$idTelaProducto1,
			$idTalleProducto1,$idColorProducto1,$precioCosto,$precioVenta,$codigoBarras,$observaciones)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='actualizar_tela') {
		$inst = new productos();
		$idTelaProducto=$_POST['idTelaProducto'];
		$nombreTelaProducto=$_POST['nombreTelaProducto'];
		$descripcionTelaProducto=$_POST['descripcionTelaProducto'];
		
		if($inst->actualizar_tela($idTelaProducto,$nombreTelaProducto,$descripcionTelaProducto)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}



	if ($boton==='actualizar_talle') {
		$inst = new productos();
		$idTelaProducto=$_POST['idTalleProducto'];
		$nombreTalleProducto=$_POST['nombreTalleProducto'];
		
		if($inst->actualizar_talle($idTelaProducto,$nombreTalleProducto)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='actualizar_color') {
		$inst = new productos();
		$idColorProducto=$_POST['idColorProducto'];
		$nombreColorProducto=$_POST['nombreColorProducto'];
		
		if($inst->actualizar_color($idColorProducto,$nombreColorProducto)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}


	if ($boton==='actualizar_modelo') {
		$inst = new productos();
		$idModeloProducto=$_POST['idModeloProducto'];
		$nombreModeloProducto=$_POST['nombreModeloProducto'];
		$descripcionModeloProducto=$_POST['descripcionModeloProducto'];
		

		if($inst->actualizar_modelo($idModeloProducto,$nombreModeloProducto,$descripcionModeloProducto)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if ($boton==='actualizar_marca') {
		$inst = new productos();
		$idMarcaProducto=$_POST['idMarcaProducto'];
		$nombreMarcaProducto=$_POST['nombreMarcaProducto'];
		$descripcionMarcaProducto=$_POST['descripcionMarcaProducto'];
		

		if($inst->actualizar_marca($idMarcaProducto,$nombreMarcaProducto,$descripcionMarcaProducto)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}
		
	if($boton==='eliminar_tela')
	{
		$idTelaProducto=$_POST['idTelaProducto'];
		$inst = new productos();
		if($inst->eliminar_tela($idTelaProducto)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if($boton==='eliminar_talle')
	{
		$idTalleProducto=$_POST['idTalleProducto'];
		$inst = new productos();
		if($inst->eliminar_talle($idTalleProducto)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if($boton==='eliminar_color')
	{
		$idColorProducto=$_POST['idColorProducto'];
		$inst = new productos();
		if($inst->eliminar_color($idColorProducto)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}



	if($boton==='eliminar_modelo')
	{
		$idModeloProducto=$_POST['idModeloProducto'];
		$inst = new productos();
		if($inst->eliminar_modelo($idModeloProducto)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if($boton==='eliminar_marca')
	{
		$idMarcaProducto=$_POST['idMarcaProducto'];
		$inst = new productos();
		if($inst->eliminar_marca($idMarcaProducto)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if($boton==='eliminar_producto')
	{
		$idProducto=$_POST['idProducto'];
		$inst = new productos();
		if($inst->eliminar_producto($idProducto)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	//prueba para no borrar archivos que esten afectados por el producto
	if($boton==='eliminar_color_confirma')
	{
		$idColorProducto=$_POST['idColorProducto'];
		$inst = new productos();
		if($inst->eliminar_color_confirma($idColorProducto)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	//prueba para no borrar archivos que esten afectados por el modelo
	if($boton==='eliminar_modelo_confirma')
	{
		$idModeloProducto=$_POST['idModeloProducto'];
		$inst = new productos();
		if($inst->eliminar_modelo_confirma($idModeloProducto)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	if($boton==='eliminar_marca_confirma')
	{
		$idMarcaProducto=$_POST['idMarcaProducto'];
		$inst = new productos();
		if($inst->eliminar_marca_confirma($idMarcaProducto)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	if($boton==='eliminar_tela_confirma')
	{
		$idTelaProducto=$_POST['idTelaProducto'];
		$inst = new productos();
		if($inst->eliminar_tela_confirma($idTelaProducto)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	if($boton==='eliminar_talle_confirma')
	{
		$idTalleProducto=$_POST['idTalleProducto'];
		$inst = new productos();
		if($inst->eliminar_talle_confirma($idTalleProducto)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}

	if($boton==='eliminar_producto_confirma')
	{
		$idProducto=$_POST['idProducto'];
		$inst = new productos();
		if($inst->eliminar_producto_confirma($idProducto)){
			echo 'SI';
		}
		else{
			echo 'NO';
		}
	}



	
?>