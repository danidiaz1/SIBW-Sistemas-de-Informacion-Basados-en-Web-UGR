<?php
/* Clase que modela los anuncios publicitarios del periódico*/
class ModelPublicidad {
	private $id_publicidad;
	private $imagen;
	private $url;
	private $titulo;
	private $clicks;
	private $texto;
	
	public function __construct($id_publicidad, $imagen, $url, $titulo, $clicks, $texto)
	{
		$this->id_publicidad = $id_publicidad;
		$this->imagen = $imagen;
		$this->url = $url;
		$this->titulo = $titulo;
		$this->clicks = $clicks;
		$this->texto = $texto;
	}
	
	public function getId(){
		return $this->id_publicidad;
	}
	
	public function getImagen(){
		return $this->imagen;
	}
	
	public function getUrl(){
		return $this->url;
	}
	
	public function getTitulo(){
		return $this->titulo;
	}
	
	public function getClicks(){
		return $this->clicks;
	}
	
	public function getTexto(){
		return $this->texto;
	}
}
?>