<?php
/* Clase que modela las noticias del periódico
Como atributos a destacar, tienen un array de comentarios, de imágenes
y de noticias relacionadas*/
class ModelNoticia {
	private $id_noticia;
	private $autor;
	private $titular;
	private $subtitulo;
	private $seccion;
	private $subseccion;
	private $fecha_publicacion;
	private $hora_publicacion;
	private $entradilla;
	private $imagenes;
	private $cuerpo;
	private $fecha_modificacion;
	private $hora_modificacion;
	private $video;
	private $comentarios;
	private $noticias_relacionadas;
	private $estado;
	
	public function __construct($id_noticia, $autor, $titular, $subtitulo, $seccion, $subseccion, 
		$fecha_publicacion, $hora_publicacion, $entradilla, $imagenes, $cuerpo, $fecha_modificacion, $hora_modificacion, $video, 
		$comentarios, $noticias_relacionadas, $estado)
	{
		$this->id_noticia = $id_noticia;
		$this->autor = $autor;
		$this->titular = $titular;
		$this->subtitulo = $subtitulo;
		$this->seccion = $seccion;
		$this->subseccion = $subseccion;
		$this->fecha_publicacion = $fecha_publicacion;
		$this->hora_publicacion = $hora_publicacion;
		$this->entradilla = $entradilla;
		$this->imagenes = $imagenes;
		$this->cuerpo = $cuerpo;
		$this->fecha_modificacion = $fecha_modificacion;
		$this->hora_modificacion = $hora_modificacion;
		$this->video = $video;
		$this->comentarios = $comentarios;
		$this->noticias_relacionadas = $noticias_relacionadas;
		$this->estado = $estado;
	}
	
	public function getId(){
		return $this->id_noticia;
	}
	
	public function getAutor(){
		return $this->autor;
	}
	
	public function getTitular(){
		return $this->titular;
	}
	
	public function getSubtitulo(){
		return $this->subtitulo;
	}
	
	public function getSeccion(){
		return $this->seccion;
	}
	
	public function getSubseccion(){
		return $this->subseccion;
	}
	
	public function getFechaPublicacion(){
		return $this->fecha_publicacion;
	}
	
	public function getHoraPublicacion(){
		return $this->hora_publicacion;
	}
	
	public function getEntradilla(){
		return $this->entradilla;
	}
	
	public function getImagenes(){
		return $this->imagenes;
	}
	
	public function getCuerpo(){
		return $this->cuerpo;
	}
	
	public function getFechaModificacion(){
		return $this->fecha_modificacion;
	}
	
	public function getHoraModificacion(){
		return $this->hora_modificacion;
	}
	
	public function getVideo(){
		return $this->video;
	}
	
	public function getComentarios(){
		return $this->comentarios;
	}
	
	public function getNoticiasRelacionadas(){
		return $this->noticias_relacionadas;
	}

	public function getEstado(){
		return $this->estado;
	}
	
	public function isPublicada(){
		$publicada = false;
		
		if ($this->estado == 'publicada')
			$publicada = true;

		return $publicada;
	}
	
}
?>