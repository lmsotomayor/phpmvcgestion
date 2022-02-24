<?php 
	class creditos
{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
			
		}

		function insertar_credito($nombreApellidoCredito,$dniCredito,$selectVendedorCredito,$montoCredito,$fechaCredito,$motivoCredito,$selectEstadoCredito)
		{
			
			$sql="INSERT INTO notadecredito (NyA,dniCredito,vendedorCredito,montoCredito,
				fechaCredito,motivoCredito,estadoCredito,montoOriginalCredito) 
				VALUES('$nombreApellidoCredito','$dniCredito','$selectVendedorCredito','$montoCredito',
					'$fechaCredito','$motivoCredito','$selectEstadoCredito','$montoCredito') ";
			

				if($this->conexion->conexion->query($sql)){
				return true;
			}
			else
			{
				return false;
			}

			

			$this->conexion->cerrar();

			
			
		}

		function lista_creditos_por_dni2($dniCredito,$inicio=FALSE,$limite=FALSE){

			

			if ($inicio!==FALSE && $limite!==FALSE) {
				$sql="SELECT t1.*, t2.nombreVendedores FROM notadecredito t1 inner join vendedores t2
					on t1.vendedorCredito = t2.idVendedores where t1.dniCredito like '%".$dniCredito."%'
					order by t1.fechaCredito DESC
			LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.*, t2.nombreVendedores FROM notadecredito t1 inner join vendedores t2
					on t1.vendedorCredito = t2.idVendedores where t1.dniCredito like '%".$dniCredito."%'
				order by t1.fechaCredito DESC
			 ";	

			}
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}	

		function eliminar_credito_ok($idNotaDeCredito){
			$sql="DELETE FROM notadecredito WHERE idNotaDeCredito='$idNotaDeCredito'";
			if($this->conexion->conexion->query($sql)){

				$sql="DELETE FROM detallecredito WHERE idNotaDeCredito='$idNotaDeCredito'";

				$this->conexion->conexion->query($sql);

				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}

		function eliminar_credito_persona_ok($id,$dato,$valor){
		
				$sql="DELETE FROM detallecredito WHERE idDetalleCredito='$id'";

				if($this->conexion->conexion->query($sql)){


				

				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	

				//traigo el valor del credito para sumarle o descontarle el monto del borrado
				$sql="SELECT montoCredito FROM notadecredito where idNotaDeCredito = '$dato'";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);

				//traigo el valor del credito 	
				$montoCreditoTotal=$rows[0];
				//traigo el estado del credito
				
				$totalNuevoCredito = $montoCreditoTotal + $valor;

				

				$sql="UPDATE notadecredito SET montoCredito = '$totalNuevoCredito',estadoCredito = 'Activo' WHERE idNotaDeCredito = '$dato' ";
			    $this->conexion->conexion->query($sql); 
			
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}
		
		function actualizar_credito_detalle_dni_activo($idNotaDeCredito,$valorFinal,$montoAUsarCredito,$fechaActual){

		$sql="UPDATE notadecredito SET montoCredito = '$valorFinal' WHERE idNotaDeCredito = '$idNotaDeCredito'";

		if($this->conexion->conexion->query($sql)){

				//inserto en una tabla el historial del credito de este cliente
				$sql="INSERT INTO detallecredito (idNotaDeCredito,montoUsadoCredito,fechaUsoCredito) 
				VALUES('$idNotaDeCredito','$montoAUsarCredito','$fechaActual') ";
		
				$this->conexion->conexion->query($sql);


				return true;
			}
			else{
				return false;
			}
		

		
			$this->conexion->cerrar();
			}
			
		function actualizar_credito_detalle_dni_inactivo($idNotaDeCredito,$valorFinal,$estadoCreditoDetalle,$montoAUsarCredito,$fechaActual){
			$sql="UPDATE notadecredito SET montoCredito = '$valorFinal', estadoCredito= '$estadoCreditoDetalle' WHERE idNotaDeCredito = '$idNotaDeCredito'";
			if($this->conexion->conexion->query($sql)){

				//inserto en una tabla el historial del credito de este cliente
				$sql="INSERT INTO detallecredito (idNotaDeCredito,montoUsadoCredito,fechaUsoCredito) 
				VALUES('$idNotaDeCredito','$montoAUsarCredito','$fechaActual') ";
		
				$this->conexion->conexion->query($sql);
				return true;
			}
			else{
				return false;
			}

			$this->conexion->cerrar();
			}	

			function lista_masVendidos($dato){

			
			$sql="SELECT * FROM detallecredito WHERE idNotaDeCredito = '$dato' 
			
			order by fechaUsoCredito ASC ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}	

		function totalUsadoCredito($dato){
			$sql="SELECT IFNULL(sum(montoUsadoCredito),'0.00') FROM detallecredito WHERE idNotaDeCredito = '$dato' 
			LIMIT 1
			 ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();
		}

		function actualizar_estado_credito_ok($idCredito,$estadoCredito){
			$sql="UPDATE notadecredito SET estadoCredito = '$estadoCredito' WHERE idNotaDeCredito = '$idCredito'";
			if($this->conexion->conexion->query($sql)){

				return true;
			}
			else{
				return false;
			}

			$this->conexion->cerrar();
			}	

			
}

?>