<?php

// Superclase padre de todos los contenedores.
// Tiene como atributo estático una conexión, ya que será la misma
// para todos los contenedores.
class ModelContenedor {

	protected static $conexion;
	
	public function __construct(){}
	
	public static function conectar($nombreServidor, $usuario, $password, $BD){
		
		self::$conexion = mysqli_connect($nombreServidor, $usuario, $password, $BD);
		
		if (!self::$conexion) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			echo ". errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			echo ". error de depuración: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
		mysqli_set_charset(self::$conexion,'utf8');
	}
	
	public static function cerrarConexion(){
		mysqli_close(self::$conexion);
	}
}
?>