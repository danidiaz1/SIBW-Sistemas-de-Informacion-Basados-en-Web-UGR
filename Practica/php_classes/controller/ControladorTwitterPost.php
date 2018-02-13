<?php
include('Controlador.php');
include('php_classes/view/VistaTwitterPost.php');

/* Controlador de la vista del post de Twitter de una noticia.
Recupera datos de una noticia del Modelo y se lo pasa a la Vista*/
class ControladorTwitterPost extends Controlador {
	
	private $noticia;
	private $vista_twitter_post;
	private $tiene_comentarios;
	
	public function __construct($tiene_publicidad = false, $tiene_menu = false, $tiene_comentarios = false){
		parent::__construct($tiene_publicidad, $tiene_menu);
		$this->tiene_comentarios = $tiene_comentarios;

	}
	
	public function mostrarPagina($id_noticia){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$noticia = $this->obtenerNoticia($id_noticia, $this->tiene_comentarios);
		$this->contenedor->cerrarConexion();
		
		$this->vista_twitter_post = new VistaTwitterPost($noticia);
		$this->vista_twitter_post->mostrarPagina();
	}
}
?>