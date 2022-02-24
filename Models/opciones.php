<?php 
	class opciones
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}

		function incrementoProducto($idProducto,$incrementoProducto)
		{

					
			$sql="SELECT * FROM usuarios WHERE nombreUsuario='$nombreUsuario' and  passUsuario ='$password' and rolUsuario = '$rol' ";
			$resultados = $this->conexion->conexion->query($sql);

			
			if ($resultados->num_rows > 0) {
				$r=$resultados->fetch_array();
			}
			else{
				$r[0]=0;
			}
			return $r;
			$this->conexion->cerrar();
		}

	function lista_sucursal($valor){
			$sql="SELECT * FROM sucursal ORDER BY nombreSucursal ASC";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}
		
	function actualizar_sucursal($idSucursal,$nombreSucursal,$direccionSucursal,$telefonoSucursal)
		{

			//valido que no exista el producto
			$sql="SELECT * FROM sucursal
				 WHERE nombreSucursal like '".$nombreSucursal."' and  direccionSucursal like '".$direccionSucursal."' 
				 and telefonoSucursal like '".$telefonoSucursal."' ";
			
			
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "No se modifico ningún dato";


			}else{

			$sql="UPDATE sucursal SET nombreSucursal = '$nombreSucursal',direccionSucursal = '$direccionSucursal',telefonoSucursal = '$telefonoSucursal' WHERE idSucursal = '$idSucursal'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		}
			$this->conexion->cerrar();
		}


		function lista_vendedores($valor,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, t2.nombreSucursal from vendedores t1 inner join sucursal t2 on
				  t1.idSucursal = t2.idSucursal  WHERE nombreVendedores like '%".$valor."%' or
				  t2.nombreSucursal like '%".$valor."%' or numeroVendedores like '%".$valor."%' ORDER BY numeroVendedores
				  LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.*, t2.nombreSucursal from vendedores t1 inner join sucursal t2 on
				  t1.idSucursal = t2.idSucursal  WHERE nombreVendedores like '%".$valor."%' or
				  t2.nombreSucursal like '%".$valor."%' or numeroVendedores like '%".$valor."%' ORDER BY numeroVendedores ";	
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

		function insertar_vendedores($idVendedores,$selectSucursal,$numeroVendedores,$nombreVendedores)
		{
			
			//valido que no exista el vendedor
			$sql="SELECT * FROM vendedores
				 WHERE idSucursal like '".$selectSucursal."' and numeroVendedores like '".$numeroVendedores."' ";
			
			
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Vendedor Existente en esa sucursal, ";


			}else{


			$sql="INSERT INTO vendedores (idSucursal,numeroVendedores,nombreVendedores) 
				VALUES('$selectSucursal','$numeroVendedores','$nombreVendedores') ";
			
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


		function actualizar_vendedores($idVendedores,$selectSucursal,$numeroVendedores,$nombreVendedores)
		{

			

			$sql="UPDATE vendedores SET nombreVendedores = '$nombreVendedores' WHERE idVendedores = '$idVendedores'";
			$this->conexion->conexion->set_charset('utf8');
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		
			$this->conexion->cerrar();
		}


		function eliminar_venderores_confirma($idVendedores)
		{
			
			//valido que no exista el vendedores
			$sql="SELECT * FROM venta
				 WHERE idVendedor = $idVendedores  ";
			
			
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

		}

		function eliminar_vendedor($idVendedores){
			$sql="DELETE FROM vendedores WHERE idVendedores='$idVendedores'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	



		function lista_ProductoEnvio($valor,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.idProducto, t1.descripcionProducto,  IFNULL(t2.stockProducto,'Sin Stock'), IFNULL(t3.nombreSucursal,'Sin Stock'), t3.idSucursal FROM productos t1 
					LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
					LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal  WHERE t1.descripcionProducto like '%".$valor."%' or
				    t1.codigoBarras like '%".$valor."%' ORDER BY t1.descripcionProducto
				    LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.idProducto, t1.descripcionProducto,  IFNULL(t2.stockProducto,'Sin Stock'), IFNULL(t3.nombreSucursal,'Sin Stock'), t3.idSucursal FROM productos t1 
					LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
					LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal  WHERE t1.descripcionProducto like '%".$valor."%' or
				    t1.codigoBarras like '%".$valor."%' ORDER BY t1.descripcionProducto ";	

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

		function lista_ProductoEnvioVenta($valor,$sucursal,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.idProducto, t1.descripcionProducto,  IFNULL(t2.stockProducto,'Sin Stock'), IFNULL(t3.nombreSucursal,'Sin Stock'), t3.idSucursal FROM productos t1 
					LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
					LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal  
					WHERE (t1.descripcionProducto like '%".$valor."%' or
				    t1.codigoBarras like '%".$valor."%') &&  
					t3.idSucursal = $sucursal
					ORDER BY t1.descripcionProducto
				    LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.idProducto, t1.descripcionProducto,  IFNULL(t2.stockProducto,'Sin Stock'), IFNULL(t3.nombreSucursal,'Sin Stock'), t3.idSucursal FROM productos t1 
					LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
					LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal  
					WHERE (t1.descripcionProducto like '%".$valor."%' or
				    t1.codigoBarras like '%".$valor."%')  and
					t3.idSucursal = $sucursal
					ORDER BY t1.descripcionProducto ";	

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

		//muestro el historial de los productos enviados
		function buscarEnvioHistorial($valor1,$valor2,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE){
			$sql="SELECT t1.idEnvioMercaderia, t1.cantidadEnvio, t1.fechaEnvio, t2.descripcionProducto, t3.nombreSucursal as nosirve2, t4.nombreSucursal as nosirve2 FROM enviomercaderia t1
					inner join productos t2 on
					t1.idProducto = t2.idProducto
					inner join sucursal t3 on
					t1.idSucursalOrigen = t3.idSucursal
					inner join sucursal t4 on
					t1.idSucursalDestino = t4.idSucursal
					WHERE t1.fechaEnvio BETWEEN '".$valor1."' and '".$valor2."' 
				    ORDER BY t1.fechaEnvio  LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.idEnvioMercaderia, t1.cantidadEnvio, t1.fechaEnvio, t2.descripcionProducto, t3.nombreSucursal as nosirve2, t4.nombreSucursal as nosirve2 FROM enviomercaderia t1
					inner join productos t2 on
					t1.idProducto = t2.idProducto
					inner join sucursal t3 on
					t1.idSucursalOrigen = t3.idSucursal
					inner join sucursal t4 on
					t1.idSucursalDestino = t4.idSucursal
					WHERE t1.fechaEnvio BETWEEN '".$valor1."' and '".$valor2."'
					ORDER BY t1.fechaEnvio ";	
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


		//muestro el historial de los productos enviados para la venta
		function buscarEnvioHistorialVenta($fechaVenta){

			
			$sql="SELECT t1.idEnvioMercaderia, t1.cantidadEnvio, t1.fechaEnvio, t2.descripcionProducto, t3.nombreSucursal as nosirve2, t4.nombreSucursal as nosirve2 FROM enviomercaderia t1
			inner join productos t2 on
			t1.idProducto = t2.idProducto
			inner join sucursal t3 on
			t1.idSucursalOrigen = t3.idSucursal
			inner join sucursal t4 on
			t1.idSucursalDestino = t4.idSucursal
			WHERE t1.fechaEnvio = '$fechaVenta'
			ORDER BY t1.idEnvioMercaderia  ";
		
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}

		function insertar_envio($idProductoEnvio,$productoSeleccionadoSucursal,$selectSucursalDestino,$cantidadEnvio,$fechaEnvio)
		{
			

			//valido que el producto tenga stock en la sucursal de origen y que la cantidad enviada no sea mayor a la que tiene el producto
			//soluciono el problema que el campo de envio no este en "0" validando desde JS
			$sql="SELECT * FROM stockProducto
				 WHERE idProducto like '".$idProductoEnvio."' and idSucursal like '".$productoSeleccionadoSucursal."' and stockProducto >= '".$cantidadEnvio."' ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) < 1)  
			{  
			echo "El producto seleccionado no tiene stock suficiente. ";
			

			}else{

			$cantidadEnvioAbs = abs($cantidadEnvio);	
			$sql="INSERT INTO enviomercaderia (idProducto,idSucursalOrigen,idSucursalDestino, cantidadEnvio, fechaEnvio) 
				VALUES('$idProductoEnvio','$productoSeleccionadoSucursal','$selectSucursalDestino','$cantidadEnvioAbs','$fechaEnvio') ";
			
			if($this->conexion->conexion->query($sql)){

						//busco el stock del producto que envia para actualizar el stock
						$conexion=mysql_connect("localhost","root","Ramses2005*"); 
						mysql_select_db("pantalon",$conexion); 	
				
						$sql="SELECT * FROM stockproducto WHERE idProducto  = $idProductoEnvio and idSucursal = $productoSeleccionadoSucursal";	
						$resultado=mysql_query($sql,$conexion); 
						$rows=mysql_fetch_array($resultado);
						
						//traigo el stock del producto de origen para  el envio
						$stockProductoOrigen=$rows[2];
						//ingreso en la variable el nuevo stock del producto origen
						$nuevoStockOrigen = $stockProductoOrigen - abs($cantidadEnvio);

						//actualizo el stock del producto origen
						$sql="UPDATE stockproducto SET stockProducto = '$nuevoStockOrigen' WHERE idProducto  = $idProductoEnvio and idSucursal = $productoSeleccionadoSucursal ";
			    		$this->conexion->conexion->query($sql);
					
			    		//busco el producto de destino
			    		$sql="SELECT * FROM stockproducto WHERE idProducto  = $idProductoEnvio and idSucursal = $selectSucursalDestino";	
						$resultado=mysql_query($sql,$conexion); 
						$rows=mysql_fetch_array($resultado);
						
						//traigo el stock del producto de destino para  el envio
						$stockProductoDestino=$rows[2];
						
						//me fijo que la sucursal destino tenga stock o este creada
						if($stockProductoDestino==null){

							//como la sucursal de destino no tiene stock ingreso stock nuevo
							$sql="INSERT INTO stockproducto (idProducto,idSucursal,stockProducto) 
							VALUES('$idProductoEnvio','$selectSucursalDestino','$cantidadEnvio') ";
						$this->conexion->conexion->query($sql);	
						}else{
						//ingreso en la variable el nuevo stock del producto destino
						$nuevoStockDestino = $stockProductoDestino + abs($cantidadEnvio);

						//actualizo el stock del producto destino
						$sql="UPDATE stockproducto SET stockProducto = '$nuevoStockDestino' WHERE idProducto  = $idProductoEnvio and idSucursal = $selectSucursalDestino ";
			    		$this->conexion->conexion->query($sql);
			    		}


				return true;
			}
			else{
				return false;
			}
			

			}

			$this->conexion->cerrar();
		}	


		function insertar_envio_venta($idProductoEnvio2,$productoSeleccionadoSucursal2,$selectSucursalDestino2,$cantidadEnvio2,$fechaEnvio2)
		{
			

			//valido que el producto tenga stock en la sucursal de origen y que la cantidad enviada no sea mayor a la que tiene el producto
			/*soluciono el problema que el campo de envio no este en "0" validando desde JS
			$sql="SELECT * FROM stockProducto
				 WHERE idProducto like '".$idProductoEnvio2."' and idSucursal like '".$productoSeleccionadoSucursal2."' and stockProducto >= '".$cantidadEnvio2."' ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) < 1)  
			{  
			echo "El producto seleccionado no tiene stock suficiente. ";
			

			}else{

			
			*/
			$cantidadEnvioAbs = abs($cantidadEnvio2);	
			$sql="INSERT INTO enviomercaderia (idProducto,idSucursalOrigen,idSucursalDestino, cantidadEnvio, fechaEnvio) 
				VALUES('$idProductoEnvio2','$productoSeleccionadoSucursal2','$selectSucursalDestino2','$cantidadEnvioAbs','$fechaEnvio2') ";
			
			if($this->conexion->conexion->query($sql)){

						//busco el stock del producto que envia para actualizar el stock
						$conexion=mysql_connect("localhost","root","Ramses2005*"); 
						mysql_select_db("pantalon",$conexion); 	
				
						$sql="SELECT * FROM stockproducto WHERE idProducto  = $idProductoEnvio2 and idSucursal = $productoSeleccionadoSucursal2";	
						$resultado=mysql_query($sql,$conexion); 
						$rows=mysql_fetch_array($resultado);
						
						//traigo el stock del producto de origen para  el envio
						$stockProductoOrigen=$rows[2];
						//ingreso en la variable el nuevo stock del producto origen
						$nuevoStockOrigen = $stockProductoOrigen - abs($cantidadEnvio2);

						//actualizo el stock del producto origen
						$sql="UPDATE stockproducto SET stockProducto = '$nuevoStockOrigen' WHERE idProducto  = $idProductoEnvio2 and idSucursal = $productoSeleccionadoSucursal2 ";
			    		$this->conexion->conexion->query($sql);
					
			    		//busco el producto de destino
			    		$sql="SELECT * FROM stockproducto WHERE idProducto  = $idProductoEnvio2 and idSucursal = $selectSucursalDestino2";	
						$resultado=mysql_query($sql,$conexion); 
						$rows=mysql_fetch_array($resultado);
						
						//traigo el stock del producto de destino para  el envio
						$stockProductoDestino=$rows[2];
						
						//me fijo que la sucursal destino tenga stock o este creada
						if($stockProductoDestino==null){

							//como la sucursal de destino no tiene stock ingreso stock nuevo
							$sql="INSERT INTO stockproducto (idProducto,idSucursal,stockProducto) 
							VALUES('$idProductoEnvio2','$selectSucursalDestino2','$cantidadEnvio2') ";
						$this->conexion->conexion->query($sql);	
						}else{
						//ingreso en la variable el nuevo stock del producto destino
						$nuevoStockDestino = $stockProductoDestino + abs($cantidadEnvio2);

						//actualizo el stock del producto destino
						$sql="UPDATE stockproducto SET stockProducto = '$nuevoStockDestino' WHERE idProducto  = $idProductoEnvio2 and idSucursal = $selectSucursalDestino2 ";
			    		$this->conexion->conexion->query($sql);
			    		}


				return true;
			}
			else{
				return false;
			}
			

			

			$this->conexion->cerrar();
		}	

		//funcion para devolver el resultado de la seleccion por select para cambiar el precio
		function lista_productos_precios_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5)
		{
		
		
		$sql="SELECT COUNT(DISTINCT(t1.idProducto)),t1.precioVenta, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockProducto,'0'), MAX(t1.precioVenta), MIN(t1.precioVenta) FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockproducto t7 ON t1.idProducto = t7.idProducto
    	WHERE t1.idMarcaProducto like '".$valor1."%' and t1.idModeloProducto like '".$valor2."%'  and t1.idTalleProducto like '%".$valor3."'  and t1.idColorProducto like '".$valor4."%' and t1.idTelaProducto like '".$valor5."%'
		ORDER BY t1.descripcionProducto
		";
		
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}

		//funcion para devolver el resultado de la seleccion por select
		function lista_productos_caracteristicas($valor1,$valor2,$valor3,$valor4,$valor5,$inicio=FALSE,$limite=FALSE)
		{
		
		if ($inicio!==FALSE && $limite!==FALSE) {	
		$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockGeneral,'0') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockgeneral t7 ON t1.idProducto = t7.idProducto
    	WHERE t1.idMarcaProducto like '".$valor1."%' and t1.idModeloProducto like '".$valor2."%'  and t1.idTalleProducto like '%".$valor3."'  and t1.idColorProducto like '".$valor4."%' and t1.idTelaProducto like '".$valor5."%'
		ORDER BY t1.descripcionProducto
		LIMIT $inicio,$limite";
		}else{
		$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockGeneral,'0') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockGeneral t7 ON t1.idProducto = t7.idProducto
    	WHERE t1.idMarcaProducto like '".$valor1."%' and t1.idModeloProducto like '".$valor2."%'  and t1.idTalleProducto like '%".$valor3."'  and t1.idColorProducto like '".$valor4."%' and t1.idTelaProducto like '".$valor5."%'
		ORDER BY t1.descripcionProducto ";	
		}	
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}


		function actualizar_precios_por_valor($valor1,$valor2,$valor3,$valor4,$valor5,$precioNuevo,$fechaPrecio)
		{

				
				//busco si hay un idPrecio existente
				$conexion=mysql_connect("localhost","root","Ramses2005*"); 
				mysql_select_db("pantalon",$conexion); 	
		
				$sql="SELECT idPrecios FROM precios order by idPrecios DESC LIMIT 1";	
				$resultado=mysql_query($sql,$conexion); 
				$rows=mysql_fetch_array($resultado);
				
				//sumo el id + 1 para que no se repita el numero de idPrecio
				$numeroidPrecios=$rows[0];

				if($numeroidPrecios==""){
					$numeroidPrecios = 1;
				}else{
					$numeroidPrecios = $numeroidPrecios + 1;
				}
				

				$sql="INSERT INTO precios (idPrecios,idProducto,precioAnterior,precioActual,fechaPrecio,valor1,valor2,valor3,valor4,valor5) 
				SELECT '$numeroidPrecios', t1.idProducto, t1.precioVenta, '$precioNuevo','$fechaPrecio', IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,'') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto 
    			WHERE t1.idMarcaProducto like '".$valor1."%' and t1.idModeloProducto like '".$valor2."%'  and t1.idTalleProducto like '%".$valor3."'  and t1.idColorProducto like '".$valor4."%' and t1.idTelaProducto like '".$valor5."%'
				";
				$this->conexion->conexion->query($sql);	
			
			if($valor2=='' and $valor3=='' and $valor4=='' and $valor5=='' ){
			$sql="UPDATE productos SET precioVenta = '$precioNuevo' 
			WHERE idMarcaProducto = '".$valor1."%'   ";
			}elseif ($valor3=='' and $valor4=='' and $valor5=='' ) {
			$sql="UPDATE productos SET precioVenta = '$precioNuevo' 
			WHERE idMarcaProducto LIKE '".$valor1."%' and idModeloProducto LIKE '".$valor2."%'  ";
			}elseif ($valor4=='' and $valor5=='' ) {
			$sql="UPDATE productos SET precioVenta = '$precioNuevo' 
			WHERE idMarcaProducto LIKE '".$valor1."%' and idModeloProducto LIKE '".$valor2."%' and idTalleProducto LIKE '".$valor3."%' ";
			}elseif ($valor5=='' ) {
			$sql="UPDATE productos SET precioVenta = '$precioNuevo' 
			WHERE idMarcaProducto LIKE '".$valor1."%' and idModeloProducto LIKE '".$valor2."%' and idTalleProducto LIKE '".$valor3."%' and idColorProducto LIKE '".$valor4."%' ";
			}else{
			$sql="UPDATE productos SET precioVenta = '$precioNuevo' 
			WHERE idMarcaProducto LIKE '".$valor1."%' and idModeloProducto LIKE '".$valor2."%' and idTalleProducto LIKE '".$valor3."%' and idColorProducto LIKE '".$valor4."%'  and idTelaProducto LIKE '".$valor5."%' ";	
			}
			$this->conexion->conexion->set_charset('utf8');
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		
			$this->conexion->cerrar();	
			}


			//funcion para devolver el historial de cambio de precios
		function lista_cambio_precios($inicio=FALSE,$limite=FALSE)
		{
		
		if ($inicio!==FALSE && $limite!==FALSE) {	
		$sql="SELECT * FROM precios group by idPrecios
		LIMIT $inicio,$limite";
		}else{
		$sql="SELECT * FROM precios group by idPrecios";	
		}	
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}

		function lista_detalle_precios($id,$inicio=FALSE,$limite=FALSE)
		{
		
		if ($inicio!==FALSE && $limite!==FALSE) {	
		$sql="SELECT * FROM precios WHERE idPrecios = '".$id."%'
		LIMIT $inicio,$limite";
		}else{
		$sql="SELECT * FROM precios WHERE idPrecios = '".$id."%'";	
		}	
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}

	function buscar_ultimosPrecios($valor){

		$sql="SELECT fechaPrecio,precioAnterior FROM precios WHERE idProducto = $valor";	

			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

	}	


	function lista_formasPago_opciones($valor,$inicio=FALSE,$limite=FALSE){

			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT * FROM formapago WHERE descripcionPago like '%".$valor."%' ORDER BY descripcionPago
				  LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT * FROM formapago WHERE descripcionPago like '%".$valor."%' ORDER BY descripcionPago";
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

	function insertar_pago_controller($descripcionPago)
		{
			
			//valido que no exista la misma forma de pago
			$sql="SELECT * FROM formapago
				 WHERE descripcionPago like '".$descripcionPago."' ";
			
			
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Forma de Pago Existente, ";


			}else{


			$sql="INSERT INTO formapago (descripcionPago) 
				VALUES('$descripcionPago') ";
			
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

	function eliminar_formadepago_confirma($idFormaPago)
	{
		
		//valido que no exista un id de forma de pago con ese numero en alguna venta
		$sql="SELECT * FROM detallepago
			 WHERE idFormaPago = $idFormaPago  ";
		
		
		
		$this->conexion->conexion->set_charset('utf8');
		$resultados=$this->conexion->conexion->query($sql);
		if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
		{  
		return true;

		}

		$this->conexion->cerrar();

	}	

	//elimino la forma de pago cuando recibo el true de la funcion anterior	
	function eliminar_formaDePago($idFormaPago){
		$sql="DELETE FROM formapago WHERE idFormaPago='$idFormaPago'";
		if($this->conexion->conexion->query($sql)){
			return true;
		}
		else{
			return false;
		}
		$this->conexion->cerrar();
	}	

	function actualizar_forma_de_pago_model($idFormaPago,$descripcionPago)
	{

		$sql="UPDATE formapago SET descripcionPago = '$descripcionPago' WHERE idFormaPago = '$idFormaPago'";
		$this->conexion->conexion->set_charset('utf8');
		if($this->conexion->conexion->query($sql)){
			return true;
		}
		else{
			return false;
		}
	
		$this->conexion->cerrar();
	}

	function lista_devoluciones_opciones1($inicio=FALSE,$limite=FALSE){

		if ($inicio!==FALSE && $limite!==FALSE) {
		$sql="SELECT t1.*, t2.descripcionProducto, t3.nombreSucursal as sucursal1, t4.nombreSucursal as sucursal2 FROM devoluciones t1
		inner join productos t2 on
		t1.idProducto = t2.idProducto
		inner join sucursal t3 on
		t1.idSucursalOrigen = t3.idSucursal
		inner join sucursal t4 on
		t1.idSucursalDestino = t4.idSucursal
		ORDER BY t1.fechaDevolucion DESC
		LIMIT $inicio,$limite ";
		}else{
		$sql="SELECT t1.*, t2.descripcionProducto, t3.nombreSucursal as sucursal1, t4.nombreSucursal as sucursal2 FROM devoluciones t1
		inner join productos t2 on
		t1.idProducto = t2.idProducto
		inner join sucursal t3 on
		t1.idSucursalOrigen = t3.idSucursal
		inner join sucursal t4 on
		t1.idSucursalDestino = t4.idSucursal
		ORDER BY t1.fechaDevolucion DESC";
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