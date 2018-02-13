<?php
include('ModelUsuario.php');
/* Clase que se comunica con la base de datos para 
obtener/actualizar/insertar información de los
usuarios */

class ModelContenedorUsuarios extends ModelContenedor {
	
	public function __construct(){
		parent::__construct();
	}
	
	// Inserta un nuevo usuario en la base de datos, si no existe.
	public function insertarUsuario($correo, $nickname, $pass){
		$exito = false;

		$insert = self::$conexion->prepare('INSERT INTO usuario_registrado (correo_electronico, nickname, password) VALUES (?, ?, ?)');
		$insert->bind_param('sss',$correo,$nickname,$pass);
		
		// Si se puede insertar el usuario, es que no existe un usuario con
		// ese correo electrónico (la clave primaria de la tabla)
		if ($insert->execute())
			$exito = true;
		
		$insert->close();
		
		return $exito;
	}
	
	// Obtiene un usuario de la BD dado su usuario y contraseña.
	// La contraseña debe pasarse encriptada en SHA512, que es como está
	// almacenada en la BD. Si esta consulta no devuelve nada,
	// es que el usuario no está registrado o la contraseña es incorrecta.
	public function identificarUsuario($correo, $pass)
	{
		$usuario = null;
		
		$seleccion = self::$conexion->prepare('SELECT * FROM usuario_registrado WHERE correo_electronico = ? AND password = ?');

		$seleccion->bind_param('ss',$correo,$pass);
		$seleccion->execute();
		
		$resultado = $seleccion->get_result();
		
		if ($resultado->num_rows == 1){
			$fila = $resultado->fetch_object();
			
			$usuario = new ModelUsuario($fila->correo_electronico, $fila->nickname, $fila->tipo);
		}

		$seleccion->close();
		
		mysqli_free_result($resultado);
		
		return $usuario;
	}
}
?>