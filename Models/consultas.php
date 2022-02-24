<?php 
	class consultas
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}


		function lista_devoluciones_general($valor1,$inicio=FALSE,$limite=FALSE){

			

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.cantidadDevolucion, t1.fechaDevolucion, t1.motivoDevolucion, t2.descripcionProducto,
			t3.nombreSucursal, t4.nombreSucursal FROM devoluciones t1
			INNER JOIN productos t2 
			ON t1.idProducto = t2.idProducto
			INNER JOIN sucursal t3
			ON t1.idSucursalOrigen = t3.idSucursal 
			INNER JOIN sucursal t4
			ON t1.idSucursalDestino = t4.idSucursal 
			WHERE t2.descripcionProducto like '%".$valor1."%' or t2.codigoBarras like '%".$valor1."%'
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.cantidadDevolucion, t1.fechaDevolucion, t1.motivoDevolucion, t2.descripcionProducto,
			t3.nombreSucursal, t4.nombreSucursal FROM devoluciones t1
			INNER JOIN productos t2 
			ON t1.idProducto = t2.idProducto
			INNER JOIN sucursal t3
			ON t1.idSucursalOrigen = t3.idSucursal 
			INNER JOIN sucursal t4
			ON t1.idSucursalDestino = t4.idSucursal  
			WHERE t2.descripcionProducto like '%".$valor1."%' or t2.codigoBarras like '%".$valor1."%'
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


		function lista_masVendidos(){

					
			$sql="SELECT count(t1.idProducto) as cantidad,  t2.descripcionProducto
			FROM devoluciones t1
			INNER JOIN productos t2 
			ON t1.idProducto = t2.idProducto			
            group by t1.idProducto
            order by cantidad desc
            limit 10
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

}

?>