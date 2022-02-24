<?php 
	class venta
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}

	function lista_vendedoresVenta($valor1,$valor2){

			
			$sql="SELECT * FROM vendedores WHERE numeroVendedores = $valor1 and idSucursal = $valor2";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function lista_verVendedoresSucursal($sucursal){

			
			$sql="SELECT nombreVendedores, numeroVendedores FROM vendedores WHERE  idSucursal = $sucursal";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function lista_ultimaVenta($valor){

		
			$sql="SELECT MAX(idVenta) AS id FROM venta WHERE idSucursal = $valor ";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function lista_formasDePago($valor){

		
			$sql="SELECT t1.descripcionPago, t2.montoPago FROM formapago t1
			LEFT JOIN detallepago t2
			ON t1.idFormaPago = t2.idFormaPago
			WHERE t2.idVenta = $valor ";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function lista_carrito($valor1){

		
			$sql="SELECT t1.*, t2.descripcionProducto FROM detalleVenta t1 INNER JOIN productos t2 ON t1.idProducto = t2.idProducto WHERE idVenta = $valor1 ";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function actualizar_carrito($idDetalleVentaCarrito,$idVentaCarrito,$idProductoCarrito,$cantidadCarritoEditar,$precioCarritoEditar,$descuentoCarritoEditar,$precioTotalCarritoEditar,$sucursal,$cantidadCarritoEditarOculto)
		{


				//actualizo el stock del producto por sucursal
					$conexion=mysql_connect("localhost","root","Ramses2005*"); 
					mysql_select_db("pantalon",$conexion); 	
				
					$sql="SELECT stockProducto FROM stockProducto WHERE idProducto  = $idProductoCarrito and idSucursal = $sucursal ";	
					$resultado=mysql_query($sql,$conexion); 
					$rows=mysql_fetch_array($resultado);
						
					$stockGeneral=$rows[0];
					//modifico stock en base al carrito actualizado, si es mayor o menos lo que trae el input oculto
					if($cantidadCarritoEditar>$cantidadCarritoEditarOculto){
						$cantidadDescontar = $cantidadCarritoEditar - $cantidadCarritoEditarOculto;
						$stockValues = $stockGeneral - $cantidadDescontar;		
					}else if($cantidadCarritoEditar<$cantidadCarritoEditarOculto){
						$cantidadDescontar = $cantidadCarritoEditar - $cantidadCarritoEditarOculto;
						$stockValues = $stockGeneral - $cantidadDescontar;		
					}else{
						$stockValues = $stockGeneral;
					}

					$sql="UPDATE stockproducto SET stockproducto = '$stockValues' WHERE idProducto = $idProductoCarrito and idSucursal = $sucursal";
					$this->conexion->conexion->query($sql);

					$sql="SELECT stockGeneral FROM stockgeneral WHERE idProducto  = $idProductoCarrito";	
					$resultado=mysql_query($sql,$conexion); 
					$rows=mysql_fetch_array($resultado);
						
					$stockGeneral=$rows[0];

					//modifico stock en base al carrito actualizado, si es mayor o menos lo que trae el input oculto
					if($cantidadCarritoEditar>$cantidadCarritoEditarOculto){
						$cantidadDescontar = $cantidadCarritoEditar - $cantidadCarritoEditarOculto;
						$stockValues = $stockGeneral - $cantidadDescontar;		
					}else if($cantidadCarritoEditar<$cantidadCarritoEditarOculto){
						$cantidadDescontar = $cantidadCarritoEditar - $cantidadCarritoEditarOculto;
						$stockValues = $stockGeneral - $cantidadDescontar;		
					}else{
						$stockValues = $stockGeneral;
					}

					$sql="UPDATE stockgeneral SET stockGeneral = '$stockValues' WHERE idProducto = $idProductoCarrito";
					$this->conexion->conexion->query($sql);
		
			

			$sql="UPDATE detalleventa SET idVenta = '$idVentaCarrito',idProducto = '$idProductoCarrito',cantidadVenta = '$cantidadCarritoEditar',precioUnitario = '$precioCarritoEditar',descuentoProducto	 = '$descuentoCarritoEditar',precioTotal = '$precioTotalCarritoEditar' WHERE idDetalleVenta = '$idDetalleVentaCarrito'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		
			$this->conexion->cerrar();
		}

		



	function insertar_Venta($venta,$sucursal,$vendedor,$fecha)
		{
			
			//valido que no exista la sucursal
			$sql="SELECT * FROM venta
				 WHERE idVenta like '".$venta."' ";
			
			
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Numero de Venta Existente, ";


			}else{


			$sql="INSERT INTO venta(idVenta,idSucursal,idVendedor,idFormaPago,cantidadTotalVenta,subtotalVenta,descuentoVenta,precioTotalVenta,fechaVenta) 
				VALUES('$venta','$sucursal','$vendedor','','','','','','$fecha') ";
			
				if($this->conexion->conexion->query($sql)){
				return true;
			}
			else
			{
				return false;
			}

			}

			$this->conexion->cerrar();

			
			
		}

		function insertar_productos_venta($id1,$id2,$id3,$id4,$id5,$id6)
		{
			//id1 es idVenta
			//id2 es idProducto
			//id3 es cantidadVenta
			//id4 es precioUnitario
			//id5 es precioTotal
			//id6 es el idSucursal

			//voy a modificar el stock en stockproducto
			//busco el producto para saber si tiene stock inicial o no	

			$sql="SELECT * FROM stockproducto
				 WHERE idProducto  = $id2 and idSucursal  = $id6 ";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if($re=$resultados->fetch_array(MYSQL_NUM) <= 0)  
			{  
				
				$stockCalcular = 0 - $id3;
				//sino tiene stock inicial lo inicio
				$sql="INSERT INTO stockproducto (idProducto,idSucursal,stockProducto) 
				VALUES('$id2','$id6','$stockCalcular') ";
				$this->conexion->conexion->query($sql);
				
			}else{
					$conexion=mysql_connect("localhost","root","Ramses2005*"); 
					mysql_select_db("pantalon",$conexion); 	
				
					$sql="SELECT stockProducto FROM stockProducto WHERE idProducto  = $id2 and idSucursal = $id6 ";	
					$resultado=mysql_query($sql,$conexion); 
					$rows=mysql_fetch_array($resultado);
						
					$stockGeneral=$rows[0];
					//resto el stock del producto y la sucursal
					$stockValues = $stockGeneral - $id3;

				$sql="UPDATE stockproducto SET stockproducto = '$stockValues' WHERE idProducto = $id2 and idSucursal = $id6";
				$this->conexion->conexion->query($sql);
			}	
				
			
			//voy a modificar el stock en stockgenera
			//busco el producto para saber si tiene stock inicial o no	

			$sql="SELECT * FROM stockgeneral
				 WHERE idProducto  = $id2 ";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if($re=$resultados->fetch_array(MYSQL_NUM) <= 0) 
			{
				$stockCalcular = 0 - $id3;
				//sino tiene stock inicial lo inicio
				$sql="INSERT INTO stockgeneral (idProducto,stockGeneral,stockMinimo) 
				VALUES('$id2','$stockCalcular','') ";
				$this->conexion->conexion->query($sql);
			}else{
					$conexion=mysql_connect("localhost","root","Ramses2005*"); 
					mysql_select_db("pantalon",$conexion); 	
				
					$sql="SELECT stockGeneral FROM stockGeneral WHERE idProducto  = $id2  ";	
					$resultado=mysql_query($sql,$conexion); 
					$rows=mysql_fetch_array($resultado);
						
					$stockGeneral2=$rows[0];
					//resto el stock del producto y la sucursal
					$stockValues2 = $stockGeneral2 - $id3;

				$sql="UPDATE stockgeneral SET stockGeneral = '$stockValues2' WHERE idProducto = $id2 ";
				$this->conexion->conexion->query($sql);
			}		





			$sql="INSERT INTO detalleventa(idVenta,idProducto,cantidadVenta,precioUnitario,precioTotal) 
				VALUES('$id1','$id2','$id3','$id4','$id5') ";
			
				if($this->conexion->conexion->query($sql)){
				return true;
			}
			else
			{
				return false;
			}

			$this->conexion->cerrar();

			
			
		}


		
	function lista_productos_venta($valor1,$valor2,$check,$inicio=FALSE,$limite=FALSE)
		{

		if($check == 0){

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockProducto,'sin stock') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockProducto t7 ON t1.idProducto = t7.idProducto and t7.idSucursal = '$valor2'
			WHERE (t1.descripcionProducto like '%".$valor1."%' or t1.codigoBarras like '%".$valor1."%') ORDER BY t1.descripcionProducto LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockProducto,'sin stock') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockProducto t7 ON t1.idProducto = t7.idProducto and t7.idSucursal = '$valor2'
			WHERE (t1.descripcionProducto like '%".$valor1."%' or t1.codigoBarras like '%".$valor1."%') = '$valor2' ORDER BY t1.descripcionProducto";	

			}
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
		}

			if($check == 1){

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockProducto,'sin stock') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockProducto t7 ON t1.idProducto = t7.idProducto and t7.idSucursal = '$valor2'
			WHERE (t1.descripcionProducto like '%".$valor1."%' or t1.codigoBarras like '%".$valor1."%') and (t7.stockProducto > 0) ORDER BY t1.descripcionProducto LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockProducto,'sin stock') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockProducto t7 ON t1.idProducto = t7.idProducto and t7.idSucursal = '$valor2'
			WHERE (t1.descripcionProducto like '%".$valor1."%' or t1.codigoBarras like '%".$valor1."%') = '$valor2' and (t7.stockProducto > 0) ORDER BY t1.descripcionProducto";	

			}
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
		}
			$this->conexion->cerrar();

		}


	function lista_productos_devolucion($valor1,$inicio=FALSE,$limite=FALSE)
		{

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT idProducto, descripcionProducto, codigoBarras FROM productos 
			WHERE descripcionProducto like '%".$valor1."%' or codigoBarras like '%".$valor1."%' ORDER BY descripcionProducto
			LIMIT $inicio,$limite";
			}
			else{
			$sql="SELECT idProducto, descripcionProducto FROM productos 
			WHERE descripcionProducto like '%".$valor1."%' or codigoBarras like '%".$valor1."%' ORDER BY descripcionProducto";	

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

	function buscar_Ventas($valor){

		$sql="SELECT * FROM venta where idVendedor> '0' and idFormaPago= '0' and idSucursal= $valor"  ;	


			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1) {

				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	
				$sql="SELECT * FROM venta where idVendedor> '0' and idFormaPago= '0' and idSucursal= $valor";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);

				$venta=$rows[0];
				

				$sql="SELECT COUNT(*) FROM detalleventa WHERE idVenta = $venta";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);

				$cuenta=$rows[0];	

				$i = 0;

				/////modifico el stock//////
				//con el ciclo while recorro todos los productos del carrito, los borro y pongo el stock como estaba
				while($i < $cuenta){

				$i = $i + 1;
				
				$sql="SELECT idProducto,idDetalleVenta FROM detalleventa where idVenta= $venta";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
				//traigo el idProducto para poder comparar en lo siguiente
				$producto_while=$rows[0];
				//traigo este valor para comparar con el delete del final del ciclo
				//de esta forma si tengo dos productos iguales los elimina por idDetalleVenta
				$producto_while2=$rows[1];


				//busco la cantidad para sumar al stock
				$sql="SELECT cantidadVenta FROM detalleventa WHERE idVenta = $venta and idProducto = $producto_while";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);

				//traigo la cantidad de cada vuelta del while
				$valor2=$rows[0];

				$sql="SELECT stockProducto FROM stockProducto WHERE idProducto  = $producto_while and idSucursal = $valor ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneral=$rows[0];
				//sumo el stock del producto y la sucursal
				$stockValues = $stockGeneral + $valor2;

				//actualizo en base al nuevo stock
				$sql="UPDATE stockproducto SET stockproducto = '$stockValues' WHERE idProducto = $producto_while and idSucursal = $valor";
				$this->conexion->conexion->query($sql);
				
				//busco el stockgeneral para actualizarlo 
				$sql="SELECT stockgeneral FROM stockgeneral WHERE idProducto  = $producto_while ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneralTotal=$rows[0];
				//sumo el stock del producto 
				$stockValuesTotal = $stockGeneralTotal + $valor2;

				//actualizo en base al nuevo stock general
				$sql="UPDATE stockgeneral SET stockgeneral = '$stockValuesTotal' WHERE idProducto = $producto_while";
				$this->conexion->conexion->query($sql);


				$sql="DELETE FROM detalleventa WHERE idDetalleVenta = $producto_while2 and idProducto = $producto_while";
				$this->conexion->conexion->query($sql);
				}
				
				$sql="DELETE FROM venta WHERE idVendedor > '0' and idFormaPago = '0' and idSucursal = $valor";
				$this->conexion->conexion->query($sql);
				
			}
					

			
			
			$this->conexion->cerrar();

	}	



	function eliminarProductoCarrito($valor1,$valor2,$valor3,$valor4){

	//valor1 = idDetalleVenta
	//valor2 = idProducto
	//valor3 = cantidadVenta
	//valor4 = idSucursal	

	
			
				//voy a modificar el stock en stockproducto
				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	
				
				$sql="SELECT stockProducto FROM stockProducto WHERE idProducto  = $valor2 and idSucursal = $valor4 ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneral=$rows[0];
				//sumo el stock del producto y la sucursal
				$stockValues = $stockGeneral + $valor3;

				$sql="UPDATE stockproducto SET stockproducto = '$stockValues' WHERE idProducto = $valor2 and idSucursal = $valor4";
				$this->conexion->conexion->query($sql);
		

				//actualizo el stockgeneral
				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	
				
				$sql="SELECT stockGeneral FROM stockGeneral WHERE idProducto  = $valor2  ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneral2=$rows[0];
				//resto el stock del producto y la sucursal
				$stockValues2 = $stockGeneral2 + $valor3;

				$sql="UPDATE stockgeneral SET stockGeneral = '$stockValues2' WHERE idProducto = $valor2 ";
				$this->conexion->conexion->query($sql);


			$sql="DELETE FROM detalleventa WHERE idDetalleVenta='$valor1'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
	}	

		function insertar_pagos($idFormaPago1,$idFormaPago2,$idVenta,$formaDePago1,$formaDePago2,$cantidadPagos)
		{
			
			
			if($cantidadPagos == 1){

			$sql="INSERT INTO detallepago(idFormaPago,idVenta,montoPago) 
				VALUES('$idFormaPago1','$idVenta','$formaDePago1') ";
			
			$this->conexion->conexion->query($sql);
			
			}else{

			$sql="INSERT INTO detallepago(idFormaPago,idVenta,montoPago) 
				VALUES('$idFormaPago1','$idVenta','$formaDePago1') ";
			
			$this->conexion->conexion->query($sql);	

			$sql="INSERT INTO detallepago(idFormaPago,idVenta,montoPago) 
				VALUES('$idFormaPago2','$idVenta','$formaDePago2') ";
			
			$this->conexion->conexion->query($sql);	

			}	

			$this->conexion->cerrar();

			
			
		}

	function actualizar_venta_final($idVenta,$idSucursal,$idVendedor,$idFormaPago,$cantidadTotalVenta,$subTotalVenta,$descuentoVenta,$precioTotalVenta,$fechaVenta)
		{

			

			$sql="UPDATE venta SET 
			idVenta = '$idVenta',
			idSucursal = '$idSucursal',
			idVendedor = '$idVendedor',
			idFormaPago = '$idFormaPago',
			cantidadTotalVenta = '$cantidadTotalVenta',
			subTotalVenta = '$subTotalVenta',
			descuentoVenta = '$descuentoVenta',
			precioTotalVenta = '$precioTotalVenta',
			fechaVenta = '$fechaVenta'
			 WHERE idVenta = '$idVenta'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		
			$this->conexion->cerrar();
		}

	//con estas tres funciones lleno los campos de cantidad de ventas en historial de ventas en venta	
	function buscar_VentasDiarias($valor,$fecha1,$fecha2){

		

		$sql="SELECT COUNT(*) FROM venta WHERE fechaVenta >= '$fecha1' 
		and fechaVenta <= 'fecha2' and idSucursal = '$valor'"  ;	


		$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function buscar_VentasSemanales($valor,$semana,$año){

	
		$sql="SELECT COUNT(*) FROM venta WHERE WEEK(fechaVenta) = $semana and YEAR(fechaVenta) = $año 
		and idSucursal = '$valor' and idVendedor > 0" ;	

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function buscar_VentasGenerales($valor){

		

		$sql="SELECT COUNT(*) FROM venta WHERE idSucursal = '$valor' and idVendedor > 0" ;	


		$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	


	function lista_VentasDiarias($valor,$fecha1,$fecha2,$inicio=FALSE,$limite=FALSE){



			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No existe') FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
			WHERE t1.fechaVenta BETWEEN '".$fecha1."' and '".$fecha2."'  and t1.idSucursal = '$valor' and idVendedor > 0
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*, IFNULL(t2.nombreVendedores,'No Exite'), IFNULL(t3.descripcionPago,'No exite') FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago WHERE t1.fechaVenta >= '$fecha1' 
			and t1.fechaVenta <= 'fecha2'  and t1.idSucursal = '$valor' and idVendedor > 0
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

		function buscar_editarVentasDiarias($valor){

			$sql="SELECT t1.cantidadVenta, t1.precioUnitario, t1.precioTotal, t2.descripcionProducto, t1.descuentoProducto, t2.codigoBarras FROM detalleventa t1 
			INNER JOIN productos t2 ON t1.idProducto = t2.idProducto
			WHERE t1.idVenta = $valor ";	
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();


		}


		function lista_VentasSemanales($valor,$semana,$año,$inicio=FALSE,$limite=FALSE){



			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, t2.nombreVendedores, t3.descripcionPago, t4.nombreSucursal FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
			LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
			WHERE WEEK(t1.fechaVenta) = $semana and YEAR(t1.fechaVenta) = $año and t1.idSucursal = $valor
			and idVendedor > 0
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*, t2.nombreVendedores, t3.descripcionPago, t4.nombreSucursal FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
			LEFT JOIN sucursal t4 ON t1.idSucursal = t4.idSucursal
			WHERE WEEK(t1.fechaVenta) = $semana and YEAR(t1.fechaVenta) = $año and t1.idSucursal = $valor
			and idVendedor > 0
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


		function lista_VentasGenerales($valor,$fechaInicio,$fechaFin,$inicio=FALSE,$limite=FALSE){


			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No Existe')  FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
			WHERE t1.fechaVenta BETWEEN '".$fechaInicio."' and '".$fechaFin."'  and t1.idSucursal = $valor
			LIMIT $inicio,$limite ";
			}
			else{
			$sql="SELECT t1.*, IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.descripcionPago,'No Existe') FROM venta t1
			LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores
			LEFT JOIN formapago t3 ON t1.idFormaPago = t3.idFormaPago
			WHERE t1.fechaVenta BETWEEN '".$fechaInicio."' and '".$fechaFin."'  and t1.idSucursal = $valor
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

		function insertar_devolucion($idProductoDevolucion,$selectSucursalOrigenDevolucion,$selectSucursalDestinoDevolucion,$cantidadDevolucion,$motivoDevolucion)
		{
			
				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	
				//busco el stock para modificar el stock del producto
				$sql="SELECT stockProducto FROM stockProducto WHERE idProducto  = $idProductoDevolucion and idSucursal = $selectSucursalDestinoDevolucion ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneral=$rows[0];
				//me fijo que ese producto tenga stock
				if($stockGeneral <= 0){
						

						$sql="INSERT INTO stockproducto(idProducto,idSucursal,stockProducto) 
						VALUES('$idProductoDevolucion','$selectSucursalDestinoDevolucion','$cantidadDevolucion') ";
						$this->conexion->conexion->query($sql);
				}else{
						//sumo el stock del producto y la sucursal
						$stockValues = $stockGeneral + $cantidadDevolucion;

						$sql="UPDATE stockproducto SET stockproducto = '$stockValues' WHERE idProducto = $idProductoDevolucion and idSucursal = $selectSucursalDestinoDevolucion";
						$this->conexion->conexion->query($sql);
				}

				//busco el stock para modificar el stock general del producto

				$sql="SELECT stockGeneral FROM stockgeneral WHERE idProducto  = $idProductoDevolucion  ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneral1=$rows[0];

				if($stockGeneral1 <= 0){
						$sql="INSERT INTO stockgeneral(idProducto,stockGeneral,stockMinimo) 
						VALUES('$idProductoDevolucion','$cantidadDevolucion','') ";
						$this->conexion->conexion->query($sql);

						
				}else{
						//sumo el stock del producto y la sucursal
						$stockValues1 = $stockGeneral1 + $cantidadDevolucion;

						$sql="UPDATE stockgeneral SET stockGeneral = '$stockValues1' WHERE idProducto = $idProductoDevolucion ";
						$this->conexion->conexion->query($sql);	

						
				}

			$fecha = date("Y-m-d");

			$sql="INSERT INTO devoluciones(idProducto,idSucursalOrigen,idSucursalDestino,cantidadDevolucion,fechaDevolucion,motivoDevolucion) 
				VALUES('$idProductoDevolucion','$selectSucursalOrigenDevolucion','$selectSucursalDestinoDevolucion','$cantidadDevolucion','$fecha','$motivoDevolucion') ";
			
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else
			{
				return false;
			}

			//voy a modificar el stock en stockproducto para la sucursal 
				

		

			$this->conexion->cerrar();
		
		}

		function buscar_ventaAnulacion($venta,$sucursal){

		
			$sql="SELECT t1.*, IFNULL(t2.nombreVendedores,'No Existe'), IFNULL(t3.nombreSucursal,'No Existe') FROM venta t1 LEFT JOIN vendedores t2 ON t1.idVendedor = t2.idVendedores LEFT JOIN sucursal t3 ON t1.idSucursal = t3.idSucursal
			 WHERE t1.idVenta = $venta and t1.idSucursal = $sucursal ";

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}	

		function eliminar_ventaFinal($idVenta,$sucursal,$selectVendedorAnular,$motivoAnular,$dd){

			

				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	
				//cuento la cantidad de registros que hay con ese numero de venta
				$sql="SELECT COUNT(*) FROM detalleventa WHERE idVenta = $idVenta";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
				//guardo cantidad de registros con ese idVenta
				$cuenta=$rows[0];	

				$i = 0;

				/////modifico el stock//////
				//con el ciclo while recorro todos los productos del carrito, los borro y pongo el stock como estaba
				while($i < $cuenta){

				$i = $i + 1;
				
				$sql="SELECT idProducto,idDetalleVenta FROM detalleventa where idVenta= $idVenta";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
				//traigo el idProducto para poder comparar en lo siguiente
				$producto_while=$rows[0];
				//traigo este valor para comparar con el delete del final del ciclo
				//de esta forma si tengo dos productos iguales los elimina por idDetalleVenta
				$producto_while2=$rows[1];


				//busco la cantidad para sumar al stock
				$sql="SELECT cantidadVenta FROM detalleventa WHERE idVenta = $idVenta and idProducto = $producto_while";
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);

				//traigo la cantidad de cada vuelta del while
				$valor2=$rows[0];

				$sql="SELECT stockProducto FROM stockProducto WHERE idProducto  = $producto_while and idSucursal = $sucursal ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneral=$rows[0];
				//sumo el stock del producto y la sucursal
				$stockValues = $stockGeneral + $valor2;

				//actualizo en base al nuevo stock
				$sql="UPDATE stockproducto SET stockproducto = '$stockValues' WHERE idProducto = $producto_while and idSucursal = $sucursal";
				$this->conexion->conexion->query($sql);
				
				//busco el stockgeneral para actualizarlo 
				$sql="SELECT stockgeneral FROM stockgeneral WHERE idProducto  = $producto_while ";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
						
				$stockGeneralTotal=$rows[0];
				//sumo el stock del producto 
				$stockValuesTotal = $stockGeneralTotal + $valor2;

				//actualizo en base al nuevo stock general
				$sql="UPDATE stockgeneral SET stockgeneral = '$stockValuesTotal' WHERE idProducto = $producto_while";
				$this->conexion->conexion->query($sql);

				//elimino los idVenta que coincidadan en detalleVenta
				$sql="DELETE FROM detalleventa WHERE idDetalleVenta = $producto_while2 and idProducto = $producto_while";
				$this->conexion->conexion->query($sql);

				//inserto el motivo de la devolucion
				$sql="INSERT INTO ventaseliminadas (idVendedores,idProducto,motivoAnulacion,fechaAnulacion)
				VALUES('$selectVendedorAnular','$producto_while','$motivoAnular','$dd')";
				$this->conexion->conexion->query($sql);
				}

				//elimino las formas de pago del idVenta
				$sql="DELETE FROM detallepago WHERE idVenta = $idVenta";
				$this->conexion->conexion->query($sql);
				//elimino la venta
				$sql="DELETE FROM venta WHERE idVenta = $idVenta";
				$this->conexion->conexion->query($sql);

				$this->conexion->cerrar();

		}	
}

?>