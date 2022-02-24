<?php 
	require_once("../Models/creditos.php");
	$boton= $_POST['boton'];

	if ($boton==='insertar_creditos') {
		$inst = new creditos();
		$nombreApellidoCredito=$_POST['nombreApellidoCredito'];
		$dniCredito=$_POST['dniCredito'];
		$selectVendedorCredito=$_POST['selectVendedorCredito'];
		$montoCredito=$_POST['montoCredito'];
		$fechaCredito=$_POST['fechaCredito'];
		$motivoCredito=$_POST['motivoCredito'];
		$selectEstadoCredito=$_POST['selectEstadoCredito'];
		
		if($inst->insertar_credito($nombreApellidoCredito,$dniCredito,$selectVendedorCredito,$montoCredito,$fechaCredito,$motivoCredito,$selectEstadoCredito)){
			echo 'Crédito Guardado';
		}
		else{
			echo 'No se puedo guardar el crédito';
		
		}

	}

	if($boton==='lista_creditos_por_dni')
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $dniCredito=$_POST['dniCredito'];
              
		$ins=new creditos();
		$a= $ins->lista_creditos_por_dni2($dniCredito);
		$b=count($a);
		$c= $ins->lista_creditos_por_dni2($dniCredito,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='eliminar_credito')
	{
		$idNotaDeCredito=$_POST['idNotaDeCredito'];
		$inst = new creditos();
		if($inst->eliminar_credito_ok($idNotaDeCredito)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}


	if($boton==='eliminar_credito_persona')
	{
		$id=$_POST['id'];
		$dato=$_POST['dato'];
		$valor=$_POST['valor'];

		$inst = new creditos();
		if($inst->eliminar_credito_persona_ok($id,$dato,$valor)){
			echo 'Se elimino correctamente';
		}
		else{
			echo "No se eliminar los datos";
		}
	}

	if ($boton==='actualizar_credito_detalle_activo') {
		$inst = new creditos();
		$idNotaDeCredito=$_POST['idNotaDeCredito'];
		$valorFinal=$_POST['valorFinal'];
		$montoAUsarCredito=$_POST['montoAUsarCredito'];
		$fechaActual=$_POST['fechaActual'];
		
		
		if($inst->actualizar_credito_detalle_dni_activo($idNotaDeCredito,$valorFinal,$montoAUsarCredito,$fechaActual)){
			echo 'exito';
		}
		else{
			echo "";
		}
	}

	if ($boton==='actualizar_credito_detalle_inactivo') {
		$inst = new creditos();
		$idNotaDeCredito=$_POST['idNotaDeCredito'];
		$valorFinal=$_POST['valorFinal'];
		$estadoCreditoDetalle=$_POST['estadoCreditoDetalle'];
		$montoAUsarCredito=$_POST['montoAUsarCredito'];
		$fechaActual=$_POST['fechaActual'];
		
		if($inst->actualizar_credito_detalle_dni_inactivo($idNotaDeCredito,$valorFinal,$estadoCreditoDetalle,$montoAUsarCredito,$fechaActual)){
			echo 'exito';
		}
		else{
			echo "";
		}
	}

	if($boton==='lista_creditos_historial_dni')
	{
		
        $dato=$_POST['dato'];
              
		$inst = new creditos();
		$r=$inst->lista_masVendidos($dato);

		echo json_encode($r);

	}

	if($boton==='monto_total_credito')
	{
		
        $dato=$_POST['dato'];
              
		$inst = new creditos();
		$r=$inst->totalUsadoCredito($dato);

		echo json_encode($r);
		
	}


	if ($boton==='actualizar_estado_credito') {
		$inst = new creditos();
		$idCredito=$_POST['idCredito'];
		$estadoCredito=$_POST['estadoCredito'];
		
		
		if($inst->actualizar_estado_credito_ok($idCredito,$estadoCredito)){
			echo 'exito';
		}
		else{
			echo "Error";
		}
	}

?>