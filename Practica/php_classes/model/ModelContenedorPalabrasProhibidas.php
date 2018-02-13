<?php

/* Clase que se comunica con la base de datos para 
obtener/actualizar/insertar información de las palabras prohibidas
de los comentarios */
class ModelContenedorPalabrasProhibidas extends ModelContenedor {
	
	public function __construct(){
		parent::__construct();
	}
	
	// Consulta las palabras prohibidas de la BD 
	// y devuelve un string con la expresión regular
	// formada por las mismas
	public function recuperarPalabrasProhibidas(){

		$palabras_prohibidas = '/\b(';
		
		$seleccion = $this->selectPalabras();
		$resultado = $seleccion->get_result();

		while ($fila = $resultado->fetch_object()){
			$palabra = $fila->palabra;
			$palabras_prohibidas .= $palabra;
			$palabras_prohibidas .= '|';
		}
		
		$seleccion->close();
		mysqli_free_result($resultado);
		$palabras_prohibidas .= ')\b/g';
		
		return $palabras_prohibidas;
	}
	
	// Construye el prepared statement para recuperar las palabras prohibidas de la base de datos
	private function selectPalabras(){
		$seleccion = self::$conexion->prepare('SELECT palabra FROM palabras_prohibidas');
		$seleccion->execute();
		return $seleccion; 

	}
}
?>