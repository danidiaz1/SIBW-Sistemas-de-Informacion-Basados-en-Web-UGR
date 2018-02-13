<?php
include('VistaPagina.php');

/* Clase que se encarga de mostrar la vista de impresión de una noticia
pasada como parámetro al constructor*/
class VistaNoticiaImprimir extends VistaPagina{
	private $noticia;
	
	public function __construct($noticia){
		parent::__construct();
		$this->noticia = $noticia;
		$this->titulo = $noticia->getTitular();
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_noticia_imprimir.css">';
	}
	
	protected function mostrarHeader(){
		echo '<div class="cabecera">
				<a href="index.php">
					<img class="logo" src="resources/imagenes/logo.png">
				</a>
				<p id="fechaActual">'.$this->fecha.'</p>
			</div>';
	}
	
	protected function mostrarContenido(){
		if($this->noticia->isPublicada()){
			echo '<article>
					<h1 class="titular">'.$this->noticia->getTitular().'</h1>
					<h2 class="subtitulo">'.$this->noticia->getSubtitulo().'</h2>
					<p class="entradilla">'.$this->noticia->getEntradilla().'</p>
					<figure class="fotoNoticia">
						<img class="fotoNoticia" src="'.array_values($this->noticia->getImagenes())[0]->getUrl().'">
						<figcaption class="pieDeFoto">'.array_values($this->noticia->getImagenes())[0]->getPie().'</figcaption>
					</figure>
					<p class="autorFecha"><span class="autor">'.$this->noticia->getAutor().'</span>
					| Publicado el <span class="fecha">'.date($this->formato_fecha, strtotime($this->noticia->getFechaPublicacion())).
					', '.$this->noticia->getHoraPublicacion().'</span></p>
					<div class="cuerpo">'.$this->noticia->getCuerpo();
					
					$video = $this->noticia->getVideo();
			
					if ($video != null){
						// Comprobar si el video es un enlace:
						if (filter_var($video, FILTER_VALIDATE_URL)) { 
							echo '<p>Video relacionado: <a href="'.$video.'">'.$video.'</a></p>';
						}
					}
					
			echo '</div> 
				
				</article>';
		} else
			echo '<p> Noticia no disponible </p>';
	}
	
	protected function mostrarSideBar(){}
	
	public function mostrarPagina(){
		$this->mostrarInicioHTML();
		
		$this->mostrarHeader();
		
		$this->mostrarContenido();
		
		$this->mostrarFinalHTML();
	}
}
?>