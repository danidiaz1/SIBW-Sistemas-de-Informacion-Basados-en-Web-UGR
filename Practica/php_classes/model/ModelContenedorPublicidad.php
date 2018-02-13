<?php
include('ModelPublicidad.php');
include('ModelClickPublicidad.php');

/* Clase que se comunica con la base de datos para 
obtener/actualizar/insertar información de los anuncios y sus clicks*/

class ModelContenedorPublicidad extends ModelContenedor {
	
	public function __construct(){
		parent::__construct();
	}
	
	// Consulta y devuelve las últimas "$numero_publicidades" de la Base de Datos.
	// Se pueden devolver con la información asociada de sus clicks.
	public function recuperarPublicidades($numero_publicidades, $con_clicks = false){
		$publicidades = array();
		$clicks = array();
		
		$seleccion = $this->selectPublicidades($numero_publicidades);
		
		$resultado = $seleccion->get_result();
		
		while ($fila = $resultado->fetch_object()){
			$id = $fila->id_publicidad;
			
			if ($con_clicks)
				$clicks = obtenerClicks($id);
		
			$publicidad = new ModelPublicidad($id, $fila->imagen, $fila->url, $fila->titulo, $clicks, $fila->texto);
			
			$publicidades[$id] = $publicidad;
		}
		
		$seleccion->close();
		mysqli_free_result($resultado);
		
		return $publicidades;
	}
	
	// Consulta y devuelve una publicidad de la base de datos dado su id y, opcionalmente,
	// devolverla con información de sus clicks (filtrados por día y/u por hora)
	public function recuperarPublicidad($id_publicidad, $con_clicks = false, $fecha_clicks = null, $hora_clicks = null){
		$clicks = array();
		
		$seleccion = $this->selectPublicidad($id_publicidad);
		$resultado = $seleccion->get_result();
		$fila = $resultado->fetch_object();
			
		if ($con_clicks)
			$clicks = $this->obtenerClicks($id_publicidad, $fecha_clicks, $hora_clicks);
		
		$publicidad = new ModelPublicidad($id_publicidad, $fila->imagen, $fila->url, $fila->titulo, $clicks, $fila->texto);

		$seleccion->close();
		mysqli_free_result($resultado);
		
		return $publicidad;
	}
	
	// Consulta y devuelve la información relativa a los clicks de un anuncio de la BD.
	// Pueden devolverse con filtro de fecha y/u hora.
	public function obtenerClicks($id_publicidad, $fecha = null, $hora =  null){
		$seleccion = $this->selectClicks($id_publicidad, $fecha, $hora);
		$consulta = $seleccion->get_result();
		
		$clicks = array();
		
		while ($fila = $consulta->fetch_object()){
			$id = $fila->id_click;
			$click = new ModelClickPublicidad($id, $fila->id_publicidad, $fila->fecha, $fila->hora, $fila->ip);
			$clicks[$id] = $click;
		}
		
		$seleccion->close();
		mysqli_free_result($consulta);
		
		return $clicks;
	}
	
	public function eliminarPublicidades($ids_publicidades){
		$parametros = implode(',', array_fill(0, count($ids_publicidades), '?'));
		$tipos ='';
		
		foreach ($ids_publicidades as $id_publicidad)
			$tipos.='i';
			
		if ($delete = self::$conexion->prepare('DELETE FROM publicidad WHERE id_publicidad IN ('.$parametros.')')){
			$delete->bind_param($tipos, ...$ids_publicidades);
			
			$delete->execute();
			$delete->close();
		} else 
			var_dump(self::$conexion->error);
		

		return $delete;
	}
	
	public function insertarPublicidad($imagen, $texto, $enlace, $titulo){
		$exito = false;

		if ($insert = self::$conexion->prepare('INSERT INTO publicidad (imagen, texto, url, titulo) VALUES (?,?,?,?)'))
		{
			$insert->bind_param('ssss', $imagen, $texto, $enlace, $titulo);

			if ($insert->execute())
				$exito = true;
			
			$insert->close();	
		} else
				var_dump(self::$conexion->error);

		return $exito;
	}
	
	public function insertarClick($id_publicidad, $ip){
		$exito = false;

		if ($insert = self::$conexion->prepare('INSERT INTO click_publicidad (id_publicidad, ip) VALUES (?,?)'))
		{
			$insert->bind_param('is', $id_publicidad, $ip);

			if ($insert->execute())
				$exito = true;
			
			$insert->close();	
		} else
				var_dump(self::$conexion->error);

		return $exito;
	}
	
	public function modificarPublicidad($id_publicidad, $imagen, $texto, $enlace, $titulo){
		
		if ($imagen == ''){
			if ($update = self::$conexion->prepare('UPDATE publicidad SET texto=?, url=?, titulo=? WHERE id_publicidad=?')){
				$update->bind_param('sssi', $texto, $enlace, $titulo, $id_publicidad);
				
				$update->execute();
				$update->close();
			} else 
				var_dump(self::$conexion->error);
		} else {
			if ($update = self::$conexion->prepare('UPDATE publicidad SET imagen=?, texto=?, url=?, titulo=? WHERE id_publicidad=?')){
			$update->bind_param('ssssi', $imagen, $texto, $enlace, $titulo, $id_publicidad);
			
			$update->execute();
			$update->close();
		} else 
			var_dump(self::$conexion->error);
		}
		

		return $update;
	}
	
	// Construye el prepared statement sql para recuperar publicidades de la base de datos
	private function selectPublicidades($numero_publicidades){
		$seleccion = self::$conexion->prepare('SELECT * FROM publicidad ORDER BY id_publicidad DESC LIMIT ?');
		$seleccion->bind_param('i',$numero_publicidades);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement sql para recuperar una publicidad de la base de datos
	private function selectPublicidad($id_publicidad){
		$seleccion = self::$conexion->prepare('SELECT * FROM publicidad WHERE id_publicidad = ?');
		$seleccion->bind_param('i',$id_publicidad);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement sql para recuperar los clicks de una publicidad de la base de datos
	private function selectClicks($id_publicidad, $fecha = null, $hora =  null){
		
		if ($fecha == null && $hora == null){
			$seleccion = self::$conexion->prepare('SELECT id_click, id_publicidad, ip, DATE(fecha) as fecha, TIME(fecha) as hora 
				FROM click_publicidad WHERE id_publicidad = ?');
			$seleccion->bind_param('i',$id_publicidad);
		}
		else if ($fecha != null){
			$seleccion = self::$conexion->prepare('SELECT id_click, id_publicidad, ip, DATE(fecha) as fecha, TIME(fecha) as hora 
				FROM click_publicidad WHERE id_publicidad = ? AND DATE(fecha) = ?');
			$seleccion->bind_param('is',$id_publicidad,$fecha);
		} 
		else if ($fecha != null && $hora != null) {
			$seleccion = self::$conexion->prepare('SELECT id_click, id_publicidad, ip, DATE(fecha) as fecha, TIME(fecha) as hora 
													FROM click_publicidad WHERE id_publicidad = ? AND DATE(fecha) = ? AND TIME(fecha) = ?');
			$seleccion->bind_param('iss',$id_publicidad, $fecha, $hora);
		}
		
		$seleccion->execute();
		return $seleccion;
	}
}
?>