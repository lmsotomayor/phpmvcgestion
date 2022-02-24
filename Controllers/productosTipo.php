<?php 
	require_once("../Models/productosTipo.php");
	$boton= $_POST['boton'];
	if($boton==='buscar')
	{
		$valor=$_POST['valor'];
		$inst = new productosTipo();
		$r=$inst ->lista_productos_tipo($valor);
		
		echo json_encode($r);
		
	}
	if ($boton==='actualizar') {
		$inst = new categoria_productos();
		$idcattipo=$_POST['idcattipo'];
		$categoria=$_POST['categoria'];
		$subcategoria=$_POST['subcategoria'];
		
		if($inst->actualizar($idcattipo,$categoria,$subcategoria)){
			echo 'exito3';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}
		if($boton==='eliminar')
	{
		$idcat=$_POST['idcat'];

		$inst = new categoria_productos();
		if($inst->eliminar($idcat)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}
	
?>