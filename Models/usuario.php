<?php 
	class usuario
	{
		private $conexion;
		public function __construct()
		{
			require_once('conexion.php');
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}

		function identificar($nombreUsuario,$password,$rol)
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
		
		function registrar($nombreUsuario,$password,$rol){
			
			$sql="INSERT INTO usuarios VALUES(0,'$nombreUsuario','$password','$rol')";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else
			{
				return false;
			}
			$this->conexion->cerrar();
		}


		function verUsuario()
		{
			
			$sql="SELECT * FROM usuarios ";
			
			$this->conexion->conexion->set_charset('utf8');
			$resultados=$this->conexion->conexion->query($sql);
			$arreglo = array();
			while ($re=$resultados->fetch_array(MYSQL_NUM)) {
				$arreglo[]=$re;
			}
			return $arreglo;
			$this->conexion->cerrar();

		}


		function eliminar_usuario($idUsuario){
			$sql="DELETE FROM usuarios WHERE idUsuario='$idUsuario'";
			if($this->conexion->conexion->query($sql)){
				return true;
			}
			else{
				return false;
			}
			$this->conexion->cerrar();
		}	
		
		function actualizar_usuario($idUsuario,$nombreUsuario,$pass,$rol)
		{

			$sql="UPDATE usuarios SET idUsuario = '$idUsuario',nombreUsuario = '$nombreUsuario',passUsuario = '$pass',rolUsuario = '$rol' WHERE idUsuario = '$idUsuario'";
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