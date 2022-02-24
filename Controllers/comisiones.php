<?php 
	require_once("../Models/comisiones.php");
	$boton= $_POST['boton'];


	if($boton==='lista_comisiones_general')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor1=$_POST['valor1'];
        $valor2=$_POST['valor2'];
      
		$ins=new comisiones();
		$a= $ins->lista_comisiones_general($valor1,$valor2);
		$b=count($a);
		$c= $ins->lista_comisiones_general($valor1,$valor2,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if ($boton==='verPorcentaje') 
	{
		
		$inst = new comisiones();
		$r=$inst->porcentajeComisiones();
		echo json_encode($r);
	}

	if ($boton==='actualizar_comisiones') {
		$inst = new comisiones();
		$porcentaje=$_POST['porcentaje'];
		if($inst->actualizar_comisiones($porcentaje)){
			echo 'exito';
		}
		else{
			echo "No se Actualizo los datos";
		}
	}

	if($boton==='lista_ventas_vendedor_comisiones')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $NVendedor=$_POST['NVendedor'];
    	$NSucursal=$_POST['NSucursal'];
    	$fecha=$_POST['fecha'];
    	$año=$_POST['año'];
      

		$ins=new comisiones();
		$a= $ins->lista_ventas_vendedor_comisiones($fecha,$año,$NVendedor,$NSucursal);
		$b=count($a);
		$c= $ins->lista_ventas_vendedor_comisiones($fecha,$año,$NVendedor,$NSucursal,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='lista_ventas_vendedor_comisiones2')
	{
		$inicio = 0;
        $limite = 5;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $NVendedor=$_POST['NVendedor'];
    	$NSucursal=$_POST['NSucursal'];
    	$fechaDesdeComision=$_POST['fechaDesdeComision'];
    	$fechaHastaComision=$_POST['fechaHastaComision'];
      

		$ins=new comisiones();
		$a= $ins->lista_ventas_vendedor_comisiones2($fechaDesdeComision,$fechaHastaComision,$NVendedor,$NSucursal);
		$b=count($a);
		$c= $ins->lista_ventas_vendedor_comisiones2($fechaDesdeComision,$fechaHastaComision,$NVendedor,$NSucursal,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if($boton==='lista_comisiones_por_fecha')
	{
		$inicio = 0;
        $limite = 10;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $vendedor=$_POST['vendedor'];
        $fechaDesdeComision=$_POST['fechaDesdeComision'];
        $fechaHastaComision=$_POST['fechaHastaComision'];
        $pagina=$_POST['pagina'];
      
      
		$ins=new comisiones();
		$a= $ins->lista_comisiones_por_fecha($vendedor,$fechaDesdeComision,$fechaHastaComision,$pagina);
		$b=count($a);
		$c= $ins->lista_comisiones_por_fecha($vendedor,$fechaDesdeComision,$fechaHastaComision,$pagina,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}


?>