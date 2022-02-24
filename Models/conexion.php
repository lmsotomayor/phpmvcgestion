<?php

	class conexion
	{
		private $servidor;
		private $usuario;
		private $contraseña;
		private $basedatos;
		public  $conexion;

		public function __construct(){
			$this->servidor   = "localhost";
			$this->usuario	  = "root";
			$this->contraseña = "Ramses2005*";
			$this->basedatos  = "pantalon";

		}

		function conectar(){
			$this->conexion= new mysqli($this->servidor,$this->usuario,$this->contraseña,$this->basedatos);
			
				

		}

		function cerrar(){
			$this->conexion->close();
		}



	}

?>