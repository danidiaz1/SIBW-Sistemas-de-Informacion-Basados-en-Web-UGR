<?php
/* Clase que modela los comentarios de las noticias */
class ModelComentario {
	private $id_comentario;
	private $id_noticia;
	private $nombre;
	private $correo;
	private $fecha;
	private $hora;
	private $texto;
	
	public function __construct($id_comentario, $id_noticia, $nombre, $correo, $fecha, $hora, $texto)
	{
		$this->id_comentario = $id_comentario;
		$this->id_noticia = $id_noticia;
		$this->nombre = $nombre;
		$this->correo = $correo;
		$this->fecha = $fecha;
		$this->hora = $hora;
		$this->texto = $texto;
	}
	
	public function getId(){
		return $this->id_comentario;
	}
	
	public function getIdNoticia(){
		return $this->id_noticia;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function getCorreo(){
		return $this->correo;
	}
	
	public function getFecha(){
		return $this->fecha;
	}
	
	public function getHora(){
		return $this->hora;
	}
	
	public function getTexto(){
		return $this->texto;
	}
}
?>