<?php
include('ModelSeccion.php');
include('ModelSubseccion.php');

/* Clase que se comunica con la base de datos para 
obtener/actualizar/insertar información de las
secciones */

class ModelContenedorSecciones extends ModelContenedor {

	public function __construct(){
		parent::__construct();
	}
	
	// Recupera y devuelve las secciones del menú de la base de datos
	public function recuperarSecciones(){
		$secciones = array();
		
		$seleccion = $this->selectSecciones();
		$resultado = $seleccion->get_result();

		while ($fila = $resultado->fetch_object()){
			$id_seccion = $fila->id_seccion;
			
			$subsecciones = $this->recuperarSubsecciones($id_seccion);
			
			$seccion = new ModelSeccion($id_seccion, $fila->nombre, $subsecciones);
				
			$secciones[$id_seccion] = $seccion;
		}
		
		$seleccion->close();
		mysqli_free_result($resultado);
	
		return $secciones;
	}
	
	public function recuperarSubsecciones($id_seccion){
		$subsecciones = array();
		$selectSubsecciones = $this->selectSubsecciones($id_seccion);
		$resultado2 = $selectSubsecciones->get_result();

		while ($fila2 = $resultado2->fetch_object()){
			$subseccion = new ModelSubseccion($id_seccion, $fila2->id_subseccion, $fila2->nombre);
			array_push($subsecciones,$subseccion);
		}
			
		return $subsecciones;
	}
	
	// Recupera y devuelve la sección del menú de la base de datos
	public function recuperarSeccion($id_seccion){
		
		$seleccion = $this->selectSeccion($id_seccion);
		$resultado = $seleccion->get_result();

		$fila = $resultado->fetch_object();
			
		$subsecciones = array();
		$selectSubsecciones = $this->selectSubsecciones($id_seccion);
		$resultado2 = $selectSubsecciones->get_result();

		while ($fila2 = $resultado2->fetch_object()){
			$subseccion = new ModelSubseccion($id_seccion, $fila2->id_subseccion, $fila2->nombre);
			array_push($subsecciones,$subseccion);
		}

		$seccion = new ModelSeccion($id_seccion, $fila->nombre, $subsecciones);
				
		$seleccion->close();
		mysqli_free_result($resultado);
	
		return $seccion;
	}
	
	public function eliminarSecciones($ids_secciones){
		$parametros = implode(',', array_fill(0, count($ids_secciones), '?'));
		$tipos ='';
		
		foreach ($ids_secciones as $id_seccion)
			$tipos.='i';
			
		if ($delete = self::$conexion->prepare('DELETE FROM seccion WHERE id_seccion IN ('.$parametros.')')){
			$delete->bind_param($tipos, ...$ids_secciones);
			
			$delete->execute();
			$delete->close();
		} else 
			var_dump(self::$conexion->error);
		

		return $delete;
	}
	
	public function insertarSeccion($nombre){
		$exito = false;

		if ($insert = self::$conexion->prepare('INSERT INTO seccion (nombre) VALUES (?)'))
		{
			$insert->bind_param('s', $nombre);

			if ($insert->execute())
				$exito = true;
			
			$insert->close();	
		} else
				var_dump(self::$conexion->error);

		return $exito;
	}
	
	public function modificarSeccion($id_seccion, $nombre){
		
		if ($update = self::$conexion->prepare('UPDATE seccion SET nombre=? WHERE id_seccion=?')){
			$update->bind_param('si', $nombre, $id_seccion);
			
			$update->execute();
			$update->close();
		} else 
			var_dump(self::$conexion->error);

		return $update;
	}
	
	public function eliminarSubsecciones($ids_subsecciones){
		$parametros = implode(',', array_fill(0, count($ids_subsecciones), '?'));
		$tipos ='';
		
		foreach ($ids_subsecciones as $id_subseccion)
			$tipos.='i';
			
		if ($delete = self::$conexion->prepare('DELETE FROM subseccion WHERE id_subseccion IN ('.$parametros.')')){
			$delete->bind_param($tipos, ...$ids_subsecciones);
			
			$delete->execute();
			$delete->close();
		} else 
			var_dump(self::$conexion->error);
		

		return $delete;
	}
	
	public function insertarSubseccion($id_seccion, $nombre){
		$exito = false;

		if ($insert = self::$conexion->prepare('INSERT INTO subseccion (id_seccion,nombre) VALUES (?,?)'))
		{
			$insert->bind_param('is', $id_seccion, $nombre);

			if ($insert->execute())
				$exito = true;
			
			$insert->close();	
		} else
				var_dump(self::$conexion->error);

		return $exito;
	}
	
	public function modificarSubseccion($id_subseccion, $nombre){
		
		if ($update = self::$conexion->prepare('UPDATE subseccion SET nombre=? WHERE id_subseccion=?')){
			$update->bind_param('si', $nombre, $id_subseccion);
			
			$update->execute();
			$update->close();
		} else 
			var_dump(self::$conexion->error);

		return $update;
	}
	
	// Método para obtener la sección de la BD de la noticia identificada por "$id_noticia"
	// y devolverlos en un array
	public function obtenerSeccionNoticia($id_noticia){
		$seleccion = $this->selectSeccionNoticia($id_noticia);
		$consulta = $seleccion->get_result();
		
		$fila = $consulta->fetch_object();
		$subsecciones = $this->recuperarSubsecciones($fila->id_seccion);
		
		$seccion = new ModelSeccion($fila->id_seccion, $fila->nombre, $subsecciones);

		$seleccion->close();
		mysqli_free_result($consulta);
		
		return $seccion;
	}
	
	// Método para obtener la subsección de la BD de la noticia identificada por "$id_noticia"
	// y devolverlos en un array
	public function obtenerSubseccionNoticia($id_noticia){
		$seleccion = $this->selectSubseccionNoticia($id_noticia);
		$consulta = $seleccion->get_result();
		
		// Procesamos las imagenes y las metemos en el array
		$fila = $consulta->fetch_object();
		$subseccion = new ModelSubseccion($fila->id_subseccion, $fila->id_seccion, $fila->nombre);

		$seleccion->close();
		mysqli_free_result($consulta);
		
		return $subseccion;
	}
	
	// Construye el prepared statement para recuperar las secciones de la base de datos
	private function selectSecciones(){
		$seleccion = self::$conexion->prepare('SELECT * FROM seccion');
		$seleccion->execute();
		return $seleccion;
	}
	
	// Construye el prepared statement para recuperar una seccion de la base de datos
	private function selectSeccion($id_seccion){
		if ($seleccion = self::$conexion->prepare('SELECT * FROM seccion WHERE id_seccion = ?')){
			$seleccion->bind_param('i',$id_seccion);
			
			$seleccion->execute();
		} else 
			var_dump(self::$conexion->error);
		
		$seleccion->execute();
		return $seleccion;
	}
	
	// Construye el prepared statement para recuperar las subsecciones de una seccion de la base de datos
	private function selectSubsecciones($id_seccion){
		$seleccion = self::$conexion->prepare('SELECT * FROM subseccion WHERE id_seccion = ?');
		$seleccion->bind_param('i',$id_seccion);
		$seleccion->execute();
		return $seleccion;
	}
	
	// Construye el prepared statement para recuperar la seccion de una noticia de la base de datos
	private function selectSeccionNoticia($id_noticia){
		$seleccion = self::$conexion->prepare('SELECT * FROM seccion WHERE id_seccion = (SELECT id_seccion FROM noticia WHERE id_noticia = ? )');
		$seleccion->bind_param('i',$id_noticia);
		$seleccion->execute();
		return $seleccion;
	}
	
	// Construye el prepared statement para recuperar la subseccion de una noticia de la base de datos
	private function selectSubseccionNoticia($id_noticia){
		$seleccion = self::$conexion->prepare('SELECT * FROM subseccion WHERE id_subseccion = (SELECT id_subseccion FROM noticia WHERE id_noticia = ? )');
		$seleccion->bind_param('i',$id_noticia);
		$seleccion->execute();
		return $seleccion;
	}
}
?>