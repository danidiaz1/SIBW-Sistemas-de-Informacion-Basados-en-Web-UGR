<?php
/* Clase que modela las imágenes de las noticias del periódico*/
class ModelImagen {
	private $id_imagen;
	private $id_noticia;
	private $url;
	private $pie;
	
	public function __construct($id_imagen, $id_noticia, $url, $pie)
	{
		$this->id_imagen = $id_imagen;
		$this->id_noticia = $id_noticia;
		$this->url = $url;
		$this->pie = $pie;
	}
	
	public function getId(){
		return $this->id_imagen;
	}
	
	public function getIdNoticia(){
		return $this->id_noticia;
	}
	
	public function getUrl(){
		return $this->url;
	}
	
	public function getPie(){
		return $this->pie;
	}
}
?>