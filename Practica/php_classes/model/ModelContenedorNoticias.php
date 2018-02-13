<?php
include('ModelContenedor.php');
include('ModelNoticia.php');
include('ModelComentario.php');
include('ModelImagen.php');
include('php_utilities/transformarFecha.php');

/* Clase que se comunica con la base de datos para 
obtener/actualizar/insertar información de las noticias,
sus imagenes, sus comentarios y sus noticias relacionadas */
class ModelContenedorNoticias extends ModelContenedor {
	
	private $contenedor_secciones;
	public function __construct(){
		parent::__construct();
		$this->contenedor_secciones = new ModelContenedorSecciones();
	}
	
	// Devuelve un array de noticias, recuperando las últimas "$numero_noticias" de la BD.
	// Se pueden recuperar con o sin comentarios y noticias relacionadas.
	public function recuperarUltimasNoticias($numero_noticias = 50, $con_comentarios = false, 
		$con_noticias_relacionadas = false, $numero_noticias_relacionadas = 3)
	{
		$noticias = array();
		$comentarios = array();
		$noticias_relacionadas = array();
		
		$seleccion = $this->selectNoticias($numero_noticias);
		$resultado = $seleccion->get_result();
		
		while ($fila = $resultado->fetch_object()){
			$id_noticia = $fila->id_noticia;
			
			$comentarios = null;
			if ($con_comentarios)
				$comentarios = $this->obtenerComentarios($id_noticia);
			
			if ($con_noticias_relacionadas)
				$noticias_relacionadas = $this->obtenerNoticiasRelacionadas($id_noticia, $numero_noticias_relacionadas);
			
			$imagenes = $this->obtenerImagenes($id_noticia);
			$seccion = $this->contenedor_secciones->obtenerSeccionNoticia($id_noticia);
			$subseccion = $this->contenedor_secciones->obtenerSubseccionNoticia($id_noticia);
			
			// Creamos la noticia, con los datos de ella misma, con sus imagenes, sus comentarios y sus noticias relacionadas
			$noticia = new ModelNoticia($id_noticia, $fila->autor, $fila->titular, $fila->subtitulo, 
				$seccion, $subseccion, $fila->fecha_pub, $fila->hora_pub, $fila->entradilla, $imagenes, $fila->cuerpo, 
				$fila->fecha_mod, $fila->hora_mod, $fila->video, $comentarios, $noticias_relacionadas, $fila->estado);
			
			$noticias[$id_noticia] = $noticia;
		}
		
		$seleccion->close();
		mysqli_free_result($resultado);
		
		return $noticias;	
	}
	
	public function recuperarUltimasNoticiasPorSeccion($id_seccion, $numero_noticias = 50, $con_comentarios = false, 
		$con_noticias_relacionadas = false, $numero_noticias_relacionadas = 3){
		$noticias = array();
		$comentarios = array();
		$noticias_relacionadas = array();
		
		$seleccion = $this->selectNoticiasPorSeccion($id_seccion, $numero_noticias);
		$resultado = $seleccion->get_result();
		
		while ($fila = $resultado->fetch_object()){
			$id_noticia = $fila->id_noticia;
			
			$comentarios = null;
			if ($con_comentarios)
				$comentarios = $this->obtenerComentarios($id_noticia);
			
			if ($con_noticias_relacionadas)
				$noticias_relacionadas = $this->obtenerNoticiasRelacionadas($id_noticia, $numero_noticias_relacionadas);
			
			$imagenes = $this->obtenerImagenes($id_noticia);
			$seccion = $this->contenedor_secciones->obtenerSeccionNoticia($id_noticia);
			$subseccion = $this->contenedor_secciones->obtenerSubseccionNoticia($id_noticia);
			
			// Creamos la noticia, con los datos de ella misma, con sus imagenes, sus comentarios y sus noticias relacionadas
			$noticia = new ModelNoticia($id_noticia, $fila->autor, $fila->titular, $fila->subtitulo, 
				$seccion, $subseccion, $fila->fecha_pub, $fila->hora_pub, $fila->entradilla, $imagenes, $fila->cuerpo, 
				$fila->fecha_mod, $fila->hora_mod, $fila->video, $comentarios, $noticias_relacionadas, $fila->estado);
				
			$noticias[$id_noticia] = $noticia;
		}
		
		$seleccion->close();
		mysqli_free_result($resultado);
		
		return $noticias;
		
	}
		
	public function recuperarUltimasNoticiasPorSubseccion($id_subseccion, $numero_noticias = 50, $con_comentarios = false, 
		$con_noticias_relacionadas = false, $numero_noticias_relacionadas = 3){
		
		$noticias = array();
		$comentarios = array();
		$noticias_relacionadas = array();
		
		$seleccion = $this->selectNoticiasPorSubseccion($id_subseccion, $numero_noticias);
		$resultado = $seleccion->get_result();
		
		while ($fila = $resultado->fetch_object()){
			$id_noticia = $fila->id_noticia;
			
			$comentarios = null;
			if ($con_comentarios)
				$comentarios = $this->obtenerComentarios($id_noticia);
			
			if ($con_noticias_relacionadas)
				$noticias_relacionadas = $this->obtenerNoticiasRelacionadas($id_noticia, $numero_noticias_relacionadas);
			
			$imagenes = $this->obtenerImagenes($id_noticia);
			$seccion = $this->contenedor_secciones->obtenerSeccionNoticia($id_noticia);
			$subseccion = $this->contenedor_secciones->obtenerSubseccionNoticia($id_noticia);
			
			// Creamos la noticia, con los datos de ella misma, con sus imagenes, sus comentarios y sus noticias relacionadas
			$noticia = new ModelNoticia($id_noticia, $fila->autor, $fila->titular, $fila->subtitulo, 
				$seccion, $subseccion, $fila->fecha_pub, $fila->hora_pub, $fila->entradilla, $imagenes, $fila->cuerpo, 
				$fila->fecha_mod, $fila->hora_mod, $fila->video, $comentarios, $noticias_relacionadas, $fila->estado);
				
			$noticias[$id_noticia] = $noticia;
		}
		
		$seleccion->close();
		mysqli_free_result($resultado);
		
		return $noticias;
	}
	
	
	public function cambiarEstado($ids_noticia,$estado){
		$parametros = implode(',', array_fill(0, count($ids_noticia), '?'));
		$tipos ='s';
		
		foreach ($ids_noticia as $id_noticia)
			$tipos.='i';
			
		if ($update = self::$conexion->prepare('UPDATE noticia SET estado=? WHERE id_noticia IN ('.$parametros.')')){
			$update->bind_param($tipos, $estado, ...$ids_noticia);
			
			$update->execute();
			$update->close();
		} else 
			var_dump(self::$conexion->error);

		return $update;
	}
	
	// Consulta una noticia concreta de la base de datos y la devuelve.
	public function recuperarNoticia($id_noticia, $con_comentarios = true, 
		$con_noticias_relacionadas = true, $numero_noticias_relacionadas = 3)
	{
		$comentarios = array();
		$noticias_relacionadas = array();
		
		$seleccion = $this->selectNoticia($id_noticia);
		$resultado = $seleccion->get_result();
		$fila = $resultado->fetch_object();
		
		$id = $fila->id_noticia;
		
		if ($con_comentarios)
			$comentarios = $this->obtenerComentarios($id);
		
		if ($con_noticias_relacionadas)
				$noticias_relacionadas = $this->obtenerNoticiasRelacionadas($id_noticia, $numero_noticias_relacionadas);
			
		$imagenes = $this->obtenerImagenes($id);
		$seccion = $this->contenedor_secciones->obtenerSeccionNoticia($id);
		$subseccion = $this->contenedor_secciones->obtenerSubseccionNoticia($id);
		
		// Creamos la noticia, con los datos de ella misma, con sus imagenes y con sus comentarios
		$noticia = new ModelNoticia($id, $fila->autor, $fila->titular, $fila->subtitulo, 
			$seccion, $subseccion, $fila->fecha_pub, $fila->hora_pub, $fila->entradilla, $imagenes, $fila->cuerpo, 
			$fila->fecha_mod, $fila->hora_mod, $fila->video, $comentarios, $noticias_relacionadas, $fila->estado);
		
		$seleccion->close();
		mysqli_free_result($resultado);
		
		return $noticia;
	}
	
	// Inserta una noticia en la base de datos
	public function insertarNoticia($autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla, $cuerpo, $video, $urls_imagenes, $pies_imagenes){
		$id_noticia = 0;
		// Noticia
		if ($insert = self::$conexion->prepare('INSERT INTO noticia (autor, titular, subtitulo, id_seccion, id_subseccion,
			entradilla, cuerpo, video) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'))
		{
			$insert->bind_param('sssiisss', $autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla, $cuerpo, $video);

			if ($insert->execute())
				$id_noticia = self::$conexion->insert_id;
			
			$insert->close();	
		} else
			var_dump(self::$conexion->error);
		
		// Imagenes
		$delimitador = ';;';
		$pies = explode($delimitador, $pies_imagenes);
		
		if ($insert = self::$conexion->prepare('INSERT INTO imagenes (id_noticia, url, pie) VALUES (?, ?, ?)'))
		{
			$i = 0;
			foreach ($urls_imagenes as $url_imagen){
				$insert->bind_param('iss', $id_noticia, $url_imagen, $pies[$i]);
				$insert->execute();
				$i++;
			}
			
			$insert->close();	
		} else
			var_dump(self::$conexion->error);
	}
	
	// Elimina una noticia de la base de datos
	public function eliminarNoticias($ids_noticia){
		$parametros = implode(',', array_fill(0, count($ids_noticia), '?'));
		$tipos ='';
		
		foreach ($ids_noticia as $id_noticia)
			$tipos.='i';
			
		if ($delete = self::$conexion->prepare('DELETE FROM noticia WHERE id_noticia IN ('.$parametros.')')){
			$delete->bind_param($tipos, ...$ids_noticia);
			
			$delete->execute();
			$delete->close();
		} else 
			var_dump(self::$conexion->error);
		

		return $delete;
	}
	
	public function modificarNoticia($id_noticia, $autor, $titular, $subtitulo, $id_seccion, 
		$id_subseccion, $entradilla, $cuerpo, $nuevo_video)
	{
		if ($nuevo_video == ''){
			if ($update = self::$conexion->prepare('UPDATE noticia SET autor=?, titular=?, subtitulo=?, id_seccion=?,
				id_subseccion=?, entradilla=?, cuerpo=?, fecha_modificacion = NOW() WHERE id_noticia=?'))
			{
				$update->bind_param('sssiissi', $autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla, $cuerpo, $id_noticia);
				
				$update->execute();
				$update->close();
			} else 
				var_dump(self::$conexion->error);
		} else {
			if ($update = self::$conexion->prepare('UPDATE noticia SET autor=?, titular=?, subtitulo=?, id_seccion=?,
				id_subseccion=?, entradilla=?, cuerpo=?, fecha_modificacion = NOW(), video=? WHERE id_noticia=?'))
			{
				$update->bind_param('sssiisssi', $autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla, $cuerpo, $nuevo_video, $id_noticia);
				
				$update->execute();
				$update->close();
			} else 
				var_dump(self::$conexion->error);
		}
		

		return $update;
	}
	
	// Inserta un nuevo comentario en la base de datos.
	public function insertarComentario($id_noticia, $nombre, $correo, $texto, $ip, $fecha = '', $hora = ''){
		$exito = false;
		if ($fecha != '' && $hora != ''){
			$fecha_hora = $fecha.' '.$hora;
			if ($insert = self::$conexion->prepare('INSERT INTO comentario (id_noticia, ip, nombre, 
				correo, texto, fecha_hora) VALUES (?, ?, ?, ?, ?, ?)'))
			{
				$insert->bind_param('isssss', $id_noticia, $ip, $nombre, $correo, $texto, $fecha_hora);

				if ($insert->execute())
					$exito = true;
				
				$insert->close();	
			} else
				var_dump(self::$conexion->error);
		} else {
			if ($insert = self::$conexion->prepare('INSERT INTO comentario (id_noticia, ip, nombre, 
				correo, texto) VALUES (?, ?, ?, ?, ?)'))
			{
				$insert->bind_param('issss', $id_noticia, $ip, $nombre, $correo, $texto);

				if ($insert->execute())
					$exito = true;
				
				$insert->close();	
			} else
				var_dump(self::$conexion->error);
		}

		return $exito;
	}
	
	
	// Elimina comentarios de una noticia
	public function eliminarComentarios($ids_comentario){
		$parametros = implode(',', array_fill(0, count($ids_comentario), '?'));
		$tipos ='';
		
		foreach ($ids_comentario as $id_comentario)
			$tipos.='i';
			
		if ($delete = self::$conexion->prepare('DELETE FROM comentario WHERE id_comentario IN ('.$parametros.')')){
			$delete->bind_param($tipos, ...$ids_comentario);
			
			$delete->execute();
			$delete->close();
		} else 
			var_dump(self::$conexion->error);
		

		return $delete;
	}
	
	// Modifica el comentario de una noticia
	public function modificarComentario($id_comentario, $nombre, $correo, $texto, $fecha, $hora){
		$fecha_hora = $fecha.' '.$hora;
		
		if ($update = self::$conexion->prepare('UPDATE comentario SET nombre=?, correo=?, texto=?, fecha_hora=? WHERE id_comentario=?')){
			$update->bind_param('ssssi', $nombre, $correo, $texto, $fecha_hora, $id_comentario);
			
			$update->execute();
			$update->close();
		} else 
			var_dump(self::$conexion->error);

		return $update;
	}
	
	// Construye el prepared statement para recuperar noticias de la base de datos
	private function selectNoticias($numero_noticias){
		$seleccion = self::$conexion->prepare('SELECT id_noticia, autor, titular, subtitulo, entradilla, 
		cuerpo, video, DATE(fecha_publicacion) as fecha_pub,
		DATE(fecha_modificacion) as fecha_mod, TIME(fecha_publicacion) as hora_pub, 
		TIME(fecha_modificacion) as hora_mod, estado FROM noticia ORDER BY id_noticia DESC LIMIT ?');
		$seleccion->bind_param('i',$numero_noticias);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement para recuperar noticias por seccion de la base de datos
	private function selectNoticiasPorSeccion($id_seccion, $numero_noticias){
		$seleccion = self::$conexion->prepare('SELECT id_noticia, autor, titular, subtitulo, entradilla, 
		cuerpo, video, DATE(fecha_publicacion) as fecha_pub,
		DATE(fecha_modificacion) as fecha_mod, TIME(fecha_publicacion) as hora_pub, 
		TIME(fecha_modificacion) as hora_mod, estado FROM noticia WHERE id_seccion = ? ORDER BY id_noticia DESC LIMIT ?');
		$seleccion->bind_param('ii',$id_seccion, $numero_noticias);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement para recuperar noticias por subseccion de la base de datos
	private function selectNoticiasPorSubseccion($id_subseccion, $numero_noticias){
		$seleccion = self::$conexion->prepare('SELECT id_noticia, autor, titular, subtitulo, entradilla, 
		cuerpo, video, DATE(fecha_publicacion) as fecha_pub,
		DATE(fecha_modificacion) as fecha_mod, TIME(fecha_publicacion) as hora_pub, 
		TIME(fecha_modificacion) as hora_mod, estado FROM noticia WHERE id_subseccion = ? ORDER BY id_noticia DESC LIMIT ?');
		$seleccion->bind_param('ii', $id_subseccion, $numero_noticias);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement para recuperar una noticia concreta de la base de datos
	private function selectNoticia($id_noticia){
		$seleccion = self::$conexion->prepare('SELECT id_noticia, autor, titular, subtitulo, entradilla, 
		cuerpo, video, DATE(fecha_publicacion) as fecha_pub,
		DATE(fecha_modificacion) as fecha_mod, TIME(fecha_publicacion) as hora_pub, 
		TIME(fecha_modificacion) as hora_mod, estado FROM noticia WHERE id_noticia = ?');
		$seleccion->bind_param('i',$id_noticia);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement para recuperar imagenes de una noticia de la base de datos
	private function selectImagenes($id_noticia){
		$seleccion = self::$conexion->prepare('SELECT * FROM imagenes WHERE id_noticia = ? ORDER BY id_imagen ASC');
		$seleccion->bind_param('i',$id_noticia);
		$seleccion->execute();
		return $seleccion; 
	}
	
	// Construye el prepared statement para recuperar comentarios de una noticia de la base de datos
	private function selectComentarios($id_noticia){
		$seleccion = self::$conexion->prepare('SELECT id_comentario,id_noticia,nombre,correo,DATE(fecha_hora) as fecha, TIME(fecha_hora) as hora,texto 
			FROM comentario WHERE id_noticia = ? ORDER BY fecha_hora DESC');
		$seleccion->bind_param('i',$id_noticia);
		$seleccion->execute();
		return $seleccion;
	}

	// Construye el prepared statement para recuperar un número de noticias relacionadas de una noticia de la base de datos
	private function selectNoticiasRelacionadas($id_noticia, $numero_noticias){
		$seleccion = self::$conexion->prepare('
			SELECT * FROM noticia WHERE id_noticia IN (
				SELECT id_noticia FROM noticia_etiqueta WHERE id_etiqueta IN (
					SELECT id_etiqueta FROM noticia_etiqueta WHERE id_noticia = ?
				) AND id_noticia != ?
			GROUP BY id_noticia ORDER BY COUNT(*) DESC, id_noticia DESC
			) LIMIT ?'
		);
		
		$seleccion->bind_param('iii',$id_noticia,$id_noticia,$numero_noticias);
		$seleccion->execute();
		return $seleccion;
	}
	
	// Método para obtener los comentarios de la BD de la noticia identificada por "$id_noticia"
	// y devolverlos en un array
	private function obtenerComentarios($id_noticia){
		$seleccion = $this->selectComentarios($id_noticia);
		$consulta = $seleccion->get_result();
		
		// Array donde se almacenaran los comentarios
		$comentarios = array();
		
		// Procesamos los comentarios y los metemos en el array
		while ($fila = $consulta->fetch_object()){
			$id_comentario = "$fila->id_comentario";
			$comentario = new ModelComentario($id_comentario, $fila->id_noticia, 
				$fila->nombre, $fila->correo, $fila->fecha, 
				$fila->hora, $fila->texto);
			$comentarios[$id_comentario] = $comentario;
		}
		
		$seleccion->close();
		mysqli_free_result($consulta);
		
		return $comentarios;
	}

	// Método para obtener las imagenes de la BD de la noticia identificada por "$id_noticia"
	// y devolverlos en un array
	private function obtenerImagenes($id_noticia){
		$seleccion = $this->selectImagenes($id_noticia);
		$consulta = $seleccion->get_result();
		
		// Array donde se almacenaran los imagenes
		$imagenes = array();
		
		// Procesamos los imagenes y los metemos en el array
		while ($fila = $consulta->fetch_object()){
			$id_imagen = $fila->id_imagen;
			$imagen = new ModelImagen($id_imagen, $fila->id_noticia, 
				$fila->url, $fila->pie);
			$imagenes[$id_imagen] = $imagen;
		}
		
		$seleccion->close();
		mysqli_free_result($consulta);
		
		return $imagenes;
	}
	
	// Método para obtener un número de noticias relacionadas de la noticia identificada
	// por $id_noticia de la BD. Estas noticias solo incluyen su id, titular, autor, fecha de publicación
	// e imagenes ya que no se mostrará el resto de información de la misma en la página.
	private function obtenerNoticiasRelacionadas($id_noticia, $numero_noticias){
		$seleccion = $this->selectNoticiasRelacionadas($id_noticia, $numero_noticias);
		$consulta = $seleccion->get_result();
		
		// Array donde se almacenaran las noticias relacionadas
		$noticias_relacionadas = array();
		
		// Procesamos las noticias relacionadas y las metemos en el array
		while ($fila = $consulta->fetch_object()){
			$id_noticia_relacionada = $fila->id_noticia;
			$imagenes = $this->obtenerImagenes($id_noticia_relacionada);
			
			$noticia_relacionada = new ModelNoticia($id_noticia_relacionada, $fila->autor, $fila->titular, null, null, 
				null, $fila->fecha_publicacion, null, null, $imagenes, null, null, null, null, null, null, $fila->estado);
				
			$noticias_relacionadas[$id_noticia_relacionada] = $noticia_relacionada;
		}
		
		$seleccion->close();
		mysqli_free_result($consulta);
		
		return $noticias_relacionadas;
	}
}
?>