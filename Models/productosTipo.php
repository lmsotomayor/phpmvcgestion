<?php 
	class productosTipo
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}

		function lista_productos_tipo($valor)
		{
			
			$sql="SELECT * FROM tipo_productos
				 WHERE nombreTipo like '%".$valor."%' ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}

		function insertar($idCliente,$cuitCliente,$razonSocialCliente,$nombreCliente,$domicilioCliente,$provincia,$localidad,$contactoCliente,$telefonoFijoCliente,$celularCliente,$mailCliente,$estadoCliente)
		{
			
			$sql="INSERT INTO clientes (cuitCliente,razonSocialCliente,nombreCliente,domicilioCliente,provincia,localidad,
				contactoCliente,telefonoFijoCliente,celularCliente,mailCliente,estadoCliente) VALUES('$cuitCliente',
				'$razonSocialCliente','$nombreCliente','$domicilioCliente','$provincia','$localidad','$contactoCliente',
				'$telefonoFijoCliente','$celularCliente','$mailCliente','$estadoCliente') ";
			
				if($this->conexion->conexion->query($sql)){
				return true;
			}
			else
			{
				return false;
			}

			$this->conexion->cerrar();

			
		}


		function actualizar($idCliente,$cuitCliente,$razonSocialCliente,$nombreCliente,$domicilioCliente,$provincia,$localidad,$contactoCliente,$telefonoFijoCliente,$celularCliente,$mailCliente,$estadoCliente)
		{
			$sql="UPDATE clientes SET cuitCliente = '$cuitCliente',razonSocialCliente='$razonSocialCliente',nombreCliente='$nombreCliente',domicilioCliente='$domicilioCliente',provincia='$provincia', localidad='$localidad',contactoCliente='$contactoCliente',telefonoFijoCliente='$telefonoFijoCliente',celularCliente='$celularCliente',mailCliente='$mailCliente',estadoCliente='$estadoCliente' WHERE idCliente='$idCliente'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}

		function eliminar($idCliente){
			$sql="DELETE FROM clientes WHERE idCliente='$idCliente'";
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