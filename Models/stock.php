	<?php 
	class stock
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}

	function verInventario(){

			$sql="SELECT IFNULL(sum(stockGeneral),0) from stockgeneral WHERE stockGeneral > '0' ";
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}	

	function verStockConsulta($valor){

			$sql="SELECT sum(t1.stockGeneral) FROM stockgeneral t1 LEFT JOIN productos t2 ON  t1.idProducto = t2.idProducto
			WHERE t2.descripcionProducto LIKE '%".$valor."%' or t2.codigoBarras LIKE '%".$valor."%' 
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

	function verInventario2($valor1,$valor2,$valor3,$valor4,$valor5){

			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockProducto,'0') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockproducto t7 ON t1.idProducto = t7.idProducto
    		WHERE t1.idMarcaProducto like '".$valor1."%' and t1.idModeloProducto like '".$valor2."%'  and t1.idTalleProducto like '%".$valor3."'  and t1.idColorProducto like '".$valor4."%' and t1.idTelaProducto like '".$valor5."%' ";
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	

	function lista_productosStock($valor,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE) {
				$sql="SELECT t1.idProducto, t2.idSucursal, t1.codigoBarras, t1.descripcionProducto, t1.precioVenta, IFNULL(t2.stockProducto,'Sin Stock'),
				IFNULL(t3.nombreSucursal,'Sin Stock'), IFNULL(t4.stockMinimo,'Sin Stock'),
				IFNULL(t4.stockGeneral,'Sin Stock'),
				IFNULL(suma,'Sin Stock') as sumaTotal, t3.direccionSucursal
			    FROM productos t1
				LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
				LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal
			    LEFT JOIN stockgeneral t4 ON t1.idProducto = t4.idProducto
                LEFT JOIN (select sum(stockGeneral) as suma from stockgeneral) s ON (t1.idProducto = t4.idProducto) 
                WHERE descripcionProducto like '%".$valor."%' or codigoBarras like '%".$valor."%' 
                ORDER BY t1.descripcionProducto, t3.nombreSucursal 
                LIMIT $inicio,$limite  ";
            }else{
				$sql="SELECT t1.idProducto, t2.idSucursal, t1.codigoBarras, t1.descripcionProducto, t1.precioVenta, IFNULL(t2.stockProducto,'Sin Stock'),
				IFNULL(t3.nombreSucursal,'Sin Stock'), IFNULL(t4.stockMinimo,'Sin Stock'),
				IFNULL(t4.stockGeneral,'Sin Stock'),
				IFNULL(suma,'Sin Stock') as sumaTotal, t3.direccionSucursal
			    FROM productos t1
				LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
				LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal
			    LEFT JOIN stockgeneral t4 ON t1.idProducto = t4.idProducto
                LEFT JOIN (select sum(stockGeneral) as suma from stockgeneral) s ON (t1.idProducto = t4.idProducto) 
                WHERE descripcionProducto like '%".$valor."%' or codigoBarras like '%".$valor."%' 
                ORDER BY t1.descripcionProducto, t3.nombreSucursal  ";
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

	function lista_productosStockCarga($valor,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE) {	
				$sql="SELECT * FROM productos
                WHERE descripcionProducto like '%".$valor."%' or codigoBarras like '%".$valor."%' 
                ORDER BY descripcionProducto
                LIMIT $inicio,$limite";
            }else{  
            	$sql="SELECT * FROM productos
                WHERE descripcionProducto like '%".$valor."%' or codigoBarras like '%".$valor."%' 
                ORDER BY descripcionProducto "; 
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

	function insertar_stock($idProducto,$idSucursal,$stockProducto,$stockMinimo,$fechaActual)
		{
			
			
			$sql="SELECT * FROM stockproducto
				 WHERE idProducto  = $idProducto and idSucursal = $idSucursal";
			
			
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  

				//echo "El producto ya tiene stock, haga click en el boton de actualizar";
				return false;
			 
			}else{	

			$sql="INSERT INTO stockproducto (idProducto,idSucursal,stockProducto,fechaCarga) 
				VALUES('$idProducto','$idSucursal','$stockProducto','$fechaActual') ";
			
				if($this->conexion->conexion->query($sql)){
				

				//sumo el stock del mismo producto para poder guardarlo en la tabla de stockGeneral	y busco el valor minimo
				
				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
					mysql_select_db("pantalon",$conexion); 	
				
					$sql="SELECT SUM(t1.stockProducto), IFNULL(t2.stockMinimo,'Sin Stock Mínimo') FROM stockproducto t1 LEFT JOIN stockGeneral t2 ON 
					t1.idProducto = t2.idProducto WHERE t1.idProducto  = $idProducto";	
					$resultado=mysql_query($sql,$conexion); 
					$rows=mysql_fetch_array($resultado);
						
						//sumo el stock en el query
						$stockGeneral=$rows[0];

						//si lo que trae el controlador es vacio, es que no se cargo el stock minimo, 
						//en ese caso le agrego a la varible el stock minimo del query
						if($stockMinimo==""){
							$stockMinimo1=$rows[1];
						}else{
							$stockMinimo1=$stockMinimo;
						}
						
					
											//me fijo que ese producto no tenga stock
											$sql="SELECT * FROM stockgeneral
											WHERE idProducto like '".$idProducto."'";
											

											$this->conexion->conexion->set_charset('utf8');
											$resultados=$this->conexion->conexion->query($sql);
											if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
											{  

												//si tiene stock lo actualizo

			    								$sql="UPDATE stockgeneral SET idProducto = '$idProducto', stockGeneral = '$stockGeneral', stockMinimo = '$stockMinimo1' WHERE idProducto = '$idProducto' ";
			    								$this->conexion->conexion->query($sql);
			    								

			    							}else{

			    								//sino tiene stock lo ingreso por primera vez
			    								$sql="INSERT INTO stockgeneral (idProducto,stockGeneral,stockMinimo) 
												VALUES('$idProducto','$stockGeneral','$stockMinimo') ";
												$this->conexion->conexion->query($sql);
												


			    							}
			return true;
			}
			else
			{
				return false;
			}

			}

			$this->conexion->cerrar();

			
			
		}

		function actualizar_stock($idSucursalActualizar,$idProductoActualizar,$stockActual,$stockMinimoActual,$nuevoStock,$nuevoStockMinimo,$fechaActual)
		{

			
			//sumo el stock actual mas el nuevo stock
			$stockTotal = $stockActual + $nuevoStock;
		
			$sql="UPDATE stockproducto SET stockProducto = '$stockTotal', fechaCarga = '$fechaActual' WHERE idProducto = '$idProductoActualizar' and idSucursal ='$idSucursalActualizar' ";
			if($this->conexion->conexion->query($sql)){


					$conexion=mysql_connect("localhost","root","Ramses2005*"); 
					mysql_select_db("pantalon",$conexion); 	
				
					$sql="SELECT * FROM stockgeneral WHERE idProducto  = $idProductoActualizar";	
					$resultado=mysql_query($sql,$conexion); 
					$rows=mysql_fetch_array($resultado);
						
						//traigo el stock general del producto seleccionado
						$stockGeneral=$rows[1];
						$stockMinimo=$rows[2];
						//sumo el stock que habia del producto mas el nuevo stock
						$nuevoStockGeneral=$stockGeneral + $nuevoStock;
						
						//si no ingreso ningun stock minimo dejo el que estaba
						if($nuevoStockMinimo==""){
							$stockMinimo=$stockMinimoActual;
						}else{
							$stockMinimo=abs($nuevoStockMinimo);
						}


						$sql="UPDATE stockgeneral SET idProducto = '$idProductoActualizar', stockGeneral = '$nuevoStockGeneral', stockMinimo = '$stockMinimo' WHERE idProducto = '$idProductoActualizar' ";
			    		$this->conexion->conexion->query($sql);


				return true;
			}
			else{
				return false;
			}
		
				
			$this->conexion->cerrar();
		}



		function borrar_stock(){
			
			$sql="DELETE FROM stockproducto ";
			$this->conexion->conexion->query($sql);
			
			$sql="DELETE FROM stockgeneral";
			$this->conexion->conexion->query($sql);
			
			$this->conexion->cerrar();
		}	

		function ordenar_stock_general(){
			
			$sql="UPDATE stockgeneral T1,
			( SELECT idProducto, SUM(stockProducto) total
			  FROM stockproducto
			  GROUP BY idProducto ) T2
			  SET T1.stockGeneral = T2.total
			  WHERE T1.idProducto = T2.idProducto ";
			
			$this->conexion->conexion->query($sql);
			
			$this->conexion->cerrar();
		}	



	

	}

?>