<?php 
	require_once("../Models/consultas.php");
	$boton= $_POST['boton'];


	if($boton==='lista_devoluciones_general')
	{
		$inicio = 0;
        $limite = 7;
        if (isset($_POST['pagina'])) {
        	$pagina=$_POST['pagina'];
            $inicio = ($pagina - 1) * $limite;
        }
        $valor1=$_POST['valor1'];
      
		$ins=new consultas();
		$a= $ins->lista_devoluciones_general($valor1);
		$b=count($a);
		$c= $ins->lista_devoluciones_general($valor1,$inicio,$limite);
		
		echo json_encode($c)."*".$b;
	}

	if ($boton==='verMasDevueltos') 
	{
		
		$inst = new consultas();
		$r=$inst->lista_masVendidos();
		echo json_encode($r);
	}


?>