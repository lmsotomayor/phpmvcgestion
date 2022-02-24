<?php
	
		require_once('../Models/usuario.php');


		$boton=$_POST['boton'];

		switch ($boton) {
			case 'cerrar':
			
					session_start();
					session_destroy();
					
				break;
			case 'ingresar':
					$email = $_POST['nombreUsuario'];
					$password = $_POST['password'];
					$rol =  $_POST['rol'];
					

					$ins = new usuario();
					$array=$ins->identificar($email,$password,$rol);
					if ($array[0]==0) 
					{
						echo '0';
					}
					else
					{
						session_start();
						$_SESSION['ingreso']='YES';
						$_SESSION['rol'] = $array["rol"];
						$_SESSION['nombre']=$array[1];

					}
				break;
			case 'registrar':
					
					$nombreUsuario = $_POST['nombreUsuario'];
					$password = $_POST['password'];
					$rol = $_POST['rol'];

					if($nombreUsuario<>"administrador" and $rol=="Administrador"){
						echo "El nombre de usuario tiene que ser administrador, respetando minusculas";
					}else{


					$instancia = new usuario();
					if($instancia->registrar($nombreUsuario,$password,$rol))
					{
						echo "exito";
					}
					else{
						echo "No se registro";
					}
				}
				break;

			case 'ver':
					$inst = new usuario();
					$r=$inst ->verUsuario();
					
					echo json_encode($r);
				break;

			case 'eliminar_usuario':
					$idUsuario=$_POST['idUsuario'];
					$inst = new usuario();
					if($inst->eliminar_usuario($idUsuario)){
						echo 'Se elimino correctamente';
					}
					else{
						echo "No se eliminar los datos";
					}
				break;	

			default:

			case 'actualizar_usuario':
					
					$inst = new usuario();

					$idUsuario=$_POST['idUsuario'];
					$nombreUsuario=$_POST['nombreUsuario'];
					$pass=$_POST['pass'];
					$rol=$_POST['rol'];


					if($inst->actualizar_usuario($idUsuario,$nombreUsuario,$pass,$rol)){
							echo 'exitoActualizarUsuarios';
						}
						else{
							echo "No se Actualizo el usuario";
						}
				break;		
				
				break;
		}

		
?>