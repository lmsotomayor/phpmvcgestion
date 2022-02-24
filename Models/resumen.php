<?php 
	class resumen
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}


	//con estas tres funciones lleno los campos de cantidad de ventas en historial de ventas en venta	
	function buscar_VentasDiariasResumen($fecha1,$fecha2){

		$sql="SELECT COUNT(*) FROM venta WHERE fechaVenta >= '$fecha1' 
		and fechaVenta <= '$fecha2'  and idFormaPago > 0 " ;	

		$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}

	function buscar_VentasTotalResumen(){

		$sql="SELECT COUNT(*) FROM venta WHERE idFormaPago > 0 "  ;	

		$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}

	function buscar_VentasTotalResumenProductos($valor1){

		$sql="SELECT t1.idVenta, t2.idVenta, count(t1.idVenta) FROM venta t1
				INNER JOIN detalleventa t2
				ON t1.idVenta = t2.idVenta
				WHERE t2.idProducto = $valor1 "; 	

		$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}

	function buscar_devolucionesTotalResumenProductos($valor1){

		$sql="SELECT t1.idProducto, count(t2.idProducto) FROM devoluciones t1
				INNER JOIN productos t2 ON
				t1.idProducto = t2.idProducto
				WHERE t1.idProducto = $valor1 "; 	

		$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}



	function lista_VentasDiariasResumen1($fecha1,$fecha2,$sucursalVentas,$inicio=FALSE,$limite=FALSE){


		if($sucursalVentas == 0){
					if ($inicio!==FALSE && $limite!==FALSE) {
					$sql="SELECT t1.*,  IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No existe'), IFNULL(t4.nombreSucursal,'No existe') FROM venta t1
					LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
					LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
		            LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
					WHERE t1.fechaVenta >= '$fecha1' 
					and t1.fechaVenta <= '$fecha2'  
					ORDER BY t1.fechaVenta ASC
					LIMIT $inicio,$limite ";
					}
					else{
					$sql="SELECT t1.*,  IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No existe'), IFNULL(t4.nombreSucursal,'No existe') FROM venta t1
					LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
					LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
		            LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
					WHERE t1.fechaVenta >= '$fecha1' 
					and t1.fechaVenta <= '$fecha2' 
					ORDER BY t1.fechaVenta ASC
					 ";	
					}
		}else{

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*,  IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No existe'), IFNULL(t4.nombreSucursal,'No existe') FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
            LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
			
			WHERE t1.fechaVenta >= '$fecha1' 
			and t1.fechaVenta <= '$fecha2'  and t1.idSucursal = '$sucursalVentas'
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*,  IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No existe'), IFNULL(t4.nombreSucursal,'No existe') FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
            LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
			WHERE t1.fechaVenta >= '$fecha1' 
			and t1.fechaVenta <= '$fecha2'  and t1.idSucursal = '$sucursalVentas'
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

	function lista_VentasProductosResumen($valor1,$inicio=FALSE,$limite=FALSE){


			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,'') FROM productos t1 
			LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto 
			LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto 
			LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto 
			LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto 

			WHERE t1.descripcionProducto like '%".$valor1."%' or t1.codigoBarras like '%".$valor1."%' ORDER BY t1.descripcionProducto LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,'') FROM productos t1 
			LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto 
			LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto 
			LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto 
			LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto 

			WHERE t1.descripcionProducto like '%".$valor1."%' or t1.codigoBarras like '%".$valor1."%' ORDER BY t1.descripcionProducto  ";

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


	function lista_detalleVentaResumenxProducto($valor1,$inicio=FALSE,$limite=FALSE){


			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*,  IFNULL(t2.nombreVendedores,'No Existe'),  IFNULL(t3.descripcionPago,'No existe'), IFNULL(t4.nombreSucursal,'No existe'),  t5.idVenta, t5.cantidadVenta, t5.precioUnitario, t5.precioTotal FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
            LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
            LEFT JOIN detalleventa t5 ON t1.idVenta = t5.idVenta
			WHERE t5.idProducto = $valor1
			having(t1.idVendedor)>0
			order by t1.fechaVenta DESC
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*,  IFNULL(t2.nombreVendedores,'No Existe'),  IFNULL(t3.descripcionPago,'No existe'), IFNULL(t4.nombreSucursal,'No existe'),  t5.idVenta, t5.cantidadVenta, t5.precioUnitario, t5.precioTotal FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
            LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
            LEFT JOIN detalleventa t5 ON t1.idVenta = t5.idVenta
			WHERE t5.idProducto = $valor1
			having(t1.idVendedor)>0
			order by t1.fechaVenta DESC
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

}

?>