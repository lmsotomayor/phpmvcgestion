<?php 
	class comisiones
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}


		function lista_comisiones_general($valor1,$valor2,$inicio=FALSE,$limite=FALSE){

			

			if ($inicio!==FALSE && $limite!==FALSE) {
				$sql="SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma, t2.idSucursal, t1.idVendedores from vendedores t1 
				inner join sucursal t2 on t1.idSucursal = t2.idSucursal
				inner join venta t3 on t1.idVendedores = t3.idVendedor 
				where  YEAR(t3.fechaVenta) = $valor2 and MONTH(t3.fechaVenta) = $valor1
				group by t1.idVendedores
				order by t1.numeroVendedores DESC
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma,t2.idSucursal, t1.idVendedores from vendedores t1 
				inner join sucursal t2 on t1.idSucursal = t2.idSucursal
				inner join venta t3 on t1.idVendedores = t3.idVendedor 
				where  YEAR(t3.fechaVenta) = $valor2 and MONTH(t3.fechaVenta) = $valor1
				group by t1.nombreVendedores
				order by suma DESC
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


		function porcentajeComisiones(){

					
			$sql="SELECT porcentaje FROM comisionesporcentaje";	

			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}	

		function actualizar_comisiones($porcentaje){
			$sql="UPDATE comisionesporcentaje SET porcentaje= '$porcentaje' ";
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
				
		}

		function lista_ventas_vendedor_comisiones($fecha,$año,$NVendedor,$NSucursal,$inicio=FALSE,$limite=FALSE){

			

			if ($inicio!==FALSE && $limite!==FALSE) {
				$sql="SELECT idVenta, subTotalVenta, fechaVenta from Venta 
				where idSucursal = $NSucursal and idVendedor = $NVendedor and MONTH(fechaVenta) = $fecha
				and YEAR(fechaVenta) = $año
				order by fechaVenta ASC
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT idVenta, subTotalVenta, fechaVenta from Venta 
				where idSucursal = $NSucursal and idVendedor = $NVendedor and MONTH(fechaVenta) = $fecha
				and YEAR(fechaVenta) = $año
				order by fechaVenta ASC
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

		function lista_ventas_vendedor_comisiones2($fechaDesdeComision,$fechaHastaComision,$NVendedor,$NSucursal,$inicio=FALSE,$limite=FALSE){

			

			if ($inicio!==FALSE && $limite!==FALSE) {
				$sql="SELECT idVenta, subTotalVenta, fechaVenta from Venta 
				where idSucursal = $NSucursal and idVendedor = $NVendedor and fechaVenta >= '$fechaDesdeComision' 
				and fechaVenta <= '$fechaHastaComision' 
				order by fechaVenta ASC
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT idVenta, subTotalVenta, fechaVenta from Venta 
				where idSucursal = $NSucursal and idVendedor = $NVendedor and fechaVenta >= '$fechaDesdeComision' 
				and fechaVenta <= '$fechaHastaComision' 
				order by fechaVenta ASC
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



		function lista_comisiones_por_fecha($vendedor,$fechaDesdeComision,$fechaHastaComision,$pagina,$inicio=FALSE,$limite=FALSE){

			if($vendedor==0){
								if ($inicio!==FALSE && $limite!==FALSE) {
								$sql="SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma, t2.idSucursal, t1.idVendedores from vendedores t1 
								inner join sucursal t2 on t1.idSucursal = t2.idSucursal
								inner join venta t3 on t1.idVendedores = t3.idVendedor 
								WHERE t3.fechaVenta >= '$fechaDesdeComision' 
								and t3.fechaVenta <= '$fechaHastaComision'  and t3.idVendedor > '$vendedor'
								group by t1.idVendedores
								order by t1.numeroVendedores DESC
							LIMIT $inicio,$limite ";
							}
							else{
							$sql="SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma,t2.idSucursal, t1.idVendedores from vendedores t1 
								inner join sucursal t2 on t1.idSucursal = t2.idSucursal
								inner join venta t3 on t1.idVendedores = t3.idVendedor 
								WHERE t3.fechaVenta >= '$fechaDesdeComision' 
								and t3.fechaVenta <= '$fechaHastaComision'  and t3.idVendedor > '$vendedor'
								group by t1.idVendedores
								order by t1.numeroVendedores DESC
							 ";	

							}
			}else{

			if ($inicio!==FALSE && $limite!==FALSE){
				$sql="SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma, t2.idSucursal, t1.idVendedores from vendedores t1 
				inner join sucursal t2 on t1.idSucursal = t2.idSucursal
				inner join venta t3 on t1.idVendedores = t3.idVendedor 
				WHERE t3.fechaVenta >= '$fechaDesdeComision' 
				and t3.fechaVenta <= '$fechaHastaComision'  and t3.idVendedor = '$vendedor'
				group by t1.idVendedores
				order by t1.numeroVendedores DESC
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma,t2.idSucursal, t1.idVendedores from vendedores t1 
				inner join sucursal t2 on t1.idSucursal = t2.idSucursal
				inner join venta t3 on t1.idVendedores = t3.idVendedor 
				WHERE t3.fechaVenta >= '$fechaDesdeComision' 
				and t3.fechaVenta <= '$fechaHastaComision'  and t3.idVendedor = '$vendedor'
				group by t1.idVendedores
				order by t1.numeroVendedores DESC
			 ";	

			}
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

		

}

?>