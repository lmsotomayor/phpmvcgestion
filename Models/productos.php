<?php 
	class productos
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');

			$this->conexion= new conexion();
			$this->conexion->conectar();
		}


		function lista_productos($valor,$inicio=FALSE,$limite=FALSE)
		{
			
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL( t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,'') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto
				 WHERE descripcionProducto like '%".$valor."%' or codigoBarras like '%".$valor."%'
				 ORDER BY t1.descripcionProducto 
				 LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL( t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,'') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto
				 WHERE descripcionProducto like '%".$valor."%' or codigoBarras like '%".$valor."%'
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

		function lista_telas($valor,$inicio=FALSE,$limite=FALSE)
		{
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT *  FROM telaproducto  WHERE nombreTelaProducto like '%".$valor."%'
			ORDER BY nombreTelaProducto  LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT *  FROM telaproducto  WHERE nombreTelaProducto like '%".$valor."%'
			ORDER BY nombreTelaProducto ";
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

		function lista_telas_relaciones()
		{
			
			
			$sql="SELECT t1.nombreTelaProducto, count(t2.idTelaProducto) as cantidad FROM telaProducto t1 
			INNER JOIN productos t2
			ON t1.idTelaProducto = t2.idTelaProducto
			GROUP BY t1.nombreTelaProducto 
			ORDER BY cantidad DESC";
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}

		function lista_talles($valor,$inicio=FALSE,$limite=FALSE)
		{
			
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT *  FROM talleproducto 
			WHERE nombreTalleProducto like '%".$valor."%' 
			LIMIT $inicio,$limite";
			}else{
			$sql="SELECT *  FROM talleproducto 
			WHERE nombreTalleProducto like '%".$valor."%'
			";
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

		function lista_talles_relaciones($inicio=FALSE,$limite=FALSE)
		{
			
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.nombreTalleProducto, count(t2.idTalleProducto) as cantidad FROM talleProducto t1 
			INNER JOIN productos t2
			ON t1.idTalleProducto = t2.idTalleProducto
			GROUP BY t1.nombreTalleProducto 
			ORDER BY cantidad DESC
			LIMIT $inicio,$limite";
			}else{
			$sql="SELECT t1.nombreTalleProducto, count(t2.idTalleProducto) as cantidad FROM talleProducto t1 
			INNER JOIN productos t2
			ON t1.idTalleProducto = t2.idTalleProducto
			GROUP BY t1.nombreTalleProducto 
			ORDER BY cantidad DESC";
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

		function lista_color($valor,$inicio=FALSE,$limite=FALSE)
		{
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT *  FROM colorproducto 
     		WHERE nombreColorProducto like '%".$valor."%' 
     		ORDER BY nombreColorProducto ASC
			LIMIT $inicio,$limite";
			}else{
			$sql="SELECT *  FROM colorproducto 
     		WHERE nombreColorProducto like '%".$valor."%'
     		ORDER BY nombreColorProducto ASC ";	
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

		function lista_color_relaciones($inicio=FALSE,$limite=FALSE)
		{
			
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.nombreColorProducto, count(t2.idColorProducto) as cantidad FROM colorProducto t1 
			INNER JOIN productos t2
			ON t1.idColorProducto = t2.idColorProducto
			GROUP BY t1.nombreColorProducto 
			ORDER BY cantidad DESC
			LIMIT $inicio,$limite";
			}else{
			$sql="SELECT t1.nombreColorProducto, count(t2.idColorProducto) as cantidad FROM colorProducto t1 
			INNER JOIN productos t2
			ON t1.idColorProducto = t2.idColorProducto
			GROUP BY t1.nombreColorProducto 
			ORDER BY cantidad DESC";
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

		function lista_modelos($valor,$inicio=FALSE,$limite=FALSE)
		{
			if ($inicio!==FALSE && $limite!==FALSE){
			$sql="SELECT *  FROM modeloproducto 
	      	WHERE nombreModeloProducto like '%".$valor."%'
			ORDER BY nombreModeloProducto ASC
			LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT *  FROM modeloproducto 
	      	WHERE nombreModeloProducto like '%".$valor."%'
			ORDER BY nombreModeloProducto ASC ";	
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

		function lista_modelos_relaciones($inicio=FALSE,$limite=FALSE)
		{
			if($inicio!==FALSE && $limite!==FALSE){
			$sql="SELECT t1.nombreModeloProducto, count(t2.idModeloProducto) as cantidad FROM modeloproducto t1 INNER JOIN productos t2 ON t1.idModeloProducto = t2.idModeloProducto 
			GROUP BY t1.nombreModeloProducto ORDER BY cantidad DESC
			LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.nombreModeloProducto, count(t2.idModeloProducto) as cantidad FROM modeloproducto t1 INNER JOIN productos t2 ON t1.idModeloProducto = t2.idModeloProducto 
			GROUP BY t1.nombreModeloProducto ORDER BY cantidad DESC ";	
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


		function lista_marcas($valor,$inicio=FALSE,$limite=FALSE)
		{
			if($inicio!==FALSE && $limite!==FALSE){
			$sql="SELECT *  FROM marcaproducto 
			WHERE nombreMarcaProducto like '%".$valor."%' LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT *  FROM marcaproducto 
			WHERE nombreMarcaProducto like '%".$valor."%' ";	
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

		function lista_marcas_relaciones($inicio=FALSE,$limite=FALSE)
		{
			if($inicio!==FALSE && $limite!==FALSE){
			$sql="SELECT t1.nombreMarcaProducto, count(t2.idMarcaProducto) as cantidad FROM marcaproducto t1 INNER JOIN productos t2 ON t1.idMarcaProducto = t2.idMarcaProducto GROUP BY t1.nombreMarcaProducto ORDER BY cantidad DESC
			LIMIT $inicio,$limite ";
			}else{
			$sql="SELECT t1.nombreMarcaProducto, count(t2.idMarcaProducto) as cantidad FROM marcaproducto t1 INNER JOIN productos t2 ON t1.idMarcaProducto = t2.idMarcaProducto GROUP BY t1.nombreMarcaProducto ORDER BY cantidad DESC ";	
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


		//viene de busqueda_productos.php
		function lista_productos_stock($valor,$inicio=FALSE,$limite=FALSE)
		{
			if ($inicio!==FALSE && $limite!==FALSE) {
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockGeneral,'0') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockgeneral t7 ON t1.idProducto = t7.idProducto

			WHERE t1.descripcionProducto like '%".$valor."%' or t1.codigoBarras like '%".$valor."%' 
			
			GROUP BY t1.idProducto
			ORDER BY t1.descripcionProducto 
			LIMIT $inicio,$limite
			";
			}
			else{
			$sql="SELECT t1.*, IFNULL(t2.nombreTelaProducto,''), IFNULL(t3.nombreTalleProducto,''),IFNULL (t4.nombreColorProducto,''), IFNULL(t5.nombreModeloProducto,''), IFNULL(t6.nombreMarcaProducto,''),IFNULL(t7.stockGeneral,'0') FROM productos t1 LEFT JOIN telaProducto t2 ON t1.idTelaProducto = t2.idTelaProducto LEFT JOIN talleProducto t3 ON t1.idTalleProducto = t3.idTalleProducto LEFT JOIN colorProducto t4 ON t1.idColorProducto = t4.idColorProducto LEFT JOIN modeloProducto t5 ON t1.idModeloProducto = t5.idModeloProducto LEFT JOIN marcaProducto t6 ON t1.idMarcaProducto = t6.idMarcaProducto LEFT JOIN stockgeneral t7 ON t1.idProducto = t7.idProducto
			WHERE t1.descripcionProducto like '%".$valor."%' or t1.codigoBarras like '%".$valor."%'  GROUP BY t1.idProducto ORDER BY t1.descripcionProducto";	

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

		//muestro el stock por sucursales en busqueda_productos.php tab1
		function lista_productos_stock_sucursales_1($valor1)
		{
			$sql="SELECT t1.idProducto, t2.idSucursal, t1.descripcionProducto,
					IFNULL(t3.nombreSucursal,'Sin Stock'), IFNULL(t3.direccionSucursal,'Sin Stock'),IFNULL(t2.stockProducto,'Sin Stock')
				    FROM productos t1
					LEFT JOIN stockProducto t2 ON t1.idProducto = t2.idProducto
					LEFT JOIN sucursal t3 ON t2.idSucursal = t3.idSucursal
			 		LEFT JOIN stockgeneral t4 ON t1.idProducto = t4.idProducto
				    WHERE t1.idProducto = $valor1 
				    ORDER BY t3.nombreSucursal ASC ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}
		function insertar_tela($idTelaProducto,$nombreTelaProducto,$descripcionTelaProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM telaproducto
				 WHERE nombreTelaProducto like '".$nombreTelaProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Tela Existente, ";


			}else{


			$sql="INSERT INTO telaProducto (nombreTelaProducto,descripcionTelaProducto) 
				VALUES('$nombreTelaProducto','$descripcionTelaProducto') ";
			
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

		function insertar_talle($idTalleProducto,$nombreTalleProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM talleproducto
				 WHERE nombreTalleProducto like '".$nombreTalleProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Talle Existente, ";


			}else{


			$sql="INSERT INTO talleproducto (nombreTalleProducto) 
				VALUES('$nombreTalleProducto') ";
			
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


		function insertar_modelo($idModeloProducto,$nombreModeloProducto,$descripcionModeloProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM modeloproducto
				 WHERE nombreModeloProducto like '".$nombreModeloProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Modelo Existente, ";


			}else{


			$sql="INSERT INTO modeloproducto (nombreModeloProducto,descripcionModeloProducto) 
				VALUES('$nombreModeloProducto','$descripcionModeloProducto') ";
			
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


		function insertar_color($idColorProducto,$nombreColorProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM colorproducto
				 WHERE nombreColorProducto like '".$nombreColorProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Color Existente, ";


			}else{


			$sql="INSERT INTO colorproducto (nombreColorProducto) 
				VALUES('$nombreColorProducto') ";
			
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

		function insertar_marca($idMarcaProducto,$nombreMarcaProducto,$descripcionMarcaProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM marcaproducto
				 WHERE nombreMarcaProducto like '".$nombreMarcaProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Marca Existente, ";


			}else{


			$sql="INSERT INTO marcaproducto (nombreMarcaProducto,descripcionMarcaProducto) 
				VALUES('$nombreMarcaProducto','$descripcionMarcaProducto') ";
			
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
			
			
		

		function insertar_producto($idProducto,$descripcionProducto,$idModeloProducto1,$idMarcaProducto1,$idTelaProducto1,
			$idTalleProducto1,$idColorProducto1,$precioCosto,$precioVenta,$codigoBarras,$observaciones)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM productos
				 WHERE codigoBarras like '".$codigoBarras."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Codigo de Barras Existente ";


			}else{


			$sql="INSERT INTO productos (descripcionProducto,idModeloProducto,idMarcaProducto,idTelaProducto,
				idTalleProducto,idColorProducto,precioCosto,precioVenta,codigoBarras,observaciones) 
				VALUES('$descripcionProducto','$idModeloProducto1','$idMarcaProducto1','$idTelaProducto1',
					'$idTalleProducto1','$idColorProducto1','$precioCosto','$precioVenta','$codigoBarras','$observaciones') ";
			
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


		function actualizar_tela($idTelaProducto,$nombreTelaProducto,$descripcionTelaProducto)
		{

			//valido que no exista el producto
			$sql="SELECT * FROM telaproducto
				 WHERE nombreTelaProducto like '".$nombreTelaProducto."' and descripcionTelaProducto like '".$descripcionTelaProducto."'";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Ya Existe este tipo de Tela, ";


			}else{

			$sql="UPDATE telaproducto SET nombreTelaProducto = '$nombreTelaProducto',descripcionTelaProducto = '$descripcionTelaProducto' WHERE idTelaProducto = '$idTelaProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		}
			$this->conexion->cerrar();
		}

		

		function actualizar_talle($idTalleProducto,$nombreTalleProducto)
		{

			//valido que no exista el producto
			$sql="SELECT * FROM talleproducto
				 WHERE nombreTalleProducto like '".$nombreTalleProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Ya Existe este talle, ";


			}else{

			$sql="UPDATE talleproducto SET nombreTalleProducto = '$nombreTalleProducto' WHERE idTalleProducto = '$idTalleProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			}
			$this->conexion->cerrar();
		}

		function actualizar_color($idColorProducto,$nombreColorProducto)
		{

			//valido que no exista el producto
			$sql="SELECT * FROM colorproducto
				 WHERE nombreColorProducto like '".$nombreColorProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Ya Existe este color de producto, ";


			}else{
			$sql="UPDATE colorproducto SET nombreColorProducto = '$nombreColorProducto' WHERE idColorProducto = '$idColorProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			}
			$this->conexion->cerrar();
		}

		function actualizar_modelo($idModeloProducto,$nombreModeloProducto,$descripcionModeloProducto)
		{

			//valido que no exista el producto
			$sql="SELECT * FROM modeloproducto
				 WHERE nombreModeloProducto like '".$nombreModeloProducto."' and descripcionModeloProducto like '".$descripcionModeloProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Ya existe este modelo de producto, " ;


			}else{
			$sql="UPDATE modeloproducto SET nombreModeloProducto = '$nombreModeloProducto', descripcionModeloProducto = '$descripcionModeloProducto' WHERE idModeloProducto = '$idModeloProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			}
			$this->conexion->cerrar();
		}

		function actualizar_marca($idMarcaProducto,$nombreMarcaProducto,$descripcionMarcaProducto)
		{

			//valido que no exista el producto
			$sql="SELECT * FROM marcaproducto
				 WHERE nombreMarcaProducto like '".$nombreMarcaProducto."' and descripcionMarcaProducto like '".$descripcionMarcaProducto."'";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			echo "Ya Existe esta marca, ";


			}else{

			$sql="UPDATE marcaproducto SET nombreMarcaProducto = '$nombreMarcaProducto',descripcionMarcaProducto = '$descripcionMarcaProducto' WHERE idMarcaProducto = '$idMarcaProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
		}
			$this->conexion->cerrar();
		}

		function actualizar_producto($idProducto,$descripcionProducto,$idModeloProducto1,$idMarcaProducto1,$idTelaProducto1,
			$idTalleProducto1,$idColorProducto1,$precioCosto,$precioVenta,$codigoBarras,$observaciones)
		{

			$sql="UPDATE productos SET descripcionProducto = '$descripcionProducto'
			,idModeloProducto='$idModeloProducto1'
			,idMarcaProducto='$idMarcaProducto1'
			,idTelaProducto='$idTelaProducto1'
			,idTalleProducto='$idTalleProducto1'
			,idColorProducto='$idColorProducto1'
			,precioCosto='$precioCosto'
			,precioVenta='$precioVenta'
			,codigoBarras='$codigoBarras'
			,observaciones='$observaciones'

			WHERE idProducto='$idProducto'";
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}

		function eliminar_tela($idTelaProducto){
			$sql="DELETE FROM telaproducto WHERE idTelaProducto='$idTelaProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}

		function eliminar_talle($idTalleProducto){
			$sql="DELETE FROM talleproducto WHERE idTalleProducto='$idTalleProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	

		function eliminar_color($idColorProducto){
			$sql="DELETE FROM colorproducto WHERE idColorProducto='$idColorProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	

		function eliminar_producto($idProducto){

			$sql="DELETE FROM stockproducto WHERE idProducto='$idProducto'";
			$this->conexion->conexion->query($sql);

			$sql="DELETE FROM stockgeneral WHERE idProducto='$idProducto'";
			$this->conexion->conexion->query($sql);

			$sql="DELETE FROM productos WHERE idProducto='$idProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	

		function eliminar_modelo($idModeloProducto){
			$sql="DELETE FROM modeloproducto WHERE idModeloProducto='$idModeloProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	

		function eliminar_marca($idMarcaProducto){
			$sql="DELETE FROM marcaproducto WHERE idMarcaProducto='$idMarcaProducto'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	


		function eliminar_color_confirma($idColorProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM productos
				 WHERE idColorProducto like '".$idColorProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

			
			
		}


		function eliminar_modelo_confirma($idModeloProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM productos
				 WHERE idModeloProducto like '".$idModeloProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

			
			
		}

		function eliminar_marca_confirma($idMarcaProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM productos
				 WHERE idMarcaProducto like '".$idMarcaProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

			
			
		}

		function eliminar_tela_confirma($idTelaProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM productos
				 WHERE idTelaProducto like '".$idTelaProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

			
		}

		function eliminar_talle_confirma($idTalleProducto)
		{
			
			//valido que no exista el producto
			$sql="SELECT * FROM productos
				 WHERE idTalleProducto like '".$idTalleProducto."' ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

			
		}

		function eliminar_producto_confirma($idProducto)
		{
			
			//valido que el producto no tenga stock
			$sql="SELECT t1.*, t2.stockGeneral FROM productos t1 INNER JOIN stockGeneral t2 ON t1.idProducto = t2.idProducto
				 WHERE t1.idProducto = '".$idProducto."'  ";
			
			
			
			$this->conexion->conexion->set_charset('SET NAMES utf8');
			$resultados=$this->conexion->conexion->query($sql);
			if ($re=$resultados->fetch_array(MYSQL_NUM) >= 1)  
			{  
			return true;

			}

			$this->conexion->cerrar();

			
		}

}


	
?>