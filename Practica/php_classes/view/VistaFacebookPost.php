<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página del post de facebook
mediante el paso de una noticia al constructor*/
class VistaFacebookPost extends VistaPagina{
	private $noticia;
	
	public function __construct($noticia){
		parent::__construct();
		$this->noticia = $noticia;
		$this->titulo = 'Postear en Facebook';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_post.css">';
	}
	
	protected function mostrarContenido(){
		if ($this->noticia->isPublicada()){
			$imagenes = $this->noticia->getImagenes();
			$url_imagen = array_values($imagenes)[0]->getUrl();
			echo '<div class="post">
					<h1>Se publicará en Facebook el siguiente mensaje:</h1>
					<p>"'.$this->noticia->getTitular().'", vía @daily_news.</p>
					<img src="'.$url_imagen.'">
					<button type="button" autofocus="on" class="aceptar" onClick="window.close();">Aceptar</button>
					<button type="button" class="cancelar" onClick="window.close();">Cancelar</button>
				</div>';
		} else
			echo '<p>Noticia no disponible</p>';
	}
	
	protected function mostrarSideBar(){}
	
	protected function mostrarInicioHTML(){
		echo '	<!DOCTYPE html> 
				<html>
					<head>
						<meta charset="UTF-8">'
						.$this->estilo.
						'<link rel="shortcut icon" type="image/x-icon" href="resources/imagenes/icono.ico">
						<title>' . $this->titulo . '</title> 
					</head> 
					
					<body>
						<div class="contenido">
					';
	}
	
	public function mostrarPagina(){
		$this->mostrarInicioHTML();
		
		$this->mostrarContenido();
		
		$this->mostrarFinalHTML();
	}
}
?>